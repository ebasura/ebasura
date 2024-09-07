from threading import Thread
from app.routes import create_app


def run_flask_app():
    api_server = create_app()
    api_server.run(host="0.0.0.0", port=5000, debug=False, use_reloader=False)


if __name__ == "__main__":
    # Start Flask app in a separate thread
    flask_thread = Thread(target=run_flask_app)
    flask_thread.start()
