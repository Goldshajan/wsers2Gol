USE gold;
CREATE TABLE Products(
    ID INT NOT NULL AUTO_INCREMENT,
    NAME varchar(50),
    Description varchar(500),
    Price INT(10),
    Picture varchar(50),
    PRIMARY KEY (ID)
);