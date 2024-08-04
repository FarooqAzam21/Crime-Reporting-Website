CREATE DATABASE crimereporting;

USE crime_reporting;

CREATE TABLE crime_reports (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    report_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admin_users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    admin_id VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE feedback (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    report_id INT(6) UNSIGNED NOT NULL,
    user_id INT(6) UNSIGNED NOT NULL,
    feedback TEXT NOT NULL,
    rating INT(1) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (report_id) REFERENCES reports(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
-- Create users table if not exists
CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    phone VARCHAR(15),
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
);

-- Update crime_reports table to link reports to users
ALTER TABLE crime_reports
ADD COLUMN user_id INT(6) UNSIGNED,
ADD CONSTRAINT fk_user
FOREIGN KEY (user_id) REFERENCES users(id);

-- Create messages table for communication
CREATE TABLE IF NOT EXISTS messages (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    report_id INT(6) UNSIGNED,
    user_id INT(6) UNSIGNED,
    admin_id INT(6) UNSIGNED,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (report_id) REFERENCES crime_reports(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (admin_id) REFERENCES admin_users(id)
);


