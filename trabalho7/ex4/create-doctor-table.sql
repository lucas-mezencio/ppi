create table medico
(
  id int PRIMARY KEY auto_increment,
  nome varchar(45) unique,
  telefone varchar(15),
  especialidade varchar(20)
) ENGINE=InnoDB;