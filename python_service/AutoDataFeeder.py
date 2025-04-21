from DBConnector import connection
import pandas as pd
from collections import defaultdict

class AutoDataFeeder:
    def __init__(self):
        self.connection = connection

    def find_most_common_cars_per_garage(self):
        """
        Find the most common car make worked on in each garage.
        Returns a dictionary with garage names as keys and their most common car makes as values.
        """
        try:
            # Query to get all reservations with vehicle and garage information
            query = """
            SELECT 
                g.id as garage_id,
                g.name as garage_name,
                ca.make as vehicle_make,
                COUNT(*) as reservation_count
            FROM reservations r
            JOIN services s ON r.service_id = s.id
            JOIN category_service cs ON s.category_service_id = cs.id
            JOIN garages g ON cs.garage_id = g.id
            JOIN vehicules v ON r.vehicle_id = v.id
            JOIN car_api ca ON v.car_api_id = ca.id
            GROUP BY g.id, g.name, ca.make
            ORDER BY g.id, reservation_count DESC
            """
            
            # Execute query and fetch results
            cursor = self.connection.cursor(dictionary=True)
            cursor.execute(query)
            results = cursor.fetchall()
            cursor.close()
            
            # Process results to find most common car per garage
            garage_car_counts = defaultdict(lambda: defaultdict(int))
            for row in results:
                garage_car_counts[row['garage_name']][row['vehicle_make']] = row['reservation_count']
            
            # Find the most common car for each garage
            most_common_cars = {}
            for garage, car_counts in garage_car_counts.items():
                # Sort cars by reservation count and get the most common
                sorted_cars = sorted(car_counts.items(), key=lambda x: x[1], reverse=True)
                most_common_car = sorted_cars[0][0] if sorted_cars else "No data"
                most_common_count = sorted_cars[0][1] if sorted_cars else 0
                
                most_common_cars[garage] = {
                    "most_common_car": most_common_car,
                    "reservation_count": most_common_count,
                    "total_reservations": sum(car_counts.values()),
                    "percentage": (most_common_count / sum(car_counts.values()) * 100) if sum(car_counts.values()) > 0 else 0
                }
            
            return most_common_cars
            
        except Exception as e:
            print(f"Error finding most common cars per garage: {str(e)}")
            return None

    def get_garage_car_distribution(self, garage_name=None):
        """
        Get the distribution of car makes for a specific garage or all garages.
        If garage_name is provided, returns data for that garage only.
        Otherwise, returns data for all garages.
        """
        try:
            # Base query
            query = """
            SELECT 
                g.id as garage_id,
                g.name as garage_name,
                ca.make as vehicle_make,
                COUNT(*) as reservation_count
            FROM reservations r
            JOIN services s ON r.service_id = s.id
            JOIN category_service cs ON s.category_service_id = cs.id
            JOIN garages g ON cs.garage_id = g.id
            JOIN vehicules v ON r.vehicle_id = v.id
            JOIN car_api ca ON v.car_api_id = ca.id
            """
            
            # Add filter for specific garage if provided
            if garage_name:
                query += " WHERE g.name = %s"
                params = (garage_name,)
            else:
                params = None
                
            # Complete the query
            query += " GROUP BY g.id, g.name, ca.make ORDER BY g.name, reservation_count DESC"
            
            # Execute query
            cursor = self.connection.cursor(dictionary=True)
            if params:
                cursor.execute(query, params)
            else:
                cursor.execute(query)
            results = cursor.fetchall()
            cursor.close()
            
            # Process results
            garage_data = defaultdict(lambda: {"cars": [], "total": 0})
            for row in results:
                garage_name = row['garage_name']
                garage_data[garage_name]["cars"].append({
                    "make": row['vehicle_make'],
                    "count": row['reservation_count']
                })
                garage_data[garage_name]["total"] += row['reservation_count']
            
            # Calculate percentages
            for garage in garage_data:
                for car in garage_data[garage]["cars"]:
                    car["percentage"] = (car["count"] / garage_data[garage]["total"] * 100) if garage_data[garage]["total"] > 0 else 0
            
            return dict(garage_data)
            
        except Exception as e:
            print(f"Error getting garage car distribution: {str(e)}")
            return None

    def find_garages_by_car_make(self, car_make):
        """
        Find garages that have serviced the specified car make.
        Returns a list of garages with their statistics.
        
        Args:
            car_make (str): The car make to search for (e.g., 'BMW', 'Audi')
            
        Returns:
            list: List of dictionaries containing garage information and statistics
        """
        try:
            print(f"\nSearching for garages that service {car_make} cars...")
            
            # Query to get all reservations with vehicle and garage information
            query = """
            SELECT 
                g.id as garage_id,
                g.name as garage_name,
                ca.make as vehicle_make,
                COUNT(*) as reservation_count,
                (
                    SELECT COUNT(*)
                    FROM reservations r2
                    JOIN services s2 ON r2.service_id = s2.id
                    JOIN category_service cs2 ON s2.category_service_id = cs2.id
                    WHERE cs2.garage_id = g.id
                ) as total_reservations
            FROM garages g
            JOIN category_service cs ON cs.garage_id = g.id
            JOIN services s ON s.category_service_id = cs.id
            JOIN reservations r ON r.service_id = s.id
            JOIN vehicules v ON r.vehicle_id = v.id
            JOIN car_api ca ON v.car_api_id = ca.id
            WHERE ca.make = %s
            GROUP BY g.id, g.name
            ORDER BY reservation_count DESC
            """
            
            # Execute query and fetch results
            cursor = self.connection.cursor(dictionary=True)
            cursor.execute(query, (car_make,))
            results = cursor.fetchall()
            cursor.close()
            
            print(f"Found {len(results)} garages that service {car_make} cars")
            
            # Process results
            garages = []
            for row in results:
                percentage = (row['reservation_count'] / row['total_reservations'] * 100) if row['total_reservations'] > 0 else 0
                garage_info = {
                    'garage_name': row['garage_name'],
                    'car_make': car_make,
                    'reservation_count': row['reservation_count'],
                    'total_reservations': row['total_reservations'],
                    'percentage': percentage
                }
                print(f"Garage: {garage_info['garage_name']}")
                print(f"  - {car_make} reservations: {garage_info['reservation_count']}/{garage_info['total_reservations']} ({garage_info['percentage']:.1f}%)")
                garages.append(garage_info)
            
            return garages
            
        except Exception as e:
            print(f"Error finding garages by car make: {str(e)}")
            return None

if __name__ == "__main__":
    # Example usage
    feeder = AutoDataFeeder()
    
    # Test the new function with a specific car make
    car_make = "BMW"
    matching_garages = feeder.find_garages_by_car_make(car_make)
    if matching_garages:
        print(f"\nGarages where {car_make} is the most common car:")
        print("=============================================")
        for garage in matching_garages:
            print(f"\nGarage: {garage['garage_name']}")
            print(f"Total {car_make} Reservations: {garage['reservation_count']}")
            print(f"Total All Reservations: {garage['total_reservations']}")
            print(f"Percentage: {garage['percentage']:.1f}%")
    
    # Original analysis functions
    most_common_cars = feeder.find_most_common_cars_per_garage()
    if most_common_cars:
        print("\nMost Common Cars Per Garage:")
        print("=============================")
        for garage, data in most_common_cars.items():
            print(f"\nGarage: {garage}")
            print(f"Most Common Car: {data['most_common_car']}")
            print(f"Reservations for this car: {data['reservation_count']}")
            print(f"Total Reservations: {data['total_reservations']}")
            print(f"Percentage: {data['percentage']:.1f}%")
    
    # Get detailed distribution for all garages
    distribution = feeder.get_garage_car_distribution()
    if distribution:
        print("\nDetailed Car Distribution Per Garage:")
        print("=====================================")
        for garage, data in distribution.items():
            print(f"\nGarage: {garage}")
            print(f"Total Reservations: {data['total']}")
            print("Car Makes:")
            for car in data['cars']:
                print(f"- {car['make']}: {car['count']} reservations ({car['percentage']:.1f}%)")
