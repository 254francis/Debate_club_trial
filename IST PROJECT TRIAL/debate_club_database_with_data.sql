
CREATE DATABASE IF NOT EXISTS debate_club;
USE debate_club;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role ENUM('admin', 'user') DEFAULT 'user'
);

CREATE TABLE events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  description TEXT,
  date DATE
);

CREATE TABLE resources (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  file_path VARCHAR(255),
  uploaded_by INT,
  FOREIGN KEY (uploaded_by) REFERENCES users(id)
);

CREATE TABLE video_links (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  url TEXT
);

CREATE TABLE groups (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100)
);

CREATE TABLE group_members (
  group_id INT,
  user_id INT,
  FOREIGN KEY (group_id) REFERENCES groups(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE finances (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100),
  amount DECIMAL(10,2),
  type ENUM('expense','income'),
  date DATE
);

CREATE TABLE feedback (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  message TEXT,
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE chat (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  message TEXT,
  sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert admin user (password is 'admin123' hashed using PHP's password_hash)
INSERT INTO users (name, email, password, role) VALUES 
('Admin User', 'admin@debateclub.com', '$2y$10$YeWX1nrB6lXyeAcv6jY9IOTRjXwEgv9H70g7QHmcSTgJPtKZzpTc6', 'admin');

-- Insert sample user
INSERT INTO users (name, email, password, role) VALUES 
('Jane Doe', 'jane@example.com', '$2y$10$YeWX1nrB6lXyeAcv6jY9IOTRjXwEgv9H70g7QHmcSTgJPtKZzpTc6', 'user');

-- Sample events
INSERT INTO events (title, description, date) VALUES
('Inter-University Debate Championship', 'Regional round at Kenyatta University', '2025-08-10'),
('Public Speaking Workshop', 'Training workshop on persuasive speech', '2025-08-15');

-- Sample finances
INSERT INTO finances (title, amount, type, date) VALUES
('Venue Booking', 20000.00, 'expense', '2025-07-01'),
('Club Donation', 10000.00, 'income', '2025-07-05');

-- Sample chats
INSERT INTO chat (user_id, message) VALUES
(1, 'Hi team! Let’s be ready for the upcoming debate.'),
(2, 'Got it! I’m preparing the documents now.');

-- Sample feedback
INSERT INTO feedback (user_id, message) VALUES
(2, 'I really enjoyed the last debate session. Looking forward to more!');

-- Sample video links
INSERT INTO video_links (title, url) VALUES
('Final Round - EUDC 2023', 'https://www.youtube.com/watch?v=dummy_eudc_2023'),
('WUDC 2024 Grand Final', 'https://www.youtube.com/watch?v=dummy_wudc_2024');

-- Sample groups
INSERT INTO groups (name) VALUES
('Novice Training Squad'),
('Advanced Debaters Team');

-- Sample group members
INSERT INTO group_members (group_id, user_id) VALUES
(1, 2),  -- Jane in Novice
(2, 1);  -- Admin in Advanced

-- Sample resources
INSERT INTO resources (title, file_path, uploaded_by) VALUES
('Introduction to BP Debate', 'resources/intro_bp_debate.pdf', 1),
('Rebuttal Techniques', 'resources/rebuttal_tips.docx', 1);


-- CalicoTab-style tournament resource links
INSERT INTO resources (title, file_path, uploaded_by) VALUES
('WUDC 2025 PANAMA Motions (CalicoTab)', 'https://wudc2025.calicotab.com/open/motions/', 1),
('PAUDC 2024 KAMPALA USIU TEAM TAB (CalicoTab)', 'https://paudc2024.calicotab.com/paudcK24/participants/team/215168/', 1),
('AGONIA 2025 SPEAKER TAB', 'https://inspired.calicotab.com/Agonia2025/tab/speaker/Open/', 1),
('EUDC 2024 GLASGOW Motions Tab', 'https://eudc2024.calicotab.com/_/motions/statistics/', 1);

