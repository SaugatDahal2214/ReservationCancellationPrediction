import pickle
import numpy as np
import json
import sys
import os

# Load the saved model
model_path = os.path.join(os.path.dirname(__file__), "ml_model")  # Adjust if necessary

# Load model with error handling
try:
    with open(model_path, "rb") as f:
        model = pickle.load(f)
except FileNotFoundError:
    print("Error: Model file not found.")
    sys.exit(1)
except Exception as e:
    print(f"Error loading model: {e}")
    sys.exit(1)

# Prepare data for prediction
def prepare_data(values):
    # Convert the list of values to a NumPy array with the required shape
    return np.array([[
        values[0],  # no_of_adults
        values[1],  # no_of_children
        values[2],  # no_of_weekend_nights
        values[3],  # no_of_week_nights
        values[4],  # type_of_meal_plan
        values[5],  # required_car_parking_space
        values[6],  # room_type_reserved
        values[7],  # lead_time
        values[8],  # arrival_month
        values[9],  # arrival_date
        values[10], # repeated_guest
        values[11], # no_of_previous_cancellations
        values[12], # no_of_previous_bookings_not_canceled
        values[13], # avg_price_per_room
        values[14]  # no_of_special_requests
    ]])

# Main script logic
if __name__ == "__main__":
    # Check for JSON input
    if len(sys.argv) > 1:
        input_json = sys.argv[1]
    else:
        print("Error: No JSON input received.")
        sys.exit(1)

    # Parse JSON input
    try:
        values = json.loads(input_json)
        new_data = prepare_data(values)
    except json.JSONDecodeError:
        print("Error: Invalid JSON format.")
        sys.exit(1)
    except (TypeError, IndexError):
        print("Error: Incorrect data format.")
        sys.exit(1)

    # Predict and print only the prediction result
   # Predict and print only the prediction result
    try:
        prediction = model.predict(new_data)[0]
        print(f"{prediction:.1f}")  # Format as a single decimal, like "1.0" or "0.0"
    except Exception as e:
        print(f"Error making prediction: {e}")
        sys.exit(1)