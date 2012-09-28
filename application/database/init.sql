drop database if exists jualbeli;
create database jualbeli;
use jualbeli;

CREATE TABLE `users` (
  `id` int unsigned not null auto_increment,
  `username` varchar(20) NOT NULL,
  `password` binary(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `group_id` int(2) unsigned NOT NULL DEFAULT 2,
  `twitter_uid` varchar(100) NOT NULL,
  `facebook_uid` varchar(100) NOT NULL,
  `instagram_uid` varchar(100) NOT NULL,
  `pinterest_uid` varchar(100) NOT NULL,
  `foursquare_uid` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  primary key (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user_meta` (
  `id` int unsigned NOT NULL auto_increment,
  `user_id` int unsigned NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `picture_thumb` varchar(255) NOT NULL,
  `gender` enum('male','female') not null,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone1` varchar(255) NOT NULL,
  `phone2` varchar(255) NOT NULL,
  `phone3` varchar(255) NOT NULL,
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

CREATE TABLE `user_twitter_token` ( 
  `id` int unsigned NOT NULL auto_increment,
  `user_id` int unsigned NOT NULL,
  `oauth_token` varchar(255) not null,
  `oauth_token_secret` varchar(255) not null,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  primary key (`id`),
  unique u_uid (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user_facebook_token` ( 
  `id` int unsigned NOT NULL auto_increment,
  `user_id` int unsigned NOT NULL,
  `access_token` varchar(255) not null,
  `expires` datetime not null,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  primary key (`id`),
  unique u_uid (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
