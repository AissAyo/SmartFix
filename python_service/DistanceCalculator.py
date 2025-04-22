from math import radians, sin, cos, sqrt, atan2
from typing import List, Dict, Tuple
import requests
from DBConnector import connection

class DistanceCalculator:
    def __init__(self):
        self.connection = connection
        self.garage_locations = self._load_garage_locations()

    def _load_garage_locations(self) -> Dict[str, Tuple[float, float]]:
        """
        Load garage locations from the database.
        
        Returns:
            dict: Dictionary with garage names as keys and (latitude, longitude) as values
        """
        try:
            query = """
            SELECT 
                g.id as garage_id,
                g.name as garage_name,
                l.latitude,
                l.longitude
            FROM garages g
            LEFT JOIN location l ON g.location_id = l.id
            """
            
            cursor = self.connection.cursor(dictionary=True)
            cursor.execute(query)
            results = cursor.fetchall()
            
            locations = {}
            for row in results:
                if row['latitude'] is not None and row['longitude'] is not None:
                    locations[row['garage_name']] = (float(row['latitude']), float(row['longitude']))
            
            return locations
            
        except Exception as e:
            print(f"Error loading garage locations: {str(e)}")
            return {}
        finally:
            if 'cursor' in locals():
                cursor.close()

    def calculate_distance(self, point1: Tuple[float, float], point2: Tuple[float, float]) -> float:
        """
        Calculate the distance between two points using the Haversine formula.
        
        Args:
            point1 (tuple): Latitude and longitude of first point
            point2 (tuple): Latitude and longitude of second point
            
        Returns:
            float: Distance in kilometers
        """
        lat1, lon1 = point1
        lat2, lon2 = point2
        
        # Convert decimal degrees to radians
        lat1, lon1, lat2, lon2 = map(radians, [lat1, lon1, lat2, lon2])
        
        # Haversine formula
        dlat = lat2 - lat1
        dlon = lon2 - lon1
        a = sin(dlat/2)**2 + cos(lat1) * cos(lat2) * sin(dlon/2)**2
        c = 2 * atan2(sqrt(a), sqrt(1-a))
        r = 6371  # Radius of earth in kilometers
        
        return c * r

    def get_garage_location(self, garage_name: str) -> Tuple[float, float]:
        """
        Get the location of a garage by name.
        
        Args:
            garage_name (str): Name of the garage
            
        Returns:
            tuple: Latitude and longitude of the garage
        """
        return self.garage_locations.get(garage_name, (0, 0))

    def calculate_distances(self, client_location: Tuple[float, float], client_city: str, garage_names: List[str]) -> Dict[str, float]:
        """
        Calculate distances between client and multiple garages.
        
        Args:
            client_location (tuple): Latitude and longitude of client's location
            client_city (str): Client's city (for future use with geocoding)
            garage_names (list): List of garage names
            
        Returns:
            dict: Dictionary with garage names as keys and distances as values
        """
        distances = {}
        for garage_name in garage_names:
            garage_location = self.get_garage_location(garage_name)
            if garage_location != (0, 0):
                distance = self.calculate_distance(client_location, garage_location)
                distances[garage_name] = distance
        
        return distances

    def get_nearest_garages(self, client_location: Tuple[float, float], client_city: str, garage_names: List[str], limit: int = 5) -> List[Tuple[str, float]]:
        """
        Get the nearest garages to the client's location.
        
        Args:
            client_location (tuple): Latitude and longitude of client's location
            client_city (str): Client's city
            garage_names (list): List of garage names
            limit (int): Maximum number of garages to return
            
        Returns:
            list: List of tuples containing garage names and distances
        """
        distances = self.calculate_distances(client_location, client_city, garage_names)
        sorted_garages = sorted(distances.items(), key=lambda x: x[1])
        return sorted_garages[:limit]

if __name__ == "__main__":
    # Example usage
    calculator = DistanceCalculator()
    
    # Print loaded garage locations
    print("\nLoaded garage locations:")
    for garage, location in calculator.garage_locations.items():
        print(f"{garage}: {location}")
    
    # Example client location (Paris)
    client_location = (48.8566, 2.3522)
    client_city = "Paris"
    
    # Example garage names
    garage_names = list(calculator.garage_locations.keys())[:3]  # Get first 3 garages
    
    # Get distances
    distances = calculator.calculate_distances(client_location, client_city, garage_names)
    print("\nDistances to garages:")
    for garage, distance in distances.items():
        print(f"{garage}: {distance:.2f} km")
    
    # Get nearest garages
    nearest = calculator.get_nearest_garages(client_location, client_city, garage_names)
    print("\nNearest garages:")
    for garage, distance in nearest:
        print(f"{garage}: {distance:.2f} km")
