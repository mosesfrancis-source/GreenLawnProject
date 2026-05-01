-- SQL schema for Green Lawn Fargo
CREATE DATABASE IF NOT EXISTS green_lawn_fargo DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE green_lawn_fargo;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  is_admin TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  description TEXT,
  price DECIMAL(8,2) DEFAULT 0.00
);

CREATE TABLE IF NOT EXISTS bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  service_id INT NOT NULL,
  service_date DATE NULL,
  status VARCHAR(50) DEFAULT 'requested',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- Sample services
INSERT INTO services (name, description, price) VALUES
('Mowing', 'Standard lawn mowing', 35.00),
('Edging', 'Professional edging and trimming', 20.00),
('Fertilization', 'Seasonal lawn fertilization', 60.00);

-- Sample admin user (password: admin123) - update password after import
INSERT INTO users (username, email, password, is_admin) VALUES
('admin', 'admin@example.com', '$2y$10$exampleplaceholderhash0000000000000000000000', 1);
