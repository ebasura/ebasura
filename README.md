
# E-BASURA: IoT Based Waste Segregation System
## Overview

**E-Basura** is an IoT-based waste segregation system designed to automate the waste management process at ISPSC Tagudin Campus. The system uses image recognition and IoT sensors to categorize waste into recyclable, and non-recyclable categories. It provides real-time monitoring and notifications to maintain efficient waste management.


## Installation

### Prerequisites

- Python 3.7 or higher
- Flask
- TensorFlow Lite
- Docker (optional, for containerization)
- Required Python packages (see `requirements.txt`)

### Steps

1. **Clone the Repository**

   ```bash
   git clone https://github.com/bitress/ebasura.git
   cd ebasura

2. **Set Up Virtual Environment (Recommended)**

    ```bash
        python -m venv venv
        source venv/bin/activate

3. **Install Dependencies** 
    ```bash
        pip install -r requirements.txt

4. **Configure the System**
    
    Update the configuration settings in config.py as needed. Ensure the correct paths for the TensorFlow Lite model and other settings.



5. **Run the Application**
    ```bash
        Apython main.py

## Usage
**Access the Dashboard**
- Open your web browser and navigate to http://127.0.0.1:5000 to view the dashboard.

**Monitor System Health**
- Use the System Health Monitor widget to check the status of IoT sensors, network connectivity, and system uptime.

**View Waste Segregation Statistics**
- The Waste Segregation Trends widget provides insights into the amount of waste segregated over different periods.

**Check Bin Status**
- The Bin Capacity Status widget shows the real-time capacity of each bin.

**Review Alerts and Notifications**
- The Recent Alerts & Notifications widget displays recent system alerts and user notifications.


## To-Do List

- [ ] Improved Login Design
- [ ] Implementing Sensors
- [ ] Bin Gauges, and Weights API
- [ ] Charts & Analytics Page
- [ ] Logs Page
- [ ] Analytics Backend
- [ ] Alerts and Notification
- [ ] Capture Image and Insert to Database
- [ ] Trash Bin Prototype



## Authors

- [@bitress](https://www.github.com/bitress)
