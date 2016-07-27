/* This file is created by MySQLReback 2016-07-06 04:05:42 */
 /* 创建表结构 `wallet_record` */
 DROP TABLE IF EXISTS `wallet_record`;/* MySQLReback Separation */ CREATE TABLE `wallet_record` (
  `record_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `money` double NOT NULL,
  `time` datetime NOT NULL,
  `category` varchar(20) NOT NULL,
  `remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`record_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `wallet_statistics` */
 DROP TABLE IF EXISTS `wallet_statistics`;/* MySQLReback Separation */ CREATE TABLE `wallet_statistics` (
  `user_id` int(5) NOT NULL,
  `income` double NOT NULL DEFAULT '0',
  `expend` double NOT NULL DEFAULT '0',
  `month_budget` double NOT NULL DEFAULT '0',
  `settlement_date` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `wallet_user` */
 DROP TABLE IF EXISTS `wallet_user`;/* MySQLReback Separation */ CREATE TABLE `wallet_user` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `reg_time` datetime NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `login_time` int(11) NOT NULL DEFAULT '0',
  `status` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `wallet_user` */
 INSERT INTO `wallet_user` VALUES ('1','Cielo','6c362ae6dae3359cb45b6a6e9059cfa6','1332454954@qq.com','2016-06-24 09:49:48','User','2016-06-25 02:25:22','5','1'),('3','admin','e10adc3949ba59abbe56e057f20f883e','13356488@qq.com','2016-07-13 12:10:33','Admin','2016-07-05 03:16:52','11','11'),('26','Heric','e10adc3949ba59abbe56e057f20f883e','13356488@qq.com','2016-07-03 22:09:01','User','0000-00-00 00:00:00','0','1'),('30','HericY','e10adc3949ba59abbe56e057f20f883e','13356488@qq.com','2016-07-04 03:52:27','User','0000-00-00 00:00:00','0','12322'),('29','HericX','e10adc3949ba59abbe56e057f20f883e','13356488@qq.com','2016-07-03 22:32:32','User','0000-00-00 00:00:00','0','1222'),('31','HericDAS','e10adc3949ba59abbe56e057f20f883e','13356488@qq.com','2016-07-04 13:21:51','User','0000-00-00 00:00:00','0','1234');/* MySQLReback Separation */