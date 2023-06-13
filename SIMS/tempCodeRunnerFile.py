from flask import Flask, request, jsonify
from flask_cors import CORS
from ml import predict_G3_score

app = Flask(__name__)
CORS(app)

# Define a route for your ML API
@app.route('/predict', methods=['POST'])
def predict():
    # Retrieve input data from the request body
    data = request.json
    
    # Perform your ML prediction using the input data
    G1= data['G1']
    G2 = data['G2']
    failures = data['failures']
    absences = data['absences']
    
    # Make your prediction using the input data
    pre, advice = predict_G3_score(G1, G2, failures, absences)
    
    # Return the prediction as a JSON response
    return jsonify({'pre': pre, 'advice': advice})

if __name__ == '__main__':
    app.run(debug=True)
