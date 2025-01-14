CREATE DATABASE jiggys_web_fundamentals;

USE jiggys_web_fundamentals;

CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  message VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
  id VARCHAR(255) NOT NULL PRIMARY KEY,
  refresh_token TEXT,
  name TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE tutorial_modules (
  id INT AUTO_INCREMENT PRIMARY KEY,
  number INT NOT NULL,
  name VARCHAR(255) NOT NULL
);

CREATE TABLE tutorials (
  href VARCHAR(255) PRIMARY KEY,
  number INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  module_id INT,
  FOREIGN KEY(module_id) REFERENCES tutorial_modules(id) ON DELETE CASCADE
);

CREATE TABLE tutorial_completions (
  tutorial_href VARCHAR(255),
  user_id VARCHAR(255),
  PRIMARY KEY(tutorial_href, user_id),
  FOREIGN KEY(tutorial_href) REFERENCES tutorials(href) ON DELETE CASCADE,
  FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);