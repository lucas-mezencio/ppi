create table tb_endereco
(
  id int PRIMARY KEY auto_increment,
  cep varchar(10),
  logradouro varchar(128),
  cidade varchar(45),
  estado varchar(3)
) ENGINE=InnoDB;


create table tb_pessoa
(
  id int PRIMARY KEY auto_increment,
  nome varchar(60),
  sexo varchar(2),
  email varchar(45),
  telefone varchar(16),
  cep varchar(10),
  logradouro varchar(128),
  cidade varchar(45),
  estado varchar(3)
) ENGINE=InnoDB;

create table tb_paciente
(
  id int PRIMARY key,
  peso float,
  altura float,
  tipo_sanguineo varchar(5),
  constraint fk_pac_pessoa foreign key (id) 
  references tb_pessoa(id)
) ENGINE=InnoDB;

create table tb_funcionario
(
  id int primary key,
  data_contrato date,
  salario float,
  senha_hash varchar(256),
  constraint fk_func_pessoa foreign key (id)
  references tb_pessoa(id)
) ENGINE=InnoDB;

create table tb_medico
(
  id int primary key,
  especialidade varchar(26),
  crm varchar(26),
  constraint fk_medico_func foreign key (id) 
  references tb_funcionario(id)
) ENGINE=InnoDB;

create table tb_agenda
(
  id int PRIMARY KEY auto_increment,
  data_ date,
  horario varchar(5),
  nome varchar(60),
  sexo varchar(2),
  email varchar(45),
  medico_id int,
  constraint fk_agenda_med foreign key (medico_id)
   references tb_medico(id)
) ENGINE=InnoDB;