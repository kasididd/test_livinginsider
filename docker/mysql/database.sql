use db;

CREATE TABLE studens(
    StudentID int not null AUTO_INCREMENT,
    FirstName varchar(100) not null,
    Surname varchar(100) not null,
    PRIMARY KEY (StudentID)
);

INSERT INTO students(FirstName, Surname)
VALUES("John","Anderson"),("Emma","Smith");

GRANT ALL PRIVILEGES ON yourdatabase.* TO 'root'@'%' IDENTIFIED BY 'root';
FLUSH PRIVILEGES;