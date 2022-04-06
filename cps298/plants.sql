
CREATE DATABASE IF NOT EXISTS LoginSystem;

USE LoginSystem;

CREATE TABLE IF NOT EXISTS plants (
	`plantid` int(11) NOT NULL ,
	`plantname` text NOT NULL,
	`plantspecies` varchar(255) NOT NULL,
	`plantimage` LONGBLOB NOT  NULL,
	`mositureThreshold` varchar(255) NOT NULL,
	`moistureCurrent` varchar(255) NOT NULL,
	`moistureAction` varchar(255) NOT NULL,
	`TempThreshold` varchar(255) NOT NULL,
	`TempCurrent` varchar(255) NOT NULL,
	`TempAction` varchar(255) NOT NULL,
	`TempDosage` varchar(255) NOT NULL,
	`LightThreshold` varchar(255) NOT NULL,
	`LightCurrent` datetime NOT NULL,
	`LightAction` datetime NOT NULL,
	`LightDosage` datetime NOT NULL
	/*PRIMARY KEY(`plantid`)
	FOREIGN KEY(id) REFERENCES users(id)*/
);

CREATE TABLE `events`(
	`eventid` int(11) NOT NULL ,
	/*`plantid` int(11) NOT NULL AUTO_INCREMENT,*/
	`eventtype` varchar(255) NOT NULL,
	`value` varchar(255) NOT NULL,
	`eventtime` TIMESTAMP NOT NULL
	/*PRIMARY KEY(`eventid`),
	FOREIGN KEY(plantid) REFERENCES plants(plantid)*/
);

	CREATE TABLE `actions`(
	`actionid` int(11) NOT NULL,
	/*`plantid` int(11) NOT NULL AUTO_INCREMENT,*/
	`actiontype` varchar(255) NOT NULL,
	`actiontime` TIMESTAMP NOT NULL
	/*PRIMARY KEY(`actionid`),
	FOREIGN KEY(plantid) REFERENCES plants(plantid)*/
);
	