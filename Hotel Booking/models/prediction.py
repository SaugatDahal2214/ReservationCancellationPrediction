import pickle
import numpy as np

# Load the saved model
with open("ml_model", "rb") as f:
    model = pickle.load(f)

# New sample data for prediction as a 2D array
new_data = np.array([
    [1,0,2,1,1,0,0,1,2,28,1,0,0,60.0,0,3],
    [1,0,2,1,1,0,0,1,2,88,1,0,0,60.0,0,1],
    [2,0,2,1,1,0,0,1,2,28,1,0,0,90.0,0,0],
    [2,0,2,1,1,0,0,1,2,68,1,0,0,90.0,0,1],
    [2,2,2,1,1,0,0,1,2,8,1,0,0,200.0,0,0],
])

# Confirm the shape of new_data
print("Shape of new_data:", new_data.shape)  # Should be (1, number_of_features)

# Make predictions
predictions = model.predict(new_data)

# Print predictions
print("Predictions:", predictions)
