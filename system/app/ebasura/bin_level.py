import RPi.GPIO as GPIO
import time
from ..engine import db 
GPIO.setmode(GPIO.BCM)

TRIG_BIN_ONE = 2  # GPIO 2 (Pin 3)
ECHO_BIN_ONE = 3  # GPIO 3 (Pin 5)

# TRIG_BIN_TWO = 4  # GPIO 4 (Pin 7)
# ECHO_BIN_TWO = 17 # GPIO 17 (Pin 11)

GPIO.setup(TRIG_BIN_ONE, GPIO.OUT)
GPIO.setup(ECHO_BIN_ONE, GPIO.IN)

# GPIO.setup(TRIG_BIN_TWO, GPIO.OUT)
# GPIO.setup(ECHO_BIN_TWO, GPIO.IN)


def measure_distance(trigger, echo):

    GPIO.output(trigger, False)
    time.sleep(2)
    

    GPIO.output(trigger, True)
    time.sleep(0.00001)
    GPIO.output(trigger, False)
    
    while GPIO.input(echo) == 0:
        pulse_start = time.time()

    while GPIO.input(echo) == 1:
        pulse_end = time.time()

    pulse_duration = pulse_end - pulse_start
    
    # Speed of sound is 34300 cm/s, so distance is time * speed / 2
    distance = pulse_duration * 17150
    distance = round(distance, 2)

    return distance

def recyclable_bin():
    try:
        while True:
            time.sleep(5)
            update_bin_level(1, measure_distance(TRIG_BIN_ONE, ECHO_BIN_ONE))    
    except KeyboardInterrupt: 
        print("Keyboard interrupt")
        
        
def non_recyclable_bin():
    try:
        while True:
            time.sleep(5)
            update_bin_level(2, measure_distance(TRIG_BIN_TWO, ECHO_BIN_TWO))    
    except KeyboardInterrupt:
        print("Keyboard interrupt")


def update_bin_level(bin_id, distance):

    distance = distance if distance <= 100 else 100
    

    query = """
    UPDATE waste_bins 
    SET current_fill_level = %s, last_update = NOW()
    WHERE bin_id = %s
    """
    args = (distance, bin_id)

    if db.update(query, args):
        print(f"Updated bin {bin_id} with level {distance} cm.")
    else:
        print(f"Failed to update bin {bin_id}.")

