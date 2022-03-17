create table endereco_ex7
(
  id int PRIMARY KEY auto_increment,
  cep char(10),
  rua varchar(100),
  bairro varchar(50),
  cidade varchar(50),
) ENGINE=InnoDB;

insert into endereco_ex7 (cep, rua, bairro, cidade)
values ("38400-100", "Av João Naves", "Santa Mônica", "Uberlândia"),
       ("38400-200", "Av Floriano Peixoto", "Centro", "Uberlândia"),
       ("38400-300", "Av Afonso Pena", "Martins", "Uberlândia"),
       ("38407-845", "Av Anselmo Alves dos Santos", "Santa Mônica", "Uberlândia"),
       ("38400-299", "Av Getúlio Vargas", "Centro", "Uberlândia"),
       ("38400-000", "Av Rondon Pacheco", "Saraiva", "Uberlândia")