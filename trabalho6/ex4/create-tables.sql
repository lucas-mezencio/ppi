create table pessoa
(
  id int PRIMARY KEY auto_increment,
  nome varchar(50),
  email varchar(50) UNIQUE,
  telefone varchar(15),
  sexo char(1),

  cep char(10),
  endereco varchar(100),
  cidade varchar(50),
  uf varchar(2)
) ENGINE=InnoDB;

CREATE TABLE paciente
(
  id int PRIMARY KEY auto_increment,
  peso float,
  altura float,
  tipo_sang varchar(4),
  id_pessoa int not null,
  FOREIGN KEY (id_pessoa) REFERENCES pessoa(id) ON DELETE CASCADE
) ENGINE=InnoDB;