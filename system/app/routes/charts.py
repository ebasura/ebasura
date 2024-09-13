from flask import Blueprint, jsonify, request
from datetime import datetime
from ..engine import db

charts_bp = Blueprint('charts', __name__)

@charts_bp.route('/v1/chart', methods=['GET', 'POST'])
def dashboard_charts():
    chart_type = request.args.get('type')  

    if chart_type == 'yearly-waste-segregation':
        year = request.args.get('year')  
        if not year:
            return jsonify({"error": "Year is required for yearly waste segregation"}), 400
        return jsonify({"chart": "yearly-waste-segregation", "year": year})


    elif chart_type == 'daily-waste-segregation':
        day = request.args.get('day')  
        if not day:
            return jsonify({"error": "Day is required for daily waste segregation"}), 400
        return jsonify({"chart": "daily-waste-segregation", "day": day})

    return jsonify({"error": "Something is wrong"}), 400
