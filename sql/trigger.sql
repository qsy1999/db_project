use hospital;
-- triggers
create trigger isolation_to_treatment
  after update
  on bed
  for each row
  begin
    if new.patient_ID is null and
       exists(select *
              from patient
                     natural join patient_status
              where patient_status.life_status = 'treating'
                and patient_ID not in
                    ((select patient_ID from bed where patient_ID is not null)))
    then
      update bed set patient_ID = (select patient_ID from (select *
                                                           from patient
                                                                  natural join patient_status
                                                           where patient_status.life_status = 'treating'
                                                             and patient_ID not in
                                                                 ((select patient_ID from bed where patient_id is not null)))as waiting_list  limit 1);
    end if;
  end;
