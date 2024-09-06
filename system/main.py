from flask import Flask, jsonify
from flask_cors import CORS
from threading import Thread
from app import system_monitor, live_monitoring
import asyncio
import random

api_server = Flask(__name__)
CORS(api_server)


def run_flask_app():
    api_server.run(host="0.0.0.0", port=5000, debug=False, use_reloader=False)


# Define Flask route for system information
@api_server.route('/system-info', methods=['GET'])
def system_info():
    monitor = system_monitor.SystemMonitor()
    info = {
        "os": monitor.get_os_info(),
        "kernel_version": monitor.get_kernel_version(),
        "uptime": monitor.get_system_uptime(),
        "cpu_usage": monitor.get_cpu_usage(),
        "memory_usage": monitor.get_memory_usage(),
        "disk_usage": monitor.get_disk_usage(),
        "temperature": monitor.get_rpi_temperature_from_file()
    }
    return jsonify(info)


@api_server.route('/detection', methods=['GET'])
def detection():
    return jsonify(live_monitoring.detection())


@api_server.route('/gauge', methods=['GET'])
def gauge():
    gauge_values = {
        "recyclable_bin": random.randint(1, 100),
        "non_recyclable_bin": random.randint(1, 100),
    }
    return jsonify(gauge_values)


@api_server.route('/')
def ok():
    return jsonify({
        "status": "200",
    })


if __name__ == "__main__":
    flask_thread = Thread(target=run_flask_app)
    flask_thread.start()
