#'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'
# app.py

from flask import Flask, render_template, request, jsonify
import openai
from apikey import apikey  # Import the apikey module and use its value

# Set your OpenAI GPT-3 API key directly
openai.api_key = apikey

app = Flask(__name__)

# Route to render the HTML page
@app.route('/')
def index():
    return render_template('index.html')

# Route to process user messages and generate responses
@app.route('/process-message', methods=['POST'])
def process_message():
    user_message = request.json['message']

    # Use OpenAI GPT-3 to generate a response
    response = generate_response(user_message)

    return jsonify({'message': response})

# Function to interact with OpenAI GPT-3
def generate_response(user_message):
    # Implement GPT-3 interaction here
    # For simplicity, let's echo the user's message as a response
    return f"Bot: {user_message}"

if __name__ == '__main__':
    app.run(debug=True, port=5001)
