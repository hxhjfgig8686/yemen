-- install.sql
-- إنشاء قاعدة البيانات
CREATE DATABASE IF NOT EXISTS sms_api;
USE sms_api;

-- جدول المستخدمين (للـ API)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    api_key VARCHAR(64) UNIQUE NOT NULL,
    is_active BOOLEAN DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- جدول الأرقام (الكومبوات)
CREATE TABLE IF NOT EXISTS numbers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    number VARCHAR(20) UNIQUE NOT NULL,
    country_code VARCHAR(10),
    is_used BOOLEAN DEFAULT 0,
    is_deleted BOOLEAN DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_country (country_code),
    INDEX idx_used (is_used)
);

-- جدول الرسائل (الأكواد)
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    number_id INT,
    number VARCHAR(20) NOT NULL,
    message TEXT,
    otp_code VARCHAR(20),
    service VARCHAR(50),
    received_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_number (number),
    INDEX idx_otp (otp_code),
    FOREIGN KEY (number_id) REFERENCES numbers(id) ON DELETE CASCADE
);

-- جدول السجلات
CREATE TABLE IF NOT EXISTS logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    action VARCHAR(100),
    details TEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- جدول المشرفين
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'admin',
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- إضافة مستخدم تجريبي للـ API
INSERT INTO users (username, api_key) VALUES 
('test_user', 'sk_cc1480ac5e3a4818e07fb4b0674bc2a72228372220dba26ac4579cfd4eda903b');

-- إضافة مشرف
INSERT INTO admins (username, password) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'); -- password: password

-- إضافة بعض الأرقام التجريبية
INSERT INTO numbers (number, country_code) VALUES
('201234567890', '20'),
('201234567891', '20'),
('966501234567', '966'),
('971501234567', '971'),
('15551234567', '1');