from flask import Flask, request, jsonify, render_template
import chatbot_logic

app = Flask(__name__)
app.secret_key = 'your secret key'  # replace with your secret key

@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == 'POST':
        # Handle POST request here
        pass
    return render_template('index.html')

@app.route('/handle_main_menu_input', methods=['POST'])
def handle_main_menu_input():
    user_input = request.json['user_input']
    if user_input == "1":
        response = chatbot_logic.it_support_menu()
        menuLevel = 1
    elif user_input == "2":
        response = chatbot_logic.about()
        menuLevel = 0
    elif user_input == "3":
        response = chatbot_logic.exit()
        menuLevel = 0
    else:
        response = "You didn't enter a valid option. Please try again."
        menuLevel = 0
    return jsonify({'response': response, 'menuLevel': menuLevel})

@app.route('/handle_it_support_choice', methods=['POST'])
def handle_it_support_choice():
    choice = request.json['choice']
    if choice == "1":  # If the user chose "Troubleshoot Blue Screen Error"
        response = "Please provide the error code:"
        menuLevel = 3  # Set menu level to 3 for handling blue screen error codes
    else:
        response = chatbot_logic.handle_it_support_choice(choice)
        menuLevel = 2 if choice != "12" else 0  # Set menu level to 2 when handling specific error, unless returning to main menu
    return jsonify({'response': response, 'menuLevel': menuLevel})

@app.route('/handle_error_code', methods=['POST'])
def handle_error_code():
    error_code = request.json['error_code']
    response = chatbot_logic.handle_specific_error_code(error_code)
    menuLevel = 1  # Return to IT Support Menu after handling the error code
    return jsonify({'response': response, 'menuLevel': menuLevel})

if __name__ == '__main__':
    app.run(debug=True, port=5000)
