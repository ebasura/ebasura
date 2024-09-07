import os
from dotenv import load_dotenv
import pymysql

load_dotenv()

host = os.getenv('DB_HOST')
user = os.getenv('DB_USER')
password = os.getenv('DB_PASS')
database = os.getenv('DB_DATABASE')

connection = pymysql.connect(host=host, user=user, password=password, database=database)
# Creating the cursor object
cursor = connection.cursor()
