drop database if exists alb2s;

create database alb2s default CHARACTER
SET
  utf8 collate utf8_general_ci;

grant all on alb2s. * to 'dteam'@'localhost' identified by 'password';

use alb2s;

create table customer (
  customer_id int auto_increment primary key,
  customer_name varchar (20) not null,
  email_address varchar (50) not null,
  password varchar (20) not null
);

create table trader (
  trader_id int auto_increment primary key,
  trader_name varchar (20) not null,
  email_address varchar (50) not null,
  password varchar (20) not null
);

create table box_lunch (
  box_lunch_id int auto_increment primary key,
  trader_id int not null,
  box_lunch_name varchar (30) not null,
  price int not null,
  max_quantity int not null,
  box_image_pass varchar (100) not null
);

create table reservation (
  reservation_id int auto_increment not null primary key,
  customer_id int not null,
  box_lunch_id int not null,
  quantity int not null,
  receipt_date date not null,
  cart_flg int not null default 0,
  pay_flg char (1) not null,
  reserve_card char (16)
);

create table credit_card (
  card_id char(16) not null,
  credit_customer_id int not null,
  expiration_date date not null,
  primary key(card_id, credit_customer_id)
);

create table pay (
  pay_flg char(1) not null primary key default 0,
  pay_method varchar(30) not null
);

create table holiday (
  date date primary key,
  month int not null
);

alter table
  box_lunch
add
  CONSTRAINT trader_id foreign key(trader_id) references trader(trader_id) on
delete
  cascade on
update
  cascade;

alter table
  reservation
add
  CONSTRAINT customer_id foreign key(customer_id) references customer(customer_id) on
delete
  cascade on
update
  cascade;

alter table
  reservation
add
  CONSTRAINT box_lunch_id foreign key(box_lunch_id) references box_lunch(box_lunch_id) on
delete
  cascade on
update
  cascade;

alter table
  reservation
add
  CONSTRAINT pay_flg foreign key(pay_flg) references pay(pay_flg) on
delete
  cascade on
update
  cascade;

alter table
  reservation
add
  CONSTRAINT reserve_card foreign key(reserve_card) references credit_card(card_id) on
delete
  cascade on
update
  cascade;

alter table
  credit_card
add
  constraint credit_customer_id foreign key(credit_customer_id) references customer(customer_id) on
delete
  cascade on
update
  cascade;

insert into
  holiday
values
('2020-1-1', 1);

insert into
  holiday
values
('2020-1-13', 1);

insert into
  holiday
values
('2020-2-11', 2);

insert into
  holiday
values
('2020-2-23', 2);

insert into
  holiday
values
('2020-2-24', 2);

insert into
  holiday
values
('2020-3-20', 3);

insert into
  holiday
values
('2020-4-29', 4);

insert into
  holiday
values
('2020-5-3', 5);

insert into
  holiday
values
('2020-5-4', 5);

insert into
  holiday
values
('2020-5-5', 5);

insert into
  holiday
values
('2020-5-6', 5);

insert into
  holiday
values
('2020-7-23', 7);

insert into
  holiday
values
('2020-7-24', 7);

insert into
  holiday
values
('2020-8-10', 8);

insert into
  holiday
values
('2020-9-21', 9);

insert into
  holiday
values
('2020-9-22', 9);

insert into
  holiday
values
('2020-11-3', 11);

insert into
  holiday
values
('2020-11-23', 11);

insert into
  holiday
values
('2021-1-1', 1);

insert into
  holiday
values
('2021-1-11', 1);

insert into
  holiday
values
('2021-2-11', 2);

insert into
  holiday
values
('2021-2-23', 2);

insert into
  holiday
values
('2021-3-20', 3);

insert into
  holiday
values
('2021-4-29', 4);

insert into
  holiday
values
('2021-5-3', 5);

insert into
  holiday
values
('2021-5-4', 5);

insert into
  holiday
values
('2021-5-5', 5);

insert into
  holiday
values
('2021-7-19', 7);

insert into
  holiday
values
('2021-8-11', 8);

insert into
  holiday
values
('2021-9-20', 9);

insert into
  holiday
values
('2021-9-23', 9);

insert into
  holiday
values
('2021-10-11', 10);

insert into
  holiday
values
('2021-11-3', 11);

insert into
  holiday
values
('2021-11-23', 11);

insert into
  holiday
values
('2022-1-1', 1);

insert into
  holiday
values
('2022-1-10', 1);

insert into
  holiday
values
('2022-2-11', 2);

insert into
  holiday
values
('2022-2-23', 2);

insert into
  holiday
values
('2022-3-21', 3);

insert into
  holiday
values
('2022-4-29', 4);

insert into
  holiday
values
('2022-5-3', 5);

insert into
  holiday
values
('2022-5-4', 5);

insert into
  holiday
values
('2022-5-5', 5);

insert into
  holiday
values
('2022-7-18', 7);

insert into
  holiday
values
('2022-8-11', 8);

insert into
  holiday
values
('2022-9-19', 9);

insert into
  holiday
values
('2022-9-23', 9);

insert into
  holiday
values
('2022-10-10', 10);

insert into
  holiday
values
('2022-11-3', 11);

insert into
  holiday
values
('2022-11-23', 11);