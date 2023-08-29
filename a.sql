--  Creating the table admin
create table admin
( 
  admin_email varchar(100) primary key,
  admin_name varchar(100),
  admin_password varchar(100)
);
--  Creating the withdraws_driver

create table withdraws_driver
( 
  serial_number SERIAL primary key,
  withdraw_account varchar(100),
  withdraw_amount varchar(100),
  driver_email varchar(100),
  withdraw_time varchar(100)
);
--  Creating the withdraws_associate


create table withdraws_associate(
  associate_withdraw_id SERIAL primary key,
  associate_email varchar(100),
  associate_withdraw_amount varchar(100),
  associate_withdraw_time varchar(20),
  withdraw_account varchar(100)
);

--  Creating the table rides

create table rides
( 
  ride_id SERIAL primary key,
  origin varchar(300),
  destination varchar(300),
  distance float(4,2),
  amount float(5,2),
  associate_email varchar(100),
  driver_email varchar(100),
  cab_number varchar(100),
  user_email varchar(100),
  payment_mode varchar(300)
  booking_time varchar(100)
);

--  Creating the table users


create table users
( user_email varchar(100) primary key,
  user_name varchar(100),
  user_mobile varchar(100) not null,
  user_password varchar(100),
  user_gender varchar(10),
);
--  Creating the table cards



create table cards
( 
  s_no serial primary key,
  card_no varchar(100),
  card_name varchar(100),
  cvv varchar(100),
  user_email varchar(100),  
);

--  Creating the table cabs
  
create table cab
( 
  reg_no varchar(100) primary key,
  cab_type varchar(100),
  cab_color varchar(100),
  associate_email varchar(100)  
);

--  Creating the table driver

  
create table driver
( driver_email varchar(100) primary key,
  driver_name varchar(100),
  driver_dob varchar(100),
  associate_email varchar(100),
  driver_account varchar(100),
  available_profit varchar(100)
);



--  Creating the table associate


create table associate
( associate_email varchar(100) primary key,
  associate_name varchar(100),
  associate_password varchar(100),
  associate_owner varchar(100),
  associate_account_no varchar(100)
);

--  Creating the table logs to save history

CREATE TABLE logs (
  log_id serial primary key NOT NULL,
  userid_reg_no varchar(20),
  actions varchar(40),
  dates varchar(100) 
)

-- adding the foreign key constraints to the respective tables

alter table driver add foreign key(associate_email) references associate(associate_email) on delete cascade;

alter table rides add foreign key(user_email) references users(user_email) on delete cascade;

alter table rides add foreign key(driver_email) references driver(driver_email) on delete cascade;

alter table rides add foreign key(associate_email) references associate(associate_email) on delete cascade;

alter table rides add foreign key(reg_no) references cab(reg_no) on delete cascade;

alter table withdraws_associate add foreign key(associate_email) references associate(associate_email) on delete cascade;

alter table withdraws_driver add foreign key(driver_email) references driver(driver_email) on delete cascade;

alter table cab add foreign key(associate_email) references associate(associate_email) on delete cascade;

alter table cards add foreign key(user_email) references users(user_email) on delete cascade;




-- Using the triggers to save the delete/insert operations on users/cab/drivers/associate table and save in logs tables
-- which can not be deleted even by the user



-- adding the trigger to save into logs on inserting_users


   CREATE OR REPLACE FUNCTION inserting_users() 
           RETURNS trigger AS $$
     BEGIN
      		INSERT INTO logs(userid,action,time) VALUES(NEW.user_email, 'User Created Succesfully', now());
         RETURN new;
      END;
  $$ LANGUAGE plpgsql;
  CREATE  TRIGGER CreateUser 
     BEFORE Insert ON users
   FOR EACH ROW EXECUTE procedure inserting_users();
 


-- adding the trigger to save info into logs on deleting_users

   CREATE OR REPLACE FUNCTION deleting_users() 
           RETURNS trigger AS $$
     BEGIN
      		INSERT INTO logs(userid,action,time) VALUES(old.user_email, 'User deleted Succesfully', now());
         RETURN new;
      END;
  $$ LANGUAGE plpgsql;
  CREATE  TRIGGER deleteuser 
     after delete ON users
   FOR EACH ROW EXECUTE procedure deleting_users();


-- adding the trigger to save into logs on inserting_associate

     CREATE OR REPLACE FUNCTION inserting_associate() 
           RETURNS trigger AS $$
     BEGIN
      		INSERT INTO logs(userid,action,time) VALUES(new.associate_email, 'Associate Added Succesfully', now());
         RETURN new;
      END;
  $$ LANGUAGE plpgsql;
  CREATE  TRIGGER addassociate 
     BEFORE insert ON associate
   FOR EACH ROW EXECUTE procedure inserting_associate();
 
-- adding the trigger to save info into logs on deleting_associate

     CREATE OR REPLACE FUNCTION deleting_associate() 
           RETURNS trigger AS $$
     BEGIN
      		INSERT INTO logs(userid,action,time) VALUES(old.associate_email, 'Associate deleted Succesfully', now());
         RETURN new;
      END;
  $$ LANGUAGE plpgsql;
  CREATE  TRIGGER deleting_associate 
     after delete ON associate
   FOR EACH ROW EXECUTE procedure deleting_associate();


 -- adding the trigger to save into logs on inserting_driver

     CREATE OR REPLACE FUNCTION inserting_driver() 
           RETURNS trigger AS $$
     BEGIN
      		INSERT INTO logs(userid,action,time) VALUES(new.driver_email, 'driver inserted Succesfully', now());
         RETURN new;
      END;
  $$ LANGUAGE plpgsql;
  CREATE  TRIGGER inserting_driver 
     BEFORE insert ON driver
   FOR EACH ROW EXECUTE procedure inserting_driver();



-- adding the trigger to save info into logs on deleting_drver

    CREATE OR REPLACE FUNCTION deleting_driver() 
           RETURNS trigger AS $$
     BEGIN
      		INSERT INTO logs(userid,action,time) VALUES(old.driver_email, 'driver deleted Succesfully', now());
         RETURN old;
      END;
  $$ LANGUAGE plpgsql;
  CREATE  TRIGGER deleting_driver 
     BEFORE delete ON driver
   FOR EACH ROW EXECUTE procedure deleting_driver();




-- adding the trigger to save into logs on deleting_cab

    CREATE OR REPLACE FUNCTION deleting_cab() 
           RETURNS trigger AS $$
     BEGIN
      		INSERT INTO logs(userid,action,time) VALUES(old.reg_no, 'cab deleted Succesfully', now());
         RETURN new;
      END;
  $$ LANGUAGE plpgsql;
  CREATE  TRIGGER deleting_cab 
     after delete ON cab
   FOR EACH ROW EXECUTE procedure deleting_cab();




-- adding the trigger to save into logs on inserting_cab

    CREATE OR REPLACE FUNCTION inserting_cab() 
           RETURNS trigger AS $$
     BEGIN
      		INSERT INTO logs(userid,action,time) VALUES(new.reg_no, 'cab added Succesfully', now());
         RETURN new;
      END;
  $$ LANGUAGE plpgsql;
  CREATE  TRIGGER inserting_cab 
     BEFORE insert ON cab
   FOR EACH ROW EXECUTE procedure inserting_cab();

-- populating the database with raw data

insert into admin values('amarbir@gmail.com','amarbir','amarbir');
insert into admin values('mohit@gmail.com','mohit','mohit');
insert into admin values('grahil@gmail.com','grahil','grahil');
insert into admin values('aryan@gmail.com','aryan','aryan');
insert into admin values('admin_admin@gmail.com','admin','admin');


insert into associate VALUES('sanjanatravels@gmail.com','sanjana travels','sanjana','sanjana','123456789');
insert into associate VALUES('radhikatravels@gmail.com','radhika travels','radhika','radhika','234567891');
insert into associate VALUES('skttravels@gmail.com','skt travels','skt','skt','345678912');
insert into associate VALUES('krishnatravels@gmail.com','Krishna travels','krishna','krishna','456789123');
insert into associate VALUES('admin_associate@gmail.com','admin ','admin','admin','000000000');


INSERT into driver VALUES('rohit@gmail.com','rohit','1999-08-31','sanjanatravels@gmail.com','111111111','0');
INSERT into driver VALUES('raman@gmail.com','raman','1999-09-31','sanjanatravels@gmail.com','111111112','0');
INSERT into driver VALUES('alex@gmail.com','alex','1999-10-31','radhikatravels@gmail.com','111111113','0');
INSERT into driver VALUES('james@gmail.com','james','1999-11-31','radhikatravels@gmail.com','111111114','0');
INSERT into driver VALUES('joy@gmail.com','joy','1999-12-31','skttravels@gmail.com','111111115','0');
INSERT into driver VALUES('messi@gmail.com','messi','1998-08-31','skttravels@gmail.com','111111116','0');
INSERT into driver VALUES('akshat@gmail.com','akshat','1997-08-31','krishnatravels@gmail.com','111111117','0');
INSERT into driver VALUES('mridul@gmail.com','mridul','1995-08-31','krishnatravels@gmail.com','111111118','0');





INSERT into cab VALUES('rj14 ca 1111','sedan','white','sanjanatravels@gmail.com');
INSERT into cab VALUES('rj14 ca 1112','sedan','black','sanjanatravels@gmail.com');
INSERT into cab VALUES('rj14 ca 1113','sedan','black','radhikatravels@gmail.com');
INSERT into cab VALUES('rj14 ca 1114','sedan','white','radhikatravels@gmail.com');
INSERT into cab VALUES('rj14 ca 1115','sedan','grey','skttravels@gmail.com');
INSERT into cab VALUES('rj14 ca 1116','sedan','blue','skttravels@gmail.com');
INSERT into cab VALUES('rj14 ca 1117','sedan','black','krishnatravels@gmail.com');
INSERT into cab VALUES('rj14 ca 1118','sedan','white','krishnatravels@gmail.com');





INSERT into users VALUES('sahil@gmail.com','sahil','8085095909','sahil','male');
INSERT into users VALUES('kirti@gmail.com','kirti','8747237761','kirti','female');
INSERT into users VALUES('lily@gmail.com','lily','7878612413','lily','female');
INSERT into users VALUES('ramesh@gmail.com','ramesh','6425625315','ramesh','male');



INSERT into cards(card_no,card_name,cvv,user_email) VALUES('3096 5981 1222 1311','sahil singh','111','sahil@gmail.com');
INSERT into cards(card_no,card_name,cvv,user_email) VALUES('3096 5981 1222 1312','sahil singh','211','sahil@gmail.com');
INSERT into cards(card_no,card_name,cvv,user_email) VALUES('3096 5981 1222 1314','kirti gupta','112','kirti@gmail.com');
INSERT into cards(card_no,card_name,cvv,user_email) VALUES('3096 5981 1222 1316','kirti gupta','113','kirti@gmail.com');
INSERT into cards(card_no,card_name,cvv,user_email) VALUES('3096 5981 1222 1317','lily bakes','114','lily@gmail.com');
INSERT into cards(card_no,card_name,cvv,user_email) VALUES('3096 5981 1222 1318','lily bakes','115','lily@gmail.com');
INSERT into cards(card_no,card_name,cvv,user_email) VALUES('3096 5981 1222 1319','ramesh mehta','116','ramesh@gmail.com');
INSERT into cards(card_no,card_name,cvv,user_email) VALUES('3096 5981 1222 1320','ramesh mehta','117','ramesh@gmail.com');








