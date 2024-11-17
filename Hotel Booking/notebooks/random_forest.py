from decision_tree import DecisionTree
import numpy as np
from collections import Counter

class RandomForest:
    def __init__(self, n_features, n_trees=5, max_depth=15, min_samples_split=50):
        self.n_trees = n_trees
        self.max_depth = max_depth
        self.min_samples_split = min_samples_split
        self.n_features = n_features
        self.trees = []

    def _sample(self, X, y):
        n_rows, n_cols = X.shape
        # Sampling the dataset with replacements
        sample = np.random.choice(a=n_rows, size=n_rows, replace=True)
        samples_x = X[sample]
        samples_y = y[sample]
        return samples_x, samples_y

    def fit(self, X, y):
        if len(self.trees) > 0:
            self.trees = []
        for i in range(self.n_trees):
            print("-----------------------------")
            print("Iteration: {0}".format(i))
            tree = DecisionTree(n_features=self.n_features,
                                min_samples_split=self.min_samples_split,
                                max_depth=self.max_depth)
            sample_x, sample_y = self._sample(X, y)
            tree.fit(sample_x, sample_y)
            self.trees.append(tree)

    def predict(self, X):
        labels = []
        for tree in self.trees:
            print("------------------------------")
            labels.append(tree.predict(X, self.n_features))  # Pass n_features here
        labels = np.swapaxes(labels, 0, 1)  # Transpose to get predictions for each sample
        predictions = []
        
        for preds in labels:
            counter = Counter(preds)
            predictions.append(counter.most_common(1)[0][0])  # Majority vote

        return np.array(predictions)  # Return predictions as a NumPy array

