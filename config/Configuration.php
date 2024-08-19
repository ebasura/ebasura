<?php

/**
 * App Configuration
 */

// Database Configuration
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "";
const DB_NAME = "monitoring-system";

// System Configuration
const CAPSTONE_TITLE = "E-BASURA: IoT Based Waste Segregation System";
const APP_NAME = "E-Basura Web Monitoring System";
const APP_VERSION = "1.0.0";
const ENVIRONMENT = "developement";
const BASE_URL = __DIR__ . '/';

// System Notification
const NOTIFY_EMAIL = "admin@e-basura.com";
const NOTIFY_SMS = "+1234567890";
const ALERT_THRESHOLD = 90; // Percentage at which to trigger alerts


const EMAIL_CONFIRMATION = true;
const MAX_LOGIN_ATTEMPTS = 12;

const IS_SMTP = true;
const SMTP_HOST = "smtp.gmail.com";
const SMTP_USERNAME = "byteress@gmail.com";
const SMTP_PASSWORD = "vkpc dvxd hdiy lcss";
const SMTP_ENCRYPTION = "tls";
const ENCRYPTION_KEY = "YykJDLXLzeCscp7jPU/Fo65393YbmvgL0yEj4BSXkrXoaMFOBZfDjxv/eVDUMYcg"; // Remember me cookie encryption key

date_default_timezone_set('Asia/Manila');
error_reporting(E_ALL);

