CREATE TABLE `strava`.`activities` ( `athleteID` INT NOT NULL , `name` VARCHAR NOT NULL , `distance` DOUBLE NOT NULL , `moving_time` INT NOT NULL, 'elapsed_time' INT NOT NULL, 'type' VARCHAR NOT NULL, 'id' INT NOT NULL, 'start_date' VARCHAR NOT NULL, 'start_data_local' VARCHAR NOT NULL, 'timezone' VARCHAR NOT NULL, 'trainer' BOOLEAN NOT NULL, 'commute' BOOLEAN NOT NULL, 'manual' BOOLEAN NOT NULL, 'gear_id' VARCHAR NOT NULL) ENGINE = InnoDB; 