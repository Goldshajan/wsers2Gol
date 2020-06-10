create database TestExample;
use TestExample;
 
CREATE TABLE Products (
    ID INT NOT NULL AUTO_INCREMENT, 
    Name VARCHAR(50) NOT NULL,  
    Description VARCHAR(500),
    Price INT NOT NULL,
    Picture VARCHAR(50),
    PRIMARY KEY (ID)
    );
 
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Carrots","Yummy vegetable", 1, "carrot.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Tomatoes","Red vegetable that makes you healthy", 3, "tomato.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Cucumber","Green thing vegetable", 4, "cucumber.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("GreenPeas","Small ones", 10, "greenPeas.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Potatoes","They stay in the ground", 1, "Potato.jpg");
 
COMMIT;