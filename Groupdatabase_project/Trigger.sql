
Select Version();

DELIMITER //

CREATE TRIGGER Emp_position
AFTER INSERT ON employee
FOR EACH ROW
BEGIN
    IF new.Position = 'Manager' THEN 
        Insert into manager(EmpID) values (new.EmployeeID);
    ELSEIF new.Position = 'Staff' THEN 
        Insert into staff (EmpID) values (new.EmployeeID);
    END IF;
END//

DELIMITER ;

DELIMITER //

create trigger Charges
after insert On transactions 
for each row  begin
Insert into charges (GuestID,TransID) values (new.GuestID, new.TransID);
end//
DELIMITER ;

Select * from staff;
describe transactions;
describe employee;