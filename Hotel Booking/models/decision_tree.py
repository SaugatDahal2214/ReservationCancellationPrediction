import numpy as np
from collections import Counter

class Node:
    def __init__(self, feature=None, threshold=None, left=None, right=None, information_gain=None, value=None):
        self.feature = feature
        self.threshold = threshold
        self.left = left
        self.right = right
        self.information_gain = information_gain
        self.value = value
    
    def print_attributes(self):
        # This method prints the attributes of the given node
        print("Feature to be split: " + str(self.feature))
        print("Threshold of split: " + str(self.threshold))
        print("Left child: " + str(self.left))
        print("Right child: " + str(self.right))
        print("Information Gain: " + str(self.information_gain))
        print("Value at current node: " + str(self.value))


class DecisionTree:
    def __init__(self, n_features, min_samples_split=50, max_depth=15):
        self.min_samples_split = min_samples_split
        self.max_depth = max_depth
        self.n_features = n_features
        
    def _entropy(self, y):
        count = np.bincount(np.array(y, dtype=np.int64))
        pb = count / len(y)  # probabilities of all the values in the class label
        entropy = 0
        for i in pb:
            if i > 0:
                entropy += i * np.log2(i)
        return -entropy
        
    def _information_gain(self, parent_node, left_child_node, right_child_node):
        left_childs = len(left_child_node) / len(parent_node)
        right_childs = len(right_child_node) / len(parent_node)
        parent_entropy = self._entropy(parent_node)
        left_entropy = self._entropy(left_child_node)
        right_entropy = self._entropy(right_child_node)        
        information_gain = parent_entropy - ((left_entropy * left_childs) + (right_entropy * right_childs))
        return information_gain
    
    def _calculate_best_split(self, feature, label):
        best_split = {
            "feature_index": None,
            "threshold": None,
            "left": None,
            "right": None,
            "information_gain": -1
        }
        best_information_gain = -1
        (_, columns) = feature.shape

        for i in range(columns):
            x_current = feature[:, i]
            for threshold in np.unique(x_current):
                dataset = np.concatenate((feature, label.reshape(1, -1).T), axis=1)
                dataset_left = np.array([row for row in dataset if row[i] <= threshold])
                dataset_right = np.array([row for row in dataset if row[i] > threshold])
                
                if (len(dataset_left) > 0) and (len(dataset_right) > 0):
                    y = dataset[:, -1]
                    y_left = dataset_left[:, -1]
                    y_right = dataset_right[:, -1]
                    information_gain = self._information_gain(y, y_left, y_right)
                    if information_gain > best_information_gain:
                        best_split = {
                            "feature_index": i,
                            "threshold": threshold,
                            "left": dataset_left,
                            "right": dataset_right,
                            "information_gain": information_gain
                        }
                        best_information_gain = information_gain

        if best_split["feature_index"] is not None:
            print("Splitted Column: {0}".format(self.n_features[best_split['feature_index']]))
        return best_split
    
    def _grow_tree(self, X, y, depth=0):
        num_rows, num_cols = X.shape
        if (num_rows >= self.min_samples_split) and (depth < self.max_depth):
            splitted_data = self._calculate_best_split(X, y)
            if splitted_data['information_gain'] > 0:
                new_depth = depth + 1
                X_left = splitted_data['left'][:, :-1]
                y_left = splitted_data['left'][:, -1]
                left_child = self._grow_tree(X_left, y_left, new_depth)
                
                X_right = splitted_data['right'][:, :-1]
                y_right = splitted_data['right'][:, -1]
                right_child = self._grow_tree(X_right, y_right, new_depth)
                
                return Node(
                    feature=splitted_data['feature_index'],
                    threshold=splitted_data['threshold'],
                    left=left_child,
                    right=right_child,
                    information_gain=splitted_data['information_gain']
                )

        return Node(value=Counter(y).most_common(1)[0][0])
              
    def fit(self, X, y):
        print("-----------------------------")
        print("Training Process Started.")
        self.root = self._grow_tree(X, y)

    def _predict(self, x, tree):
        if tree.value is not None:
            return tree.value
        
        feature = x[tree.feature]
        if feature <= tree.threshold:
            return self._predict(x, tree.left)
        return self._predict(x, tree.right)
     
    def predict(self, X, n_features):
        self.n_features = n_features
        return [self._predict(x, self.root) for x in X]
