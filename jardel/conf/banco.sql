create database areacentral;
use areacentral;
create table produto(
	codigo integer auto_increment primary key,
	descricao varchar(45) not null,
	valorUnitario float not null,
	estoque int not null,
	exclui integer default 1
);
insert into produto(descricao, valorUnitario, estoque)
values('Processador', 429.90, 50);
select * from produto;