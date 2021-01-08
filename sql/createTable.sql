  create schema Hospital;
  use hospital;

  create table user (
    user_ID  int AUTO_INCREMENT,
    name     varchar(20),
    password varchar(20) not null,
    type     enum('doctor', 'chief nurse', 'emergency nurse', 'hospital nurse') not null,
    treatment_area enum('mild', 'intense', 'critical','emergency') not null,
    primary key (user_ID)
  );

  create table patient (
    patient_ID int AUTO_INCREMENT,
    name       varchar(20),
    treatment_area enum('mild', 'intense', 'critical','isolated area') not null,
    primary key (patient_ID)
  );

  -- 添加result_id作为主键,合并了“记录”和“被检测”
  create table nucleic_acid_testing_result (
    result_ID   int AUTO_INCREMENT,
    patient_ID  int,
    recorder_ID int,
    result      enum('positive','negative') not null,
    time        datetime,
    level       enum('mild', 'intense', 'critical') not null,
    primary key (result_ID),
    foreign key (patient_ID) references patient (patient_ID),
    foreign key (recorder_ID) references User (user_ID)

  );



  -- 合并了“负责”和“负责”
  create table treatment_area (
    type          enum('mild', 'intense', 'critical', 'isolated area') not null,
    doctor_ID      int,
    chief_nurse_ID int,
    primary key (type),
    foreign key (doctor_ID) references User (user_ID),
    foreign key (chief_nurse_ID) references User (user_ID)

  );

  -- 合并了“位于”和“负责”和“占据”
  create table bed (
    bed_ID         int AUTO_INCREMENT,
    patient_ID     int,
    room           int not null,
    treatment_area  enum('mild', 'intense', 'critical', 'isolated area'),
    duty_nurse_ID  int,
    primary key (bed_ID),
    foreign key (duty_nurse_ID) references User (user_ID),
    foreign key (treatment_area) references treatment_area (type),
    foreign key (patient_ID) references patient (patient_ID)
  );

  -- 添加record_id作为主键，合并了联系集“记录”和“曾经处于”和“包含”
  create table patient_status (
    record_ID   int AUTO_INCREMENT,
    result_ID   int,
    patient_ID  int,
    bed_ID      int,
    recorder_ID int,
    temperature numeric(3, 1),
    symptom     varchar(20),
    life_status enum('discharged', 'treating', 'dead') not null,
    time        datetime,
    primary key (record_ID),
    foreign key (patient_ID) references patient (patient_ID),
    foreign key (bed_ID) references bed (bed_ID),
    foreign key (recorder_ID) references user (user_ID),
    foreign key (result_ID) references nucleic_acid_testing_result (result_ID)
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



