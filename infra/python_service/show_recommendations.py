from GarageRecommender import GarageRecommender
from DBConnector import connection
import time

def get_random_client_info():
    try:
        cursor = connection.cursor(dictionary=True)
        
        # Get a random client with their location and vehicle info
        query = """
        SELECT 
            c.name as client_name,
            l.latitude,
            l.longitude,
            l.city,
            ca.make as car_make
        FROM client c
        JOIN location l ON c.location_id = l.id
        JOIN vehicules v ON v.client_id = c.id
        JOIN car_api ca ON v.car_api_id = ca.id
        ORDER BY RAND()
        LIMIT 1
        """
        
        cursor.execute(query)
        client = cursor.fetchone()
        cursor.close()
        return client
        
    except Exception as e:
        print(f"Error getting client info: {str(e)}")
        return None

def get_garage_recommendations(client_location, client_city, car_make):
    try:
        # Initialize recommender
        recommender = GarageRecommender()
        
        # Get recommendations
        recommendations = recommender.get_recommended_garages(
            client_location,
            client_city,
            car_make
        )
        
        return recommendations
    except Exception as e:
        print(f"Error getting recommendations: {str(e)}")
        return []

def main():
    start_time = time.time()
    
    # Get random client info
    client = get_random_client_info()
    if not client:
        print("Could not find client information.")
        return

    print(f"\nClient Name: {client['client_name']}")
    print(f"Location: {client['city']}")
    print(f"Vehicle Make: {client['car_make']}")
    
    # Get recommendations
    client_location = (float(client['latitude']), float(client['longitude']))
    recommendations = get_garage_recommendations(
        client_location,
        client['city'],
        client['car_make']
    )
    
    # Print formatted recommendations
    if recommendations:
        print("\nRecommended Garages:")
        print("=====================")
        for i, rec in enumerate(recommendations, 1):
            print(f"\n{i}. {rec['garage_name']}")
            print(f"   Distance: {rec['distance']:.1f} km")
            print(f"   Rating: {rec['rating']*5:.1f}/5.0")
            print(f"   Specialization: {rec['specialization_score']*100:.1f}%")
            print(f"   Final Score: {rec['final_score']:.2f}")
            print(f"   {rec['car_make']} Reservations: {rec['reservation_count']}/{rec['total_reservations']}")
    else:
        print("\nNo suitable garages found for this client.")
    
    end_time = time.time()
    print(f"\nRecommendation process completed in {end_time - start_time:.2f} seconds.")

if __name__ == "__main__":
    main() 