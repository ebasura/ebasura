from flask import Flask, jsonify
from flask_cors import CORS
from threading import Thread
import asyncio
from app import system_monitor

from app import live_monitoring

api_server = Flask(__name__)
CORS(api_server)


def run_flask_app():
    api_server.run(host="0.0.0.0", port=5000)


async def start_live_monitoring():
    monitoring = live_monitoring.LiveMonitoring(
        host=" 0.0.0.0",
        port=8765
    )
    await monitoring.start()


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


if __name__ == "__main__":
    # Start Flask app in a separate thread
    flask_thread = Thread(target=run_flask_app)
    flask_thread.start()

    # Run the asyncio event loop in the main thread
    asyncio.run(start_live_monitoring())
