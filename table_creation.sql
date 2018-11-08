CREATE TABLE users (

	username VARCHAR(64) NOT NULL,
	user_id NUMERIC UNIQUE NOT NULL,
	password VARCHAR(64) NOT NULL,
	PRIMARY KEY (username)
);

CREATE TABLE tasks (

	task_id NUMERIC PRIMARY KEY NOT NULL,
	task_description VARCHAR(255),
	location VARCHAR(64),
	task_date DATE NOT NULL,
	task_time TIME NOT NULL,
	task_allocated BOOLEAN DEFAULT FALSE,
	task_completion BOOLEAN DEFAULT FALSE,
	
	CONSTRAINT check_date_time CHECK(task_date > current_date OR 
		(task_date = current_date AND task_time >= current_time))
);

CREATE TABLE administrators (
	admin_id VARCHAR(64) PRIMARY KEY NOT NULL,
	username VARCHAR(64) NOT NULL,
	password VARCHAR(64) NOT NULL
);

CREATE TABLE submits (
	suser_ID NUMERIC NOT NULL,
	stask_ID NUMERIC NOT NULL,
	FOREIGN KEY (suser_ID) REFERENCES users(user_ID) ON DELETE CASCADE,
	FOREIGN KEY (stask_ID) REFERENCES tasks(task_ID) ON DELETE CASCADE,
    PRIMARY KEY (suser_ID, stask_ID)
);

CREATE TABLE bids (
	bid_value NUMERIC NOT NULL,
	buser_ID NUMERIC NOT NULL,
	btask_ID NUMERIC NOT NULL,
	suser_ID NUMERIC NOT NULL,
	PRIMARY KEY (buser_ID, btask_ID),
	FOREIGN KEY (suser_ID, btask_ID) REFERENCES submits(suser_ID, stask_ID) ON DELETE CASCADE,
	FOREIGN KEY (buser_ID) REFERENCES users(user_ID) ON DELETE CASCADE,
	CONSTRAINT buser_ID CHECK (buser_ID <> suser_ID)
);

CREATE TABLE allocated (
	auser_ID NUMERIC NOT NULL,
	atask_ID NUMERIC NOT NULL,
	suser_ID NUMERIC NOT NULL,
	PRIMARY KEY (auser_ID, atask_ID),
	FOREIGN KEY (suser_ID, atask_ID) REFERENCES submits(suser_ID, stask_ID) ON DELETE CASCADE,
	FOREIGN KEY (auser_ID, atask_ID) REFERENCES bids(buser_ID, btask_ID) ON DELETE CASCADE
);
