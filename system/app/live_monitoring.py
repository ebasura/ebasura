import cv2
import tflite_runtime.interpreter as tflite
import numpy as np
import cv2
import asyncio
import websockets
import base64

# Path to the TensorFlow Lite model and labels file
model_path = "models/vww_96_grayscale_quantized.tflite"
labels_path = "models/labels.txt"

# Load the labels
with open(labels_path, 'r') as f:
    labels = [line.strip() for line in f.readlines()]

# Initialize TensorFlow Lite interpreter
interpreter = tflite.Interpreter(model_path=model_path)
interpreter.allocate_tensors()

# Get input and output details
input_details = interpreter.get_input_details()
output_details = interpreter.get_output_details()

predicted_label = ""
frame_encoded = ""


# Function to preprocess a frame from the camera
def preprocess_frame(frame):
    frame_gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    frame_resized = cv2.resize(frame_gray, (96, 96))
    input_data = np.expand_dims(frame_resized, axis=0)
    input_data = np.expand_dims(input_data, axis=-1)
    input_data = input_data.astype(np.float32)
    return input_data


# Function to run inference on a frame
def run_inference(frame):
    input_data = preprocess_frame(frame)
    interpreter.set_tensor(input_details[0]['index'], input_data)
    interpreter.invoke()
    output_data = interpreter.get_tensor(output_details[0]['index'])
    predicted_class_index = np.argmax(output_data)
    return predicted_class_index


async def video_stream(websocket, path):
    global predicted_label, frame_encoded

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

                # Run inference on the frame
            predicted_class_index = run_inference(frame)

            # Check if predicted class index is within labels bounds
            if predicted_class_index < len(labels):
                predicted_label = labels[predicted_class_index]
            else:
                predicted_label = "Unknown"

            # Display the frame with predicted label
            cv2.putText(frame, predicted_label, (20, 50), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2)
            # cv2.imshow('Camera', frame)

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

    def detection(self):
        data = {
            "predicted_label": predicted_label,
            "image": frame_encoded
        }
        return data

    async def start(self):
        async with websockets.serve(video_stream, self.host, self.port):
            print(f"WebSocket server started at ws://{self.host}:{self.port}")
            await asyncio.Future()  # Run forever
