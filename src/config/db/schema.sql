CREATE DATABASE IF NOT EXISTS jiggys_web_fundamentals;

USE jiggys_web_fundamentals;

CREATE TABLE IF NOT EXISTS messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  message VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
  id VARCHAR(255) NOT NULL PRIMARY KEY,
  refresh_token TEXT,
  name TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tutorial_modules (
  number INT PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS tutorials (
  number INT,
  href VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  module_number INT,
  PRIMARY KEY(number, module_number),
  FOREIGN KEY(module_number) REFERENCES tutorial_modules(number) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS tutorial_completions (
  tutorial_number INT,
  module_number INT,
  user_id VARCHAR(255),
  PRIMARY KEY(tutorial_number, module_number, user_id),
  FOREIGN KEY(tutorial_number) REFERENCES tutorials(number) ON DELETE CASCADE,
  FOREIGN KEY(module_number) REFERENCES tutorial_modules(number) ON DELETE CASCADE,
  FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);