drop database if exists jualbeli;
create database jualbeli;
use jualbeli;

CREATE TABLE `users` (
  `id` int unsigned not null auto_increment,
  `username` varchar(20) NOT NULL,
  `password` binary(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `group_id` int(2) unsigned NOT NULL,
  `twitter_uid` varchar(100) NOT NULL,
  `facebook_uid` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  primary key (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user_meta` (
  `id` int unsigned NOT NULL auto_increment,
  `user_id` int unsigned NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `picture_thumb` varchar(255) NOT NULL,
  `gender` enum('male','female') not null,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  primary key (`id`),
  key user_id (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `groups` (
  `id` int unsigned NOT NULL auto_increment,
  `name` varchar(10) NOT NULL,
  primary key (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into `groups` (`id`,`name`) values 
(1, 'admin'),
(2, 'member');

CREATE TABLE `sessions` (
    `id` VARCHAR(40) NOT NULL,
    `last_activity` INT(10) NOT NULL,
    `data` TEXT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
