USE crime_reporting;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);

CREATE TABLE crime_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    cnic VARCHAR(15) NOT NULL,
    phone VARCHAR(12) NOT NULL,
    date DATE NOT NULL,
    description TEXT NOT NULL,
    report_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
