/**
 * This file contains the basic database schema for the application
 *
 * @author Tong Liu
 */
CREATE TABLE RESTAURANT
(
	RESTAURANTID VARCHAR(10) PRIMARY KEY,
	DESCRIPTION VARCHAR(150),
	NAME VARCHAR(50),
	TYPE VARCHAR(20),
	URL VARCHAR(100)
);

CREATE TABLE RATER
(
	USERID VARCHAR(25) PRIMARY KEY,
	EMAIL VARCHAR(40),
	RATER_NAME VARCHAR(35),
	JOIN_DATE DATE,
	RATER_TYPE VARCHAR(25),
	REPUTATION INT CHECK (REPUTATION <= 5 AND REPUTATION >= 1) DEFAULT 1
);

CREATE TABLE RATING
(
	USERID VARCHAR(25) NOT NULL DEFAULT 'Guest00',
	DATEPUB DATE,
	RESTAURANTID VARCHAR(10),
	PRICE DECIMAL(2,1) CHECK (PRICE <= 5 AND PRICE >= 1),
	FOOD DECIMAL(2,1) CHECK (FOOD <= 5 AND FOOD >= 1),
	MOOD DECIMAL(2,1) CHECK (MOOD <= 5 AND MOOD >= 1),
	STAFF DECIMAL(2,1) CHECK (STAFF <= 5 AND STAFF >= 1),
	COMMENTS VARCHAR(125),
	PRIMARY KEY (USERID,DATEPUB, RESTAURANTID),
	FOREIGN KEY (USERID) REFERENCES RATER(USERID) ON DELETE SET DEFAULT ON UPDATE CASCADE,
	FOREIGN KEY (RESTAURANTID) REFERENCES RESTAURANT(RESTAURANTID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE LOCATION
(
	LOCATIONID VARCHAR(10) PRIMARY KEY,
	FIRST_OPEN_DATE DATE,
	MANAGER_NAME VARCHAR(15),
	PHONE_NUM VARCHAR (15),
	STREET_ADDRESS VARCHAR(50),
	HOUR_OPEN TIME,
	HOUR_CLOSE TIME,
	RESTAURANTID VARCHAR(10),
	CONSTRAINT LOCATION_RESTAURANT_FK
	FOREIGN KEY (RESTAURANTID) REFERENCES RESTAURANT(RESTAURANTID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE MENUITEM
(
	ITEMID VARCHAR(5) PRIMARY KEY,
	RESTAURANTID VARCHAR(10),
	MI_NAME VARCHAR(30), 
	MI_TYPE VARCHAR(15),
	CATEGORY VARCHAR(15),
	DESCRIPTION VARCHAR(125),
	PRICE DECIMAL(8,2),
	FOREIGN KEY (RESTAURANTID) REFERENCES RESTAURANT(RESTAURANTID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE RATINGITEM
(
	USERID VARCHAR(25) NOT NULL DEFAULT 'Guest00',
	DATEPUB DATE,
	ITEMID VARCHAR(10),
	RATING DECIMAL(2,1) CHECK (RATING <= 5 AND RATING >= 1),
	COMMENT VARCHAR(125),
	PRIMARY KEY (USERID, DATEPUB, ITEMID),
	CONSTRAINT RATINGITEM_FK
	FOREIGN KEY (USERID) REFERENCES RATER(USERID) ON DELETE SET DEFAULT ON UPDATE CASCADE,
	FOREIGN KEY (ITEMID) REFERENCES MENUITEM(ITEMID) ON DELETE CASCADE ON UPDATE CASCADE
);