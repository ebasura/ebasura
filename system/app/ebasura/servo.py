import RPi.GPIO as GPIO
import time

classifier_servo_pin = 18    

GPIO.setmode(GPIO.BCM)

GPIO.setup(classifier_servo_pin, GPIO.OUT)

classifier_servo = GPIO.PWM(classifier_servo_pin, 50)

classifier_servo.start(0)

def set_servo_angle(angle):
    global classifier_servo
    duty = 2 + (angle / 18)  
    classifier_servo.ChangeDutyCycle(duty)
    time.sleep(1)            
    classifier_servo.ChangeDutyCycle(0) 
    
