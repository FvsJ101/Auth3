#START

#USE
use application;

#DROP
drop table if exists `user`;

CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `flag_active` tinyint(1) NOT NULL DEFAULT '0',
  `active_hash` varchar(255) DEFAULT NULL,
  `recover_hash` varchar(255) DEFAULT NULL,
  `remember_identifier` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `flag_delete` tinyint(1) DEFAULT '0',
  `fk_admin_type` int(10) DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

#DELETE
delete from `user` where `id` > 0;

#ALTER
alter table `user` auto_increment 0;

#INSERT
/*YOUR DEFAULT PASSWORD*/
INSERT INTO `user` (username, first_name, last_name, email, password, flag_active, active_hash, recover_hash, remember_identifier, remember_token, created_at, updated_at, flag_delete) VALUES ('Admin', 'Michael', 'Meyer', 'michael@frostweb.co.za', '$2y$10$ZNOTXiBbtpxi/bGS.4G.kOfn3RdJdQZKzQ5/S9BL7rL3veIz86KfG', 1, null, null, null, null, '2016-08-30 07:20:11', '2016-08-30 07:20:11', 1);


/*---------------- END OF USERS TABLE --------------------------*/
#DROP
DROP TABLE IF EXISTS `admin_type`;

CREATE TABLE `admin_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `flag_delete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

#DELETE
delete from `admin_type` where `id` > 0;

#ALTER
alter table `admin_type` auto_increment 0;

#INSERT
INSERT INTO application.admin_type (name, description, created_at, update_at, flag_delete) VALUES ('Admin', 'Full System access', '2016-09-23 15:46:31', null, null);
INSERT INTO application.admin_type (name, description, created_at, update_at, flag_delete) VALUES ('Guest', 'No Privilages or views', '2016-09-23 15:46:57', null, null);
INSERT INTO application.admin_type (name, description, created_at, update_at, flag_delete) VALUES ('Registered', 'Some access accross the site', '2016-09-23 15:47:34', null, null);