use hospital;
-- 一些初始数据
insert into user (name, password, type, treatment_area)
values ('qsy', '123123', 'doctor','mild');
insert into user (name, password, type, treatment_area)
values ('qsu', '123123', 'doctor','intense');
insert into user (name, password, type, treatment_area)
values ('qsi', '123123', 'doctor','critical');
insert into user (name, password, type, treatment_area)
values ('cn1', '123123', 'chief nurse','mild');
insert into user (name, password, type, treatment_area)
values ('cn2', '123123', 'chief nurse','intense');
insert into user (name, password, type, treatment_area)
values ('cn3', '123123', 'chief nurse','critical');
insert into user (name, password, type, treatment_area)
values ('hn1', '123123', 'hospital nurse','critical');
insert into user (name, password, type, treatment_area)
values ('hn2', '123123', 'hospital nurse','intense');
insert into user (name, password, type, treatment_area)
values ('hn3', '123123', 'hospital nurse','intense');
insert into user (name, password, type, treatment_area)
values ('hn4', '123123', 'hospital nurse','mild');
insert into user (name, password, type, treatment_area)
values ('en1', '123123','emergency nurse','emergency');
insert into treatment_area
values ('mild', 1, 4);
insert into treatment_area
values ('intense', 2, 5);
insert into treatment_area
values ('critical', 3, 6);
insert into treatment_area(type)
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

insert into patient(name,treatment_area)
values ('a','mild');
insert into patient(name,treatment_area) 
values ('b','mild');
insert into patient(name,treatment_area)
values ('c','mild');
insert into patient(name,treatment_area) 
values ('d','intense');
insert into patient(name,treatment_area)
values ('e','intense');
insert into patient(name,treatment_area) 
values ('f','critical');
insert into patient(name,treatment_area)
values ('g','critical');

update bed 
set patient_ID = (select patient_ID from patient where name = 'a') where bed_ID = 5;
update bed 
set patient_ID = (select patient_ID from patient where name = 'b') where bed_ID = 6;
update bed 
set patient_ID = (select patient_ID from patient where name = 'c') where bed_ID = 7;
update bed 
set patient_ID = (select patient_ID from patient where name = 'd') where bed_ID = 3;
update bed 
set patient_ID = (select patient_ID from patient where name = 'e') where bed_ID = 4;
update bed 
set patient_ID = (select patient_ID from patient where name = 'f') where bed_ID = 1;
update bed 
set patient_ID = (select patient_ID from patient where name = 'g') where bed_ID = 2;


insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level) 
values(1,10,'positive','2019-03-03 01:53','mild');   
insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level)
values(2,10,'positive','2019-03-03 01:53','mild');  
insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level)
values(1,10,'negative','2019-03-05 01:53','mild'); 
insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level)
values(2,10,'positive','2019-03-05 01:53','mild'); 
insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level)
values(2,10,'negative','2019-03-06 01:53','mild');  

insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level) 
values(3,10,'positive','2019-03-03 01:53','mild');   
insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level)
values(4,10,'positive','2019-03-03 01:53','intense');  
insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level)
values(5,10,'negative','2019-03-05 01:53','intense'); 
insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level)
values(6,10,'positive','2019-03-05 01:53','critical'); 
insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level)
values(7,10,'negative','2019-03-06 01:53','critical');  


insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level) 
values(3,1,'positive','2019-03-03 01:53','mild');   
insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level)
values(4,1,'positive','2019-03-03 01:53','mild');  
insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level)
values(5,1,'negative','2019-03-05 01:53','intense'); 
insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level)
values(6,1,'positive','2019-03-05 01:53','intense'); 
insert into nucleic_acid_testing_result(patient_ID,recorder_ID,result,time,level)
values(7,1,'negative','2019-03-06 01:53','critical');  



insert into patient_status(result_ID,patient_ID,bed_ID,recorder_ID,temperature,symptom,life_status,time) 
values(3,1,5,4,36.8,'','treating','2019-03-05 01:53');
insert into patient_status(result_ID,patient_ID,bed_ID,recorder_ID,temperature,symptom,life_status,time)  
values(5,1,5,4,36.8,'','treating','2019-03-06 01:53');

insert into patient_status(result_ID,patient_ID,bed_ID,recorder_ID,temperature,symptom,life_status,time) 
values(4,2,6,4,36.8,'','treating','2019-03-05 01:53');
insert into patient_status(result_ID,patient_ID,bed_ID,recorder_ID,temperature,symptom,life_status,time) 
values(6,2,6,4,36.8,'','treating','2019-03-06 01:53');

insert into patient_status(result_ID,patient_ID,bed_ID,recorder_ID,temperature,symptom,life_status,time) 
values(11,3,7,4,36.8,'','treating','2019-03-05 01:53');
insert into patient_status(result_ID,patient_ID,bed_ID,recorder_ID,temperature,symptom,life_status,time)  
values(12,4,3,4,36.8,'','treating','2019-03-06 01:53');

insert into patient_status(result_ID,patient_ID,bed_ID,recorder_ID,temperature,symptom,life_status,time) 
values(13,5,4,4,36.8,'','treating','2019-03-05 01:53');
insert into patient_status(result_ID,patient_ID,bed_ID,recorder_ID,temperature,symptom,life_status,time) 
values(14,6,1,4,36.8,'','treating','2019-03-06 01:53');

insert into patient_status(result_ID,patient_ID,bed_ID,recorder_ID,temperature,symptom,life_status,time) 
values(15,7,2,4,36.8,'','treating','2019-03-05 01:53');



