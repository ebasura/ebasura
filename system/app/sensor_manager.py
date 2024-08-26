import RPi.GPIO as GPIO
import time


class SensorManager:
    def __init__(self):
        GPIO.setmode(GPIO.BCM)
        GPIO.setwarnings(False)

        self.sortingServoMotor = 1

        self.recyclableBinEchoPin = 2
        self.recyclableBinTriggerPin = 3

        self.nonRecyclableBinEchoPin = 4
        self.nonRecyclableBinTriggerPin = 5

        self.infraredPin = 6

        GPIO.setup(self.sortingServoMotor, GPIO.OUT)

        GPIO.setup(self.recyclableBinEchoPin, GPIO.IN)
        GPIO.setup(self.recyclableBinTriggerPin, GPIO.IN)

        GPIO.setup(self.nonRecyclableBinEchoPin, GPIO.OUT)
        GPIO.setup(self.nonRecyclableBinTriggerPin, GPIO.IN)

        self.fullIndicator = {
            'recyclable': 7,  # Pin for checking if recyclable bin is full
            'non-recyclable': 8  # Pin for checking if non-recyclable bin is full
        }

        for fullIndicatorPin in self.fullIndicator.values():
            GPIO.setup(fullIndicatorPin, GPIO.OUT)

    while True:

        




if __name__ == "__main__":
    # Example usage
    sensor_manager = SensorManager()
    try:
        while True:
            data = ""
            print(f"Sensor Data: {data}")
            time.sleep(1)
    except KeyboardInterrupt:
        sensor_manager.cleanup()
