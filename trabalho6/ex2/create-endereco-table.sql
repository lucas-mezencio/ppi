
create table endereco
(
  id int PRIMARY KEY auto_increment,
  cep char(10),
  endereco varchar(100),
  bairro varchar(50),
  cidade varchar(50),
  uf varchar(2)
) ENGINE=InnoDB;