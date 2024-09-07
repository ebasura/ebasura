import pymysql
import uuid
import os
from flask import Flask, jsonify, request
from flask_cors import CORS
from ..routes.system_info import system_info_bp
from ..routes.system_health import system_health_bp
from ..routes.detection import detection_bp
from ..routes.gauge import gauge_bp



def create_app():
    app = Flask(__name__)
    UPLOAD_FOLDER = 'models'    
    app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
    
    db_config = {
    'host': 'localhost',
    'user': 'root',       
    'password': 'EDscMIJndts4lAo8',   
    'db': 'monitoring_system',         
    'cursorclass': pymysql.cursors.DictCursor
}


    CORS(app, resources={r"/*": {"origins": {"https://ebasura.online", "https://www.ebasura.online", "http://192.168.0.125:8000"}}})
    
    # Register blueprints
    app.register_blueprint(system_info_bp)
    app.register_blueprint(system_health_bp)
    app.register_blueprint(detection_bp)
    app.register_blueprint(gauge_bp)
    
    def get_db_connection():
        """Create a new connection to the MariaDB database."""
        return pymysql.connect(**db_config)
    
    
    def generate_random_filename(filename):
        """Generate a random filename with the same file extension."""
        ext = os.path.splitext(filename)[1]  
        return str(uuid.uuid4()) + ext 




    @app.route('/')
    def ok():
        return jsonify({
            "status": 200
        })
    
    @app.route('/upload-model', methods=['GET', 'POST'])
    def upload():
        if 'model_file' not in request.files:
            return jsonify({"error": "No file part in the request"}), 400
        
        file = request.files['model_file']
        description = request.form.get('model_description')
        
        # Validate the file and description
        if file.filename == '':
            return jsonify({"error": "No selected file"}), 400
        
        if not description:
            return jsonify({"error": "No model description provided"}), 400

        # Save the file
        random_filename = generate_random_filename(file.filename)
        file_path = os.path.join(app.config['UPLOAD_FOLDER'], random_filename)
        file.save(file_path)

        
        try:
            connection = get_db_connection()
            with connection.cursor() as cursor:
                sql = "INSERT INTO model_uploads (description, file_path) VALUES (%s, %s)"
                cursor.execute(sql, (description, file_path))
            connection.commit()
            connection.close()
        except Exception as e:
            return jsonify({"error": str(e)}), 500

        # You can do something with the model description here (e.g., store in a database)
        return jsonify({"message": "File uploaded successfully", "description": description}), 200



    return app
