from flask import Blueprint, jsonify
import random

gauge_bp = Blueprint('gauge', __name__)

@gauge_bp.route('/gauge', methods=['GET'])
def gauge():
    gauge_values = {
        "recyclable_bin": random.randint(50, 100),
        "non_recyclable_bin": random.randint(50, 100),
    }
    return jsonify(gauge_values)
