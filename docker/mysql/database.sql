-- สร้างฐานข้อมูล
CREATE DATABASE IF NOT EXISTS db;
USE db;

-- สร้างตาราง 
CREATE TABLE loan_calculations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_price DECIMAL(13,2) NOT NULL,
    interest_rate DECIMAL(5,2) NOT NULL,
    loan_term INT NOT NULL,
    loan_amount DECIMAL(13,2) NOT NULL,
    minimum_income DECIMAL(13,2) NOT NULL,
    monthly_payment DECIMAL(13,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- กำหนดสิทธิ์การเข้าถึง
GRANT ALL PRIVILEGES ON db.* TO 'root'@'%' IDENTIFIED BY 'root';
FLUSH PRIVILEGES;