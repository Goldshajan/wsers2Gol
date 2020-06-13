use Gold;

create table order (
    order_id INT NOT NULL AUTO_INCREMENT,
    PRODUCT_ID INT NOT NULL,
    PRIMARY KEY (order_id),
    FOREIGN KEY (PRODUCT_ID) REFERENCES products(ID)

);