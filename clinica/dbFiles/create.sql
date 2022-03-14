create table tb_endereco
(
  id int PRIMARY KEY auto_increment,
  cep varchar(10),
  logradouro varchar(128),
  cidade varchar(45),
  estado varchar(3)
) ENGINE=InnoDB;