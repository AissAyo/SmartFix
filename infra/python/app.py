from fastapi import FastAPI, HTTPException
import sys
import os

# Add the python_service directory to the Python path
sys.path.append(os.path.join(os.path.dirname(__file__), '..', '..', 'code', 'python_service'))

from AutoDataFeeder import AutoDataFeeder
from typing import Dict, List, Optional

app = FastAPI()
feeder = AutoDataFeeder()

@app.get("/")
async def root():
    return {"message": "Garage Vehicle Analysis API"}

@app.get("/analysis/most-common-cars")
async def get_most_common_cars():
    """Get the most common car make worked on in each garage"""
    results = feeder.find_most_common_cars_per_garage()
    if results is None:
        raise HTTPException(status_code=500, detail="Error analyzing most common cars per garage")
    return results

@app.get("/analysis/garage-distribution/{garage_name}")
async def get_garage_distribution(garage_name: str):
    """Get the distribution of car makes for a specific garage"""
    results = feeder.get_garage_car_distribution(garage_name)
    if results is None:
        raise HTTPException(status_code=500, detail=f"Error getting distribution for garage {garage_name}")
    return results

@app.get("/analysis/all-garages-distribution")
async def get_all_garages_distribution():
    """Get the distribution of car makes for all garages"""
    results = feeder.get_garage_car_distribution()
    if results is None:
        raise HTTPException(status_code=500, detail="Error getting distribution for all garages")
    return results 