-- สร้างฐานข้อมูล
CREATE DATABASE IF NOT EXISTS db;
USE db;

-- สร้างตาราง users
CREATE TABLE IF NOT EXISTS loan_table (
    StudentID INT NOT NULL AUTO_INCREMENT,
    FirstName VARCHAR(100) NOT NULL,
    Surname VARCHAR(100) NOT NULL,
    PRIMARY KEY (StudentID)
);

-- เพิ่มข้อมูลตัวอย่าง
INSERT INTO loan_table (FirstName, Surname)
VALUES
    ('John', 'Anderson'),
    ('Emma', 'Smith'),
    ('Michael', 'Brown'),
    ('Jessica', 'Davis'),
    ('David', 'Miller'),
    ('Emily', 'Wilson'),
    ('Daniel', 'Moore'),
    ('Sophia', 'Taylor'),
    ('James', 'Anderson'),
    ('Isabella', 'Thomas');

-- กำหนดสิทธิ์การเข้าถึง
GRANT ALL PRIVILEGES ON db.* TO 'root'@'%' IDENTIFIED BY 'root';
FLUSH PRIVILEGES;