CREATE SCHEMA IF NOT EXISTS quotes_game;
USE quotes_game;

CREATE TABLE IF NOT EXISTS quotes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author VARCHAR(45),
    quote VARCHAR(500),
    is_real TINYINT
);
