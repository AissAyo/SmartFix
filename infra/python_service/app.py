from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
import sys
import os
from typing import List, Dict, Optional
import random
import mysql.connector
from GarageRecommender import GarageRecommender
from DBConnector import db
from DistanceCalculator import DistanceCalculator
from AutoDataFeeder import AutoDataFeeder

# Add the current directory to the Python path
sys.path.append(os.path.dirname(os.path.abspath(__file__)))

app = FastAPI()

# Add CORS middleware
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # Allows all origins
    allow_credentials=True,
    allow_methods=["*"],  # Allows all methods
    allow_headers=["*"],  # Allows all headers
)

class ClientRequest(BaseModel):
    client_id: int

class GarageResponse(BaseModel):
    id: int
    name: str
    rating: float
    city: str
    distance: float
    specialization_percentage: float
    make_reservations: int
    total_reservations: int

class RecommendationResponse(BaseModel):
    client_id: int
    client_car_make: str
    client_city: str
    recommended_garages: List[GarageResponse]

# Initialize components
recommender = GarageRecommender()
distance_calculator = DistanceCalculator()
data_feeder = AutoDataFeeder()

@app.get("/")
async def root():
    return {"message": "Python Service is running"}

@app.get("/health")
async def health_check():
    return {"status": "healthy"}

@app.get("/test-recommender")
async def test_recommender():
    cursor = None
    try:
        # Get a random client ID from the database
        cursor = db.cursor()
        cursor.execute("SELECT id FROM client ORDER BY RAND() LIMIT 1")
        result = cursor.fetchone()
        
        if not result:
            raise HTTPException(status_code=404, detail="No clients found in database")
            
        client_id = result[0]
        
        # Get recommendations
        recommended_garages = recommender.get_recommendations(client_id, limit=3)
        
        return {
            "client_id": client_id,
            "recommended_garages": recommended_garages
        }
        
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))
    finally:
        if cursor:
            cursor.close()

@app.post("/match-garages")
def match_garages(request: ClientRequest):
    try:
        # Get client data
        cursor = db.cursor(dictionary=True)
        cursor.execute("""
            SELECT 
                c.id,
                ca.make as car_make,
                l.city
            FROM client c
            JOIN vehicules v ON c.id = v.client_id
            JOIN car_api ca ON v.car_api_id = ca.id
            LEFT JOIN location l ON c.location_id = l.id
            WHERE c.id = %s
        """, (request.client_id,))
        client = cursor.fetchone()
        cursor.close()
        
        if not client:
            raise HTTPException(status_code=404, detail="Client not found")
        
        client_id = client['id']
        client_car_make = client['car_make']
        client_city = client['city']
        
        # Get recommended garages
        recommended_garage_ids = recommender.get_recommendations(
            client_id=request.client_id,
            limit=3
        )
        
        # Get detailed information for each recommended garage
        recommended_garages = []
        cursor = db.cursor(dictionary=True)
        for garage_id in recommended_garage_ids:
            cursor.execute("""
                SELECT 
                    g.id,
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
            """, (client_car_make, garage_id))
            garage = cursor.fetchone()
            
            if garage:
                # Calculate distance
                cursor.execute("""
                    SELECT latitude, longitude
                    FROM client c
                    JOIN location l ON c.location_id = l.id
                    WHERE c.id = %s
                """, (client_id,))
                client_location = cursor.fetchone()
                
                if client_location:
                    distance = distance_calculator.calculate_distance(
                        (client_location['latitude'], client_location['longitude']),
                        (garage['latitude'], garage['longitude'])
                    )
                else:
                    distance = 0
                
                specialization_percentage = (garage['make_reservations'] / garage['total_reservations'] * 100) if garage['total_reservations'] > 0 else 0
                
                recommended_garages.append({
                    "id": garage['id'],
                    "name": garage['name'],
                    "rating": garage['rating'],
                    "city": garage['city'],
                    "distance": distance,
                    "specialization_percentage": specialization_percentage,
                    "make_reservations": garage['make_reservations'],
                    "total_reservations": garage['total_reservations']
                })
        
        cursor.close()
        
        return RecommendationResponse(
            client_id=client_id,
            client_car_make=client_car_make,
            client_city=client_city,
            recommended_garages=recommended_garages
        )
        
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="0.0.0.0", port=8001)
