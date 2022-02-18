create table medico
(
  id int PRIMARY KEY auto_increment,
  nome varchar(45) unique,
  telefone varchar(15),
  especialidade varchar(20)
) ENGINE=InnoDB;


insert into medico (nome, telefone, especialidade)
values ("Dr. Roberto Coração", "(34)3200-1111", "cardiologista"),
       ("Dr. Geraldo Acne", "(34)3210-0011", "dermatologista"),
       ("Dr. Nilson Lagrimas", "(34)3201-1000", "oftalmologista"),
       ("Dra. Gina Cardiaca", "(34)3200-2222", "cardiologista"),
       ("Dra. Roberta Queratina", "(34)3210-0022", "dermatologista"),
       ("Dra. Ana Olhares", "(34)3201-2000", "oftalmologista"),
       ("Dra. Maria Ataque", "(34)3200-3333", "cardiologista"),
       ("Dr. Jorge Ruga", "(34)3210-0033", "dermatologista"),
       ("Dra. Carolina dos Olhos", "(34)3201-3000", "oftalmologista")
