-- Database Schema for Blogger Clone
-- Ensure you have selected the database 'rsk0_rsk0277_2' before running this script.
USE rsk0_rsk0277_2;

-- Drop table if exists to start fresh
DROP TABLE IF EXISTS posts;

-- Create the posts table
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(100) NOT NULL,
    category VARCHAR(50) DEFAULT 'General',
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert some sample data
INSERT INTO posts (title, content, author, category, image_url) VALUES
('Getting Started with Web Development', 'Web development is the work involved in developing a website for the Internet or an Intranet. Web development can range from developing a simple single static page of plain text to complex web applications, electronic businesses, and social network services.', 'Admin', 'Education', 'https://images.unsplash.com/photo-1498050108023-c5249f4df085'),
('The Future of AI', 'Artificial intelligence is intelligence demonstrated by machines, as opposed to natural intelligence displayed by animals including humans. AI research has been defined as the field of study of intelligent agents, which refers to any system that perceives its environment.', 'John Doe', 'Technology', 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b'),
('Healthy Lifestyle Tips', 'A healthy lifestyle is one which helps to keep and improve peoples health and well-being. Many governments and non-governmental organizations work at promoting healthy lifestyles. They measure the benefits with critical health numbers.', 'Jane Smith', 'Health', 'https://images.unsplash.com/photo-1506126613408-eca07ce68773');

-- Create users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
