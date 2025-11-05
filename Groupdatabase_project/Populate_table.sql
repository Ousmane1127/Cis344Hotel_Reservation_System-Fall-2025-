use hotel_reservation_sys;

Insert into employee( SSN,Position,Address,Name,Sex,Birthday) values 
("123456789", 'Manager', '123 Main St, New York, NY', 'John Smith', 'M', '1985-03-15'),
("234567890", 'Staff', '456 Oak Ave, Boston, MA', 'Sarah Johnson', 'F', '1990-07-22'),
("345678901", 'Staff', '789 Pine Rd, Chicago, IL', 'Mike Davis', 'M', '1988-11-30'),
("456789012", 'Manager', '321 Elm St, Los Angeles, CA', 'Emily Wilson', 'F', '1982-05-14'),
("567890123", 'Staff', '654 Maple Dr, Miami, FL', 'Robert Brown', 'M', '1993-09-08')
;

Insert into guest(Name,Email,Phone_Num) values 

( 'Alice Johnson', 'alice.johnson@email.com', '1234567890'),
( 'Michael Chen', 'michael.chen@email.com', '2345678901'),
( 'Sarah Williams', 'sarah.williams@email.com', '3456789012'),
( 'David Miller', 'david.miller@email.com', '4567890123'),
( 'Jessica Brown', 'jessica.brown@email.com', '5678901234')
;

insert into reservations(GuestID,Room_num,Check_IN,Check_Out) values
(1, 101, '2024-01-15 14:00:00', '2024-01-18 11:00:00' ),
(2, 205, '2024-01-16 15:00:00', '2024-01-20 12:00:00'),
(3, 312, '2024-01-17 16:00:00', '2024-01-19 10:00:00'),
(4, 104, '2024-01-18 14:00:00', '2024-01-22 11:00:00'),
(5, 208, '2024-01-19 15:00:00', '2024-01-21 12:00:00')
;

insert into transactions(GuestID,amount,Payment_Method,Date) values 
(1, 299.99, 'Credit Card', '2024-01-15 16:30:00'),
(2, 450.50, 'Debit Card', '2024-01-16 17:45:00'),
(3, 199.99, 'Cash', '2024-01-17 18:20:00'),
(4, 599.00, 'Credit Card', '2024-01-18 15:10:00'),
(5, 350.25, 'PayPal', '2024-01-19 19:05:00');
