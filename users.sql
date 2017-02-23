DROP database IF EXISTS `users`;
create database `users`;
use `users`;

create table `users` (
	`id` int(20) not null auto_increment,
	`name` varchar(255) not null,
	`pass` varchar(255) not null,
	`login_time` int(20) default null,
	`login_counts` int(20) not null default '0',
	PRIMARY KEY  (`id`)  
	) default charset = utf8;
create table `article` (
	`id` int(20) not null auto_increment,
	`title` varchar(100) not null,
	`content` longtext not null,
	`time` date,
	`auther` varchar(100) not null, 
	`cover` varchar(100) default null,
	`cate` varchar(100) default null,
	PRIMARY KEY  (`id`) 	
) default charset = utf8;	