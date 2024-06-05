-- ACTUALIZAR NOMBRES DE GENERO
UPDATE `students` SET gender = "Femenino" WHERE gender = "Mujer";

-- QUERYS DE MIGRACIÓN

INSERT INTO pfiv1.alumnos (Matricula, Nombre, Licenciatura, Genero, Grupo_Etnico, Estado, FechaIns)
SELECT registration, name, career, gender, ethnicity, status, date_of_registration FROM pfiv3.students;

INSERT INTO pfiv1.registrovisita (Matricula, HoraEntrada, HoraSalida, Fecha)
SELECT registration, entry_time, exit_time, visit_date FROM pfiv3.registered_visits;

