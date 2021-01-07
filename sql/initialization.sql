-- 一些初始数据
insert into User (name, password, type)
values ('qsy', '123123', 'doctor');
insert into User (name, password, type)
values ('qsu', '123123', 'doctor');
insert into User (name, password, type)
values ('qsi', '123123', 'doctor');
insert into User (name, password, type)
values ('cn1', '123123', 'chief nurse');
insert into User (name, password, type)
values ('cn2', '123123', 'chief nurse');
insert into User (name, password, type)
values ('cn3', '123123', 'chief nurse');
insert into User (name, password, type)
values ('hn1', '123123', 'hospital nurse');
insert into User (name, password, type)
values ('hn2', '123123', 'hospital nurse');
insert into User (name, password, type)
values ('hn3', '123123', 'hospital nurse');
insert into User (name, password, type)
values ('hn4', '123123', 'hospital nurse');
insert into treatment_area
values ('mild', 1, 4);
insert into treatment_area
values ('intense', 2, 5);
insert into treatment_area
values ('critical', 3, 6);
insert into treatment_area
values ('isolated area');
insert into bed (room, treatment_area, duty_nurse_ID)
values (101, 'critical', 7);
insert into bed (room, treatment_area, duty_nurse_ID)
values (102, 'critical', 8);
insert into bed (room, treatment_area, duty_nurse_ID)
values (103, 'intense', 9);
insert into bed (room, treatment_area, duty_nurse_ID)
values (103, 'intense', 9);
insert into bed (room, treatment_area, duty_nurse_ID)
values (104, 'mild', 10);
insert into bed (room, treatment_area, duty_nurse_ID)
values (104, 'mild', 10);
insert into bed (room, treatment_area, duty_nurse_ID)
values (104, 'mild', 10);
insert into bed (room, treatment_area)
values (104, 'mild');


