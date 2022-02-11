
create table user_login
(
  id int PRIMARY KEY auto_increment,
  email char(10) unique,
  password varchar(255)
) ENGINE=InnoDB;