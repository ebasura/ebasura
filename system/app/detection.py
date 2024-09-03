import cv2
import tflite_runtime.interpreter as tflite
import numpy as np
import base64
import asyncio
import websockets

class WasteSegregationSystem:
    def __init__(self, model_path, labels_path, websocket_url):
        self.model_path = model_path
        self.labels_path = labels_path
        self.websocket_url = websocket_url
        self.interpreter = self.load_model()
        self.labels = self.load_labels()
        self.input_details = self.interpreter.get_input_details()
        self.output_details = self.interpreter.get_output_details()

    def load_model(self):
        interpreter = tflite.Interpreter(model_path=self.model_path)
        interpreter.allocate_tensors()
        return interpreter

    def load_labels(self):
        with open(self.labels_path, 'r') as f:
            return [line.strip() for line in f.readlines()]

    def preprocess_frame(self, frame):
        frame_gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        frame_resized = cv2.resize(frame_gray, (96, 96))
        input_data = np.expand_dims(frame_resized, axis=0)
        input_data = np.expand_dims(input_data, axis=-1)
        input_data = input_data.astype(np.float32)
        return input_data

    def run_inference(self, frame):
        input_data = self.preprocess_frame(frame)
        self.interpreter.set_tensor(self.input_details[0]['index'], input_data)
        self.interpreter.invoke()
        output_data = self.interpreter.get_tensor(self.output_details[0]['index'])
        predicted_class_index = np.argmax(output_data)
        return predicted_class_index

    async def send_frame_over_websocket(self, frame):
        async with websockets.connect(self.websocket_url) as websocket:
            # Convert the frame to JPEG
            _, buffer = cv2.imencode('.jpg', frame)
            # Convert to base64
            frame_encoded = base64.b64encode(buffer).decode('utf-8')
            # Send the frame over WebSocket
            await websocket.send(frame_encoded)

    async def process_video(self):
        cap = cv2.VideoCapture(0)
        if not cap.isOpened():
            print("Error: Could not open camera.")
            return

        while True:
            ret, frame = cap.read()
            if not ret:
                print("Error: Failed to capture image from camera.")
                break

            predicted_class_index = self.run_inference(frame)

            if predicted_class_index < len(self.labels):
                predicted_label = self.labels[predicted_class_index]
            else:
                predicted_label = "Unknown"

            cv2.putText(frame, predicted_label, (20, 50), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2)
            cv2.imshow('Camera', frame)

            if predicted_label == 'recyclable':
                print("Recyclable detected!")
            elif predicted_label == 'non-recyclable':
                print("Non-recyclable detected!")
            else:
                print("Nothing is detected!")

            # Send the frame over WebSocket
            await self.send_frame_over_websocket(frame)

            if cv2.waitKey(1) == 27:  # ESC key
                break

        cap.release()
        cv2.destroyAllWindows()

# Example usage
model_path = "../models/vww_96_grayscale_quantized.tflite"
labels_path = "../models/labels.txt"
websocket_url = "ws://your_websocket_server_url"

waste_system = WasteSegregationSystem(model_path, labels_path, websocket_url)
asyncio.run(waste_system.process_video())
