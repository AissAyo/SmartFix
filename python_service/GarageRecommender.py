from AutoDataFeeder import AutoDataFeeder
from DistanceCalculator import DistanceCalculator
from typing import List, Dict, Tuple
from DBConnector import connection

class GarageRecommender:
    def __init__(self):
        self.auto_feeder = AutoDataFeeder()
        self.distance_calculator = DistanceCalculator()
        self.connection = connection

    def get_garage_rating(self, garage_name: str) -> float:
        """
        Get the rating of a garage from the database.
        
        Args:
            garage_name (str): Name of the garage
            
        Returns:
            float: Rating of the garage (0-5 scale, converted to 0-1)
        """
        try:
            query = """
            SELECT rating
            FROM garages
            WHERE name = %s
            """
            
            cursor = self.connection.cursor(dictionary=True)
            cursor.execute(query, (garage_name,))
            result = cursor.fetchone()
            cursor.close()
            
            if result and result['rating'] is not None:
                # Convert 5-star rating to 0-1 scale
                return float(result['rating']) / 5.0
            return 0.5  # Default rating if not found
            
        except Exception as e:
            print(f"Error getting garage rating: {str(e)}")
            return 0.5

    def get_recommended_garages(self, client_location: Tuple[float, float], client_city: str, client_car_make: str) -> List[Dict]:
        """
        Get recommended garages based on car specialization, distance, and rating.
        
        Args:
            client_location (tuple): Latitude and longitude of client's location
            client_city (str): Client's city
            client_car_make (str): Client's car make
            
        Returns:
            list: List of dictionaries containing garage recommendations with scores
        """
        try:
            print(f"\nFinding recommendations for {client_car_make} in {client_city}...")
            print(f"Client location: ({client_location[0]}, {client_location[1]})")
            
            # Get garages specialized in client's car make
            specialized_garages = self.auto_feeder.find_garages_by_car_make(client_car_make)
            if not specialized_garages:
                print("No specialized garages found.")
                return []

            print(f"\nCalculating distances to {len(specialized_garages)} specialized garages...")
            
            # Get distances for all specialized garages
            garage_distances = self.distance_calculator.calculate_distances(
                client_location,
                client_city,
                [garage['garage_name'] for garage in specialized_garages]
            )

            print("\nCalculating final scores...")
            
            # Combine specialization data with distances and calculate scores
            recommendations = []
            for garage in specialized_garages:
                garage_name = garage['garage_name']
                if garage_name in garage_distances:
                    distance = garage_distances[garage_name]
                    specialization_score = garage['percentage'] / 100  # Convert percentage to decimal
                    
                    # Get actual rating from database
                    rating = self.get_garage_rating(garage_name)
                    
                    # Calculate final score using the formula:
                    # 0.3 * rating + 0.4 * specialization_score + 0.3 * (1 / max(1, distance/100))
                    distance_score = 1 / max(1, distance/100)  # Normalize distance to 0-1 scale
                    final_score = (0.3 * rating) + (0.4 * specialization_score) + (0.3 * distance_score)
                    
                    print(f"\nGarage: {garage_name}")
                    print(f"  - Distance: {distance:.1f} km (score: {distance_score:.2f})")
                    print(f"  - Rating: {rating*5:.1f}/5.0 (score: {rating:.2f})")
                    print(f"  - Specialization: {specialization_score*100:.1f}% (score: {specialization_score:.2f})")
                    print(f"  - Final Score: {final_score:.2f}")
                    
                    recommendations.append({
                        'garage_name': garage_name,
                        'distance': distance,
                        'specialization_score': specialization_score,
                        'rating': rating,
                        'final_score': final_score,
                        'car_make': client_car_make,
                        'reservation_count': garage['reservation_count'],
                        'total_reservations': garage['total_reservations']
                    })

            # Sort recommendations by final score in descending order
            recommendations.sort(key=lambda x: x['final_score'], reverse=True)
            
            # Return top 3 recommendations
            return recommendations[:3]

        except Exception as e:
            print(f"Error getting garage recommendations: {str(e)}")
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

if __name__ == "__main__":
    # Example usage
    recommender = GarageRecommender()
    
    # Example client data (Casablanca coordinates)
    client_location = (33.5731, -7.5898)  # Casablanca coordinates
    client_city = "Casablanca"
    client_car_make = "BMW"  # Example car make
    
    # Get recommendations
    recommendations = recommender.get_recommended_garages(
        client_location,
        client_city,
        client_car_make
    )
    
    # Print formatted recommendations
    print(recommender.format_recommendations(recommendations))