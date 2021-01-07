create schema Hospital;
use hospital;

create table user (
  user_ID  int AUTO_INCREMENT,
  name     varchar(20),
  password varchar(20) not null,
  type     varchar(20),
  primary key (user_ID),
  check (type in ('doctor', 'chief nurse', 'emergency nurse', 'hospital nurse'))
);

create table patient (
  patient_ID int AUTO_INCREMENT,
  name       varchar(20),
  primary key (patient_ID)
);

-- 添加result_id作为主键,合并了“记录”和“被检测”
create table nucleic_acid_testing_result (
  result_ID   int,
  patient_ID  int,
  recorder_ID int,
  result      varchar(20) not null,
  time        datetime,
  level       varchar(20),
  primary key (result_ID),
  check (level in ('mild', 'intense', 'critical')),
  foreign key (patient_ID) references patient (patient_ID),
  foreign key (recorder_ID) references User (user_ID)

);

-- 添加record_id作为主键，合并了联系集“记录”和“曾经处于”和“包含”
create table patient_status (
  record_ID   int AUTO_INCREMENT,
  result_ID   int,
  patient_ID  int,
  recorder_ID int,
  temperature numeric(3, 1),
  symptom     varchar(20),
  life_status varchar(20),
  time        datetime,
  check (life_status in ('discharged', 'treating', 'dead')),
  primary key (record_ID),
  foreign key (patient_ID) references patient (patient_ID),
  foreign key (record_ID) references user (user_ID),
  foreign key (result_ID) references nucleic_acid_testing_result (result_ID)
);

-- 合并了“负责”和“负责”
create table treatment_area (
  type           varchar(20),
  doctor_ID      int,
  chief_nurse_ID int,
  primary key (type),
  check (type in ('mild', 'intense', 'critical', 'isolated area')),
  foreign key (doctor_ID) references User (user_ID),
  foreign key (chief_nurse_ID) references User (user_ID)

);

-- 合并了“位于”和“负责”和“占据”
create table bed (
  bed_ID         int AUTO_INCREMENT,
  patient_ID     int,
  room           int not null,
  treatment_area varchar(20),
  duty_nurse_ID  int,
  primary key (bed_ID),
  foreign key (duty_nurse_ID) references User (user_ID),
  foreign key (treatment_area) references treatment_area (type),
  foreign key (patient_ID) references patient (patient_ID)
);


create table message(
  message_ID int,
  patient_ID int,
  primary key(message_ID),
  foreign key(patient_ID) references patient (patient_ID)
)
-- create table patient_bed(
--   bed_ID int,
--   patient_ID int,
--   primary key (patient_ID),
--   foreign key (bed_ID) references bed,
-- )



