from AutoDataFeeder import AutoDataFeeder
from DistanceCalculator import DistanceCalculator
from typing import List, Dict, Tuple
from DBConnector import db
import random

class GarageRecommender:
    def __init__(self):
        self.auto_feeder = AutoDataFeeder()
        self.distance_calculator = DistanceCalculator()
        self.connection = db

    def get_garage_rating(self, garage_id: int) -> float:
        """
        Get the rating of a garage from the database.
        """
        try:
            query = """
            SELECT rating
            FROM garages
            WHERE id = %s
            """
            
            cursor = self.connection.cursor(dictionary=True)
            cursor.execute(query, (garage_id,))
            result = cursor.fetchone()
            cursor.close()
            
            if result and result['rating'] is not None:
                return float(result['rating']) / 5.0
            return 0.5
            
        except Exception as e:
            print(f"Error getting garage rating: {str(e)}")
            return 0.5

    def get_recommendations(self, client_id: int, limit: int = 3) -> List[int]:
        """
        Get recommended garage IDs based on client's car make, distance, and rating.
        """
        try:
            print(f"Getting recommendations for client_id: {client_id}")
            
            # Get client's car make and location
            cursor = self.connection.cursor(dictionary=True)
            cursor.execute("""
                SELECT 
                    c.id,
                    ca.make as car_make,
                    l.latitude,
                    l.longitude,
                    l.city
                FROM client c
                JOIN vehicules v ON c.id = v.client_id
                JOIN car_api ca ON v.car_api_id = ca.id
                LEFT JOIN location l ON c.location_id = l.id
                WHERE c.id = %s
                LIMIT 1
            """, (client_id,))
            client = cursor.fetchone()
            cursor.close()

            if not client:
                print(f"No client found with id: {client_id}")
                return []

            print(f"Found client with car make: {client['car_make']}")

            # Get garages specialized in client's car make
            specialized_garages = self.auto_feeder.find_garages_by_car_make(client['car_make'])
            if not specialized_garages:
                print(f"No specialized garages found for car make: {client['car_make']}")
                return []

            print(f"Found {len(specialized_garages)} specialized garages")

            # Calculate scores for each garage
            recommendations = []
            for garage in specialized_garages:
                garage_id = garage['garage_id']
                specialization_score = garage['percentage'] / 100
                rating = self.get_garage_rating(garage_id)
                
                # Get distance score
                distance = self.distance_calculator.calculate_distance(
                    (client['latitude'], client['longitude']),
                    self.distance_calculator.get_garage_location(garage['garage_name'])
                )
                distance_score = 1 / max(1, distance/100)
                
                # Calculate final score
                final_score = (0.3 * rating) + (0.4 * specialization_score) + (0.3 * distance_score)
                
                recommendations.append({
                    'garage_id': garage_id,
                    'final_score': final_score
                })

            # Sort by score and return top garage IDs
            recommendations.sort(key=lambda x: x['final_score'], reverse=True)
            result = [rec['garage_id'] for rec in recommendations[:limit]]
            print(f"Returning {len(result)} recommendations: {result}")
            return result

        except Exception as e:
            print(f"Error getting recommendations: {str(e)}")
            return []

    def format_recommendations(self, recommendations: List[Dict]) -> str:
        """
        Format the recommendations into a readable string.
        
        Args:
            recommendations (list): List of garage recommendations
            
        Returns:
            str: Formatted string containing the recommendations
        """
        if not recommendations:
            return "No suitable garages found."

        output = "\nRecommended Garages (Sorted by Score):\n"
        output += "=====================================\n"
        
        for i, rec in enumerate(recommendations, 1):
            output += f"\n{i}. {rec['garage_name']}\n"
            output += f"   Final Score: {rec['final_score']:.2f}\n"
            output += f"   Distance: {rec['distance']:.1f} km\n"
            output += f"   Specialization: {rec['specialization_score']*100:.1f}%\n"
            output += f"   Rating: {rec['rating']*5:.1f}/5.0\n"
            output += f"   {rec['car_make']} Reservations: {rec['reservation_count']}/{rec['total_reservations']}\n"
            output += "   " + "-"*40 + "\n"

        return output

    def get_random_client(self):
        """
        Get a random client from the database for testing.
        """
        try:
            cursor = self.connection.cursor(dictionary=True)
            cursor.execute("""
                SELECT 
                    c.id,
                    ca.make as car_make,
                    l.latitude,
                    l.longitude,
                    l.city
                FROM client c
                JOIN vehicules v ON c.id = v.client_id
                JOIN car_api ca ON v.car_api_id = ca.id
                LEFT JOIN location l ON c.location_id = l.id
                ORDER BY RAND()
                LIMIT 1
            """)
            client = cursor.fetchone()
            cursor.close()
            return client
        except Exception as e:
            print(f"Error getting random client: {str(e)}")
            return None

    def test_recommender(self):
        """
        Test function to get recommendations for a random client.
        """
        client = self.get_random_client()
        if not client:
            print("No clients found in database")
            return

        print(f"\nTesting recommender with client:")
        print(f"Client ID: {client['id']}")
        print(f"Car Make: {client['car_make']}")
        print(f"Location: {client['city']} ({client['latitude']}, {client['longitude']})")

        recommendations = self.get_recommendations(client['id'])
        if not recommendations:
            print("\nNo recommendations found")
            return

        print("\nRecommended Garages:")
        cursor = self.connection.cursor(dictionary=True)
        for i, garage_id in enumerate(recommendations, 1):
            # Get garage details
            cursor.execute("""
                SELECT 
                    g.name,
                    g.rating,
                    l.city,
                    l.latitude,
                    l.longitude,
                    COUNT(r.id) as total_reservations,
                    SUM(CASE WHEN ca.make = %s THEN 1 ELSE 0 END) as make_reservations
                FROM garages g
                LEFT JOIN location l ON g.location_id = l.id
                LEFT JOIN category_service cs ON cs.garage_id = g.id
                LEFT JOIN services s ON s.category_service_id = cs.id
                LEFT JOIN reservations r ON r.service_id = s.id
                LEFT JOIN vehicules v ON r.vehicle_id = v.id
                LEFT JOIN car_api ca ON v.car_api_id = ca.id
                WHERE g.id = %s
                GROUP BY g.id
            """, (client['car_make'], garage_id))
            garage = cursor.fetchone()
            
            if garage:
                distance = self.distance_calculator.calculate_distance(
                    (client['latitude'], client['longitude']),
                    (garage['latitude'], garage['longitude'])
                )
                
                print(f"\n{i}. Garage ID: {garage_id}")
                print(f"   Name: {garage['name']}")
                print(f"   Rating: {garage['rating']}/5.0")
                print(f"   Location: {garage['city']}")
                print(f"   Distance: {distance:.1f} km")
                print(f"   {client['car_make']} Reservations: {garage['make_reservations']}/{garage['total_reservations']}")
                print(f"   Specialization: {(garage['make_reservations']/garage['total_reservations']*100 if garage['total_reservations'] > 0 else 0):.1f}%")
        
        cursor.close()

if __name__ == "__main__":
    recommender = GarageRecommender()
    recommender.test_recommender()