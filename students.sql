CREATE DATABASE if not exists students;

USE students;

CREATE TABLE if not exists students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL
);

INSERT INTO students (name, age) VALUES ('John Doe', 20);
INSERT INTO students (name, age) VALUES ('Jane Smith', 22);
INSERT INTO students (name, age) VALUES ('Michael Johnson', 19);
INSERT INTO students (name, age) VALUES ('Emily Davis', 21);
INSERT INTO students (name, age) VALUES ('Daniel Wilson', 23);
