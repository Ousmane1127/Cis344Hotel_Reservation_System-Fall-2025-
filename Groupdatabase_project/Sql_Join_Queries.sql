use hotel_reservation_sys;

-- The query below will retrieve the transactions history of our guest--

select G.Name, G.GuestID, T.Trans_ID,T.amount, T.Payment_Method, T.Date
from guest as G inner join transactions as T on G.GuestID = T.GuestID
where G.GuestID = 2;


-- This query below will retrieve all of the data on our  staff members 
select E.Name, E.Address, E.Birthday, S.StaffID 
from employee as E inner join staff as S on E.EmployeeID = S.EmpID;

-- this query will retreive reservation information for the guest
select R.ResevID, R.GuestID,R.Room_num, R.Check_IN,R.Check_Out,R.Trans_num,G.Name,G.Email,G.Phone_Num 
from guest as G inner join reservations as R on G.GuestID = R.GuestID;
