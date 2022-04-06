
CREATE DATABASE IF NOT EXISTS BrawndoBros;

USE BrawndoBros;


########################
# Create each table

/*create table if not exists `Users` (
	`userId` int,
	`username` varchar(75) NOT NULL,
	`email` varchar(255),
	`password` varchar(255),
	/*lastLogin varchar(255));*/



CREATE TABLE IF NOT EXISTS `users`(
	`userId` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(75) NOT NULL,
	`password` varchar(255) NOT NULL,
	`email` varchar(100) NOT  NULL,
	`create_datetime` datetime NOT NULL,
	PRIMARY KEY(`userId`)
);

CREATE TABLE IF NOT EXISTS `Plants` (
	userId int(11),
	plantNickName varchar(255),
	plantSpecies varchar(255),
	plantImage varchar(255),
	soilMoistureThreshold varchar(255),
	soilMoistureCurrent varchar(255),
	soilMoistureAction varchar(255),
	soilMoistureDosage varchar(255),
	soilTempThreshold varchar(255),
	soilTempCurrent varchar(255),
	soilTempAction varchar(255),
	soilTempDosage varchar(255),
	plantLightThreshold varchar(255),
	plantLightCurrent varchar(255),
	plantLightAction varchar(255),
	plantLightDosage varchar(255)
);

CREATE TABLE IF NOT EXISTS `PlantEvents` (
	plantId int,
	eventType varchar(255),
	eventValue varchar(255),
	eventTime varchar(255)
);

CREATE TABLE IF NOT EXISTS `ActionEvents` (
	plantId int,
	actionType varchar(255),
	actionTime varchar(255)
);