CREATE TABLE users (
	id int unsigned not null auto_increment,
	username varchar(30) not null unique,
	password varchar(60) not null,
	primary key (id)
);

