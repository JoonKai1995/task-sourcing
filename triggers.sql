
-------------------------------------------------------------------
-- Trigger to check if bids exists for task to be updated
-- if bids exists, reject the update
DROP FUNCTION checkIfBidsExists() CASCADE;

CREATE OR REPLACE FUNCTION checkIfBidsExists() 
RETURNS TRIGGER AS $$
BEGIN
IF (NEW.task_allocated != OLD.task_allocated)
THEN RETURN NEW;
END IF;
IF EXISTS( SELECT btask_id FROM bids WHERE btask_id = NEW.task_id)
THEN RETURN NULL;
ELSE
RETURN NEW;
END IF;
END; $$
LANGUAGE PLPGSQL;

CREATE TRIGGER ifBidsExists
BEFORE UPDATE ON tasks
FOR EACH ROW 
EXECUTE PROCEDURE checkIfBidsExists();
-------------------------------------------------------------------
-- Trigger to check if there are outdated task in the table
-- if there are, remove them
DROP FUNCTION deleteOutdateTasks() CASCADE;

CREATE OR REPLACE FUNCTION deleteOutdateTasks()
RETURNS TRIGGER AS $$
BEGIN
DELETE FROM tasks WHERE task_date < current_date OR 
		(task_date = current_date AND task_time <= current_time);
RETURN NEW;
END; $$
LANGUAGE PLPGSQL;

CREATE TRIGGER deleteOutdatedTasks
BEFORE UPDATE ON tasks
FOR EACH ROW 
EXECUTE PROCEDURE deleteOutdateTasks();
--------------------------------------------------------------------
-- Trigger to set task allocated to true from submits table if allocated
DROP FUNCTION checkifAllocated() CASCADE;

CREATE OR REPLACE FUNCTION checkifAllocated()
RETURNS TRIGGER AS $$
BEGIN
UPDATE tasks SET task_allocated = '1' WHERE task_id = NEW.atask_ID;
RETURN NEW;
END; $$
LANGUAGE PLPGSQL;

CREATE TRIGGER checkifAllocated
AFTER INSERT ON allocated
FOR EACH ROW
EXECUTE PROCEDURE checkifAllocated();
--------------------------------------------------------------------