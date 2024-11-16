import pickle
import numpy as np

# Load the saved model
with open("ml_model", "rb") as f:
    model = pickle.load(f)

# New sample data for prediction as a 2D array
new_data = np.array([
    [1, 1, 2, 3, 0, 1, 1, 88, 11, 13, 1, 0, 0, 31000.00, 2]
])

# Confirm the shape of new_data
print("Shape of new_data:", new_data.shape)  # Should be (1, number_of_features)

# Make predictions
predictions = model.predict(new_data)

# Print predictions
print("Predictions:", predictions)
