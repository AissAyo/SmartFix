from typing import List, Dict


def recommend_garages(preferences: Dict, garages_data: List[Dict]) -> List[Dict]:
    """
    Recommend garages based on user preferences, applying weighted scoring.

    :param preferences: A dictionary with user preferences
    :param garages_data: A list of garage dictionaries
    :return: A list of garages with scores
    """

    # Weights (adjust as needed)
    WEIGHTS = {
        "location": 0.3,
        "services": 0.4,
        "rating": 0.3,
    }

    recommended = []

    for garage in garages_data:
        score = 0.0

        # Location match (case-insensitive substring match)
        location_match = preferences["location"].lower() in garage["location"].lower()
        score += WEIGHTS["location"] * (1 if location_match else 0)

        # Common services
        common_services = set(preferences["required_services"]).intersection(set(garage["services"]))
        service_match_ratio = len(common_services) / len(preferences["required_services"])  # 0.0 to 1.0
        score += WEIGHTS["services"] * service_match_ratio

        # Normalized rating (assuming out of 5)
        normalized_rating = garage["rating"] / 5.0  # 0.0 to 1.0
        score += WEIGHTS["rating"] * normalized_rating

        # Only include if at least some services match
        if common_services:
            recommended.append({
                "name": garage["name"],
                "location": garage["location"],
                "services": list(common_services),
                "rating": garage["rating"],
                "score": round(score, 3)
            })

    return recommended


def sort_recommendations(recommendations: List[Dict]) -> List[Dict]:
    return sorted(recommendations, key=lambda x: x["score"], reverse=True)


# Example data
preferences = {
    "location": "Downtown",
    "required_services": ["Oil Change", "Tire Repair"]
}

garages_data = [
    {"name": "Garage A", "location": "Downtown", "services": ["Oil Change", "Tire Repair", "Brake Check"],
     "rating": 4.5},
    {"name": "Garage B", "location": "Uptown", "services": ["Engine Repair", "Body Work", "Oil Change"], "rating": 4.0},
    {"name": "Garage C", "location": "Suburbs",
     "services": ["Brake Check", "Transmission Repair", "Battery Replacement"], "rating": 3.5},
    {"name": "Garage D", "location": "Downtown", "services": ["Tire Repair", "Oil Change", "Battery Replacement"],
     "rating": 4.8},
]

if __name__ == "__main__":
    recommendations = recommend_garages(preferences, garages_data)
    sorted_recommendations = sort_recommendations(recommendations)

    if sorted_recommendations:
        for idx, garage in enumerate(sorted_recommendations, 1):
            print(f"{idx}. {garage['name']} - Location: {garage['location']}")
            print(f"   Services Match: {', '.join(garage['services'])}")
            print(f"   Rating: {garage['rating']}")
            print(f"   Score: {garage['score']}\n")
    else:
        print("No suitable garages found based on your preferences.")
