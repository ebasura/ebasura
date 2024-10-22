<?php

/**
 * App Configuration
 */

// Database Configuration
const DB_HOST = "139.99.97.250";
const DB_USER = "ebasura";
const DB_PASS = "kWeGKUsHM1nNIf-P";
const DB_NAME = "monitoring_system";

// System Configuration
const CAPSTONE_TITLE = "E-BASURA: IoT Based Waste Segregation System";
const APP_NAME = "E-Basura Web Monitoring System";
const APP_VERSION = "1.0.0";
const ENVIRONMENT = "development";
const BASE_URL = __DIR__ . '/';
const MAX_UPLOAD_SIZE = 10 * 1024 * 1024;

// System Notification
const NOTIFY_EMAIL = "admin@e-basura.com";

const EMAIL_CONFIRMATION = false;
const MAX_LOGIN_ATTEMPTS = 12;


const IS_SMTP = true;
const SMTP_HOST = "smtp.gmail.com";
const SMTP_USERNAME = "byteress@gmail.com";
const SMTP_PASSWORD = "vkpc dvxd hdiy lcss";
const SMTP_ENCRYPTION = "tls";
const ENCRYPTION_KEY = "YykJDLXLzeCscp7jPU/Fo65393YbmvgL0yEj4BSXkrXoaMFOBZfDjxv/eVDUMYcg"; // Remember me cookie encryption key

date_default_timezone_set('Asia/Manila');
error_reporting(E_ALL);