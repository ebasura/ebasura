from flask import Flask, jsonify
from flask_cors import CORS
from ..routes.system_info import system_info_bp
from ..routes.system_health import system_health_bp
from ..routes.detection import detection_bp
from ..routes.gauge import gauge_bp


def create_app():
    app = Flask(__name__)
    CORS(app, resources={r"/*": {"origins": {"https://ebasura.online", "https://www.ebasura.online", "http://192.168.0.125:8000"}}})
    
    # Register blueprints
    app.register_blueprint(system_info_bp)
    app.register_blueprint(system_health_bp)
    app.register_blueprint(detection_bp)
    app.register_blueprint(gauge_bp)

    @app.route('/')
    def ok():
        return jsonify({
            "status": 200
        })

    return app
