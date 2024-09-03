import cv2
import asyncio
import websockets
import base64


async def video_stream(websocket, path):
    # Initialize the webcam (0 is the default camera)
    cap = cv2.VideoCapture(0)

    if not cap.isOpened():
        print("Error: Could not open video device.")
        return

    try:
        while True:
            # Capture frame-by-frame
            ret, frame = cap.read()
            if not ret:
                print("Error: Failed to capture frame.")
                break

            # Encode the frame in JPEG format
            _, buffer = cv2.imencode('.jpg', frame)

            # Convert to base64 to send over WebSocket
            frame_encoded = base64.b64encode(buffer).decode('utf-8')

            # Send the frame over the WebSocket
            await websocket.send(frame_encoded)

            # Small delay to control frame rate
            await asyncio.sleep(0.033)  # ~30 FPS
    except Exception as e:
        print(f"Error: {e}")
    finally:
        cap.release()


class LiveMonitoring:

    def __init__(self, host, port):
        self.host = host
        self.port = port

    async def start(self):
        async with websockets.serve(video_stream, self.host, self.port):
            print(f"WebSocket server started at ws://{self.host}:{self.port}")
            await asyncio.Future()  # Run forever
