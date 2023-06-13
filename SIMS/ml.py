import pandas as pd
import numpy as np
from sklearn.svm import SVC
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression

# Define a function to predict the final grade (G3) based on the input values
def predict_G3_score(G1, G2, failures, absences):
    # Load the data
    data = pd.read_csv("student-mat1 (Autosaved).csv")
    # Use only the required features
    data = data[["G1", "G2", "G3", "failures", "absences","advice"]]

    # Separate the predictors and the target variable
    data = data.iloc[1:222]
    x = np.array(data[["G1", "G2","failures", "absences"]])
    y = np.array(data[["G3"]])

    # Split the data into training and testing sets
    x_train, x_test, y_train, y_test = train_test_split(x, y, test_size=0.1)

    # Fit the linear regression model on the training data
    linear = LinearRegression()
    linear.fit(x_train, y_train)

    # Predict the output for the given input
    test_input = [[G1, G2, failures, absences]]
    prediction = linear.predict(test_input)

    pre = prediction[0][0]
    pre = int(pre)

    #for advice prediction
    x = data[["G3", "absences"]]
    y = data["advice"]

    # Split the data into training and testing sets
    x_train,x_test,y_train,y_test= train_test_split(x, y)

    # Fit the SVM model on the training data
    svm = SVC()
    svm.fit(x_train, y_train)

    # make a prediction on the input data
    input_data = np.array([[pre, absences]])
    prediction = svm.predict(input_data)

     # process the prediction and return the advice as a string
    advice = prediction[0]
    return pre,advice

#predicted_score,advice = predict_G3_score(12, 15, 2, 6)
#print("Predicted G3 score:", predicted_score)
#print("Advice:", advice)
