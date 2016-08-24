#START

#USE
use application;

#DROP
drop table if exists `user`;

CREATE TABLE IF NOT EXISTS `user` (
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
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
	`flag_delete` TINYINT(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#DELETE
delete from `user` where `id` > 0;

#ALTER
alter table `user` auto_increment 0;

/*---------------- END OF USERS TABLE --------------------------*/