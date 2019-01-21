#Creating database for Online Learning System
CREATE DATABASE OLS_DB;

#Creating User table.

CREATE TABLE ols_user(
   `uid` INT(11) NOT NULL AUTO_INCREMENT,
   `user_name` VARCHAR(100) NOT NULL,
   `first_name` VARCHAR(40) NOT NULL,
   `last_name` VARCHAR(40) NOT NULL,
   `gender` VARCHAR(1) NOT NULL,
   `email` VARCHAR(50) NOT NULL,
   `dob` DATE,
   `registration_date` DATE,
   `rid` INT(11),
   `password` VARCHAR(50) NOT NULL,
   `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY ( `uid` )
);


CREATE TABLE ols_user_register(
   `regid` INT(11) NOT NULL AUTO_INCREMENT,
   `uid` INT(11) NOT NULL,
   `cid` INT(11) NOT NULL,
   PRIMARY KEY ( `regid` )
);

CREATE TABLE ols_role(
    `rid` INT(11) NOT NULL AUTO_INCREMENT,
    `role` VARCHAR(50),
    PRIMARY KEY ( `rid` )
);

CREATE TABLE ols_course(
    `cid` INT(11) NOT NULL AUTO_INCREMENT,
    `course` VARCHAR(50),
    `uid` INT(11) NOT NULL,
    PRIMARY KEY ( `cid` )
);

CREATE TABLE ols_module(
    `mid` INT(11) NOT NULL AUTO_INCREMENT,
    `module` VARCHAR(50),
    `cid` VARCHAR(50),
    PRIMARY KEY ( `mid` )
);

CREATE TABLE ols_topic(
    `tid` INT(11) NOT NULL AUTO_INCREMENT,
    `topic` VARCHAR(50),
    `cid` VARCHAR(50),
    `mid` VARCHAR(50),
    `name` VARCHAR(200) NOT NULL,
    `type` VARCHAR(30) NOT NULL,
    `size` int(11) NOT NULL,
    `content` mediumblob NOT NULL,
    PRIMARY KEY ( `tid` )
);

ALTER TABLE ols_topic
ADD `name` VARCHAR(200) NOT NULL;

ALTER TABLE ols_topic
ADD `type` VARCHAR(30) NOT NULL;

ALTER TABLE ols_topic
ADD `size` int(11) NOT NULL;

ALTER TABLE ols_topic
ADD `content` mediumblob NOT NULL;

CREATE TABLE ols_question(
    `qid` INT(11) NOT NULL AUTO_INCREMENT,
    `qdesc` VARCHAR(50),
    `choice1` VARCHAR(200) NOT NULL,
    `choice2` VARCHAR(200) NOT NULL,
    `choice3` VARCHAR(200) NOT NULL,
    `choice4` VARCHAR(200) NOT NULL,
    `solution` VARCHAR(200) NOT NULL,
    `uid` INT(11) NOT NULL,
    `cid` INT(11) NOT NULL,
    `q_type` INT(11) NOT NULL,
    `q_status` VARCHAR(5) NOT NULL,
    PRIMARY KEY ( `qid` )
);

CREATE TABLE ols_publish_exam(
    `pid` INT(11) NOT NULL AUTO_INCREMENT,
    `uid` INT(11) NOT NULL,
    `cid` INT(11) NOT NULL,
    `p_status` VARCHAR(5) NOT NULL,
    PRIMARY KEY ( `pid` )
);

CREATE TABLE ols_user_attempt(
    `aid` INT(11) NOT NULL AUTO_INCREMENT,
    `cid` INT(11) NOT NULL,
    `uid` INT(11) NOT NULL,
    `score` INT(3) NOT NULL,
    PRIMARY KEY (`aid`)
);

ALTER TABLE ols_user_attempt
ADD `correct_answer` VARCHAR(3) NOT NULL;

ALTER TABLE ols_user_attempt
ADD `total_question` VARCHAR(3) NOT NULL;



  
INSERT into ols_user_register (regid,uid,cid) VALUES (NULL,1, 1);
INSERT into ols_user_register (regid,uid,cid) VALUES (NULL,1, 2);
INSERT into ols_user_register (regid,uid,cid) VALUES (NULL,3, 1);
INSERT into ols_user_register (regid,uid,cid) VALUES (NULL,3, 2);

INSERT into ols_user_register (regid,uid,cid) VALUES (NULL,1, 3);
INSERT into ols_user_register (regid,uid,cid) VALUES (NULL,3, 3);

INSERT into ols_course (cid, course, uid) VALUES (NULL, 'Software engineering', 5);
INSERT into ols_course (cid, course, uid) VALUES (NULL, 'Operating System', 5);

INSERT into ols_course (cid, course, uid) VALUES (NULL, 'HCI', 11);
INSERT into ols_course (cid, course, uid) VALUES (NULL, 'Computer Algorithms', 11);

INSERT into ols_user_register (regid,uid,cid) VALUES (NULL,1, 4);
INSERT into ols_user_register (regid,uid,cid) VALUES (NULL,1, 5);

INSERT into ols_user_register (regid,uid,cid) VALUES (NULL,1, 6);
INSERT into ols_user_register (regid,uid,cid) VALUES (NULL,1, 7);




