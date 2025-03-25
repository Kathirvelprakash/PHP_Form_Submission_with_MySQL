CREATE DATABASE user_data;

USE user_data;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    age INT NOT NULL CHECK (age > 0),  -- No negative values
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    hobbies TEXT,
    country VARCHAR(100) NOT NULL,
    bio TEXT,
    profile_picture VARCHAR(255) NOT NULL
);