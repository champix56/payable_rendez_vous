CREATE TABLE wp_rdv_consultant(
    ID BIGINT(20) REFERENCES wp_users(ID),
    biography VARCHAR(1024),
    PRIMARY KEY (ID)
);
CREATE TABLE wp_rdv_prestation_type(
	ID int PRIMARY KEY,    
    short_name varchar(10),
    display_name varchar(34),
    description varchar (512),
    montant DECIMAL,
    temp_nominal int
);
CREATE TABLE wp_rdv_apointment_state(
    ID INT PRIMARY KEY,
    short_name VARCHAR(10),
    display_name VARCHAR(32),
    valid_level INT UNIQUE
);
CREATE TABLE wp_rdv_take_apointment(
    consultationID BIGINT(20) UNIQUE AUTO_INCREMENT,
    consultantID BIGINT(20) REFERENCES wp_users(ID),
    clientID BIGINT(20) REFERENCES wp_users(ID),
    stateID INT REFERENCES wp_rdv_apointment_state(ID) DEFAULT '-999',
    date DATE ,
    time TIME,
    validation_date TIMESTAMP DEFAULT now(),
    prestation_type_ID int REFERENCES wp_rdv_prestation_type(ID),
    PRIMARY KEY (consultantID,clientID, date, time)
);
CREATE TABLE wp_rdv_consultant_availabilities(
    consultantID BIGINT(20) REFERENCES wp_users(ID) ,
    day_of_week SMALLINT,
    time_start TIME,
    time_end TIME,
    PRIMARY KEY(consultantID,day_of_week,time_start,time_end)
);
CREATE TABLE wp_rdv_consultant_unavailabilities(
    consultantID BIGINT(20) REFERENCES wp_users(ID),
    start DATETIME,
    end DATETIME,
    PRIMARY KEY(consultantID,start,end)
);
CREATE TABLE wp_rdv_rendezvous_follows(
    questionID BIGINT(20) AUTO_INCREMENT,
    consultationID BIGINT(20) REFERENCES wp_rdv_take_apointment(consultationID),
    question varchar(128),
    answer varchar(2048),
    PRIMARY KEY(questionID,consultationID)
);
