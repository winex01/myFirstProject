#
# TABLE STRUCTURE FOR: documents
#

DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `file` longtext NOT NULL,
  `date_upload` varchar(50) NOT NULL,
  `title_id` int(11) NOT NULL,
  `fac_ID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=latin1;

INSERT INTO `documents` (`doc_id`, `file`, `date_upload`, `title_id`, `fac_ID`, `title`) VALUES ('174', 'Old_Baptismal_Certificate.pdf', '2017/11/21 - 09:23:16 pm', '3', '1111', 'memo 1');
INSERT INTO `documents` (`doc_id`, `file`, `date_upload`, `title_id`, `fac_ID`, `title`) VALUES ('175', 'Old_Baptismal_Certificate1.pdf', '2017/11/21 - 09:24:00 pm', '4', '1111', 'course 1');


#
# TABLE STRUCTURE FOR: faculty
#

DROP TABLE IF EXISTS `faculty`;

CREATE TABLE `faculty` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `fac_ID` int(11) NOT NULL,
  `fac_fname` varchar(50) NOT NULL,
  `fac_mname` varchar(50) NOT NULL,
  `fac_lname` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `img` longtext NOT NULL,
  `phone_num` varchar(50) NOT NULL,
  `date_added` varchar(50) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

INSERT INTO `faculty` (`f_id`, `fac_ID`, `fac_fname`, `fac_mname`, `fac_lname`, `gender`, `img`, `phone_num`, `date_added`) VALUES ('50', '1111', 'Janeth', 'S', 'Aclao', '1', 'avatar31.png', '639364365139', '');
INSERT INTO `faculty` (`f_id`, `fac_ID`, `fac_fname`, `fac_mname`, `fac_lname`, `gender`, `img`, `phone_num`, `date_added`) VALUES ('51', '2222', 'Ruby Mary', 'P', 'Gallarde', '1', '', '639364365139', '2017/11/19 - 10:25:27 am');
INSERT INTO `faculty` (`f_id`, `fac_ID`, `fac_fname`, `fac_mname`, `fac_lname`, `gender`, `img`, `phone_num`, `date_added`) VALUES ('52', '3333', 'Jonathan', 'F', 'Cabardo', '0', '', '639364365139', '2017/11/19 - 10:25:58 am');
INSERT INTO `faculty` (`f_id`, `fac_ID`, `fac_fname`, `fac_mname`, `fac_lname`, `gender`, `img`, `phone_num`, `date_added`) VALUES ('53', '7777', 'Josie', 'B', 'Quiban', '0', '', '639364365139', '2017/11/19 - 10:26:17 am');
INSERT INTO `faculty` (`f_id`, `fac_ID`, `fac_fname`, `fac_mname`, `fac_lname`, `gender`, `img`, `phone_num`, `date_added`) VALUES ('54', '5555', 'Levi', 'G', 'Esmero', '0', '', '639364365139', '2017/11/19 - 10:26:46 am');
INSERT INTO `faculty` (`f_id`, `fac_ID`, `fac_fname`, `fac_mname`, `fac_lname`, `gender`, `img`, `phone_num`, `date_added`) VALUES ('55', '6666', 'Janet', 'A', 'Orique', '1', '', '639364365139', '2017/11/19 - 10:27:03 am');


#
# TABLE STRUCTURE FOR: logs
#

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `fac_ID` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `log_date` varchar(50) NOT NULL,
  `file_title` varchar(50) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=latin1;

INSERT INTO `logs` (`log_id`, `fac_ID`, `task`, `log_date`, `file_title`) VALUES ('170', '1111', 'Uploaded', '2017/11/21 - 09:23:16 pm', 'memo 1');
INSERT INTO `logs` (`log_id`, `fac_ID`, `task`, `log_date`, `file_title`) VALUES ('171', '1111', 'Uploaded', '2017/11/21 - 09:24:00 pm', 'course 1');


#
# TABLE STRUCTURE FOR: notifications
#

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `fac_ID` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `date_notify` varchar(50) NOT NULL,
  `upload_id` int(11) NOT NULL,
  `click_notification` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`not_id`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: title
#

DROP TABLE IF EXISTS `title`;

CREATE TABLE `title` (
  `title_id` int(11) NOT NULL AUTO_INCREMENT,
  `title_name` varchar(50) NOT NULL,
  PRIMARY KEY (`title_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO `title` (`title_id`, `title_name`) VALUES ('3', 'Memorandum');
INSERT INTO `title` (`title_id`, `title_name`) VALUES ('4', 'Course Syllabus');
INSERT INTO `title` (`title_id`, `title_name`) VALUES ('5', 'Faculty Workload Assignment');
INSERT INTO `title` (`title_id`, `title_name`) VALUES ('6', 'Grade Sheet');
INSERT INTO `title` (`title_id`, `title_name`) VALUES ('7', 'Faculty Performance');
INSERT INTO `title` (`title_id`, `title_name`) VALUES ('8', 'Faculty Class Program');
INSERT INTO `title` (`title_id`, `title_name`) VALUES ('9', 'Faculty Profile');
INSERT INTO `title` (`title_id`, `title_name`) VALUES ('10', 'ICT Projects/Plans');
INSERT INTO `title` (`title_id`, `title_name`) VALUES ('11', 'Class Records');
INSERT INTO `title` (`title_id`, `title_name`) VALUES ('12', 'Order Request');


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fac_Id` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_pass` varchar(50) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '1',
  `f_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`user_id`, `fac_Id`, `user_name`, `user_pass`, `type`, `f_id`) VALUES ('54', '1111', '1111', '21232f297a57a5a743894a0e4a801fc3', '1', '0');
INSERT INTO `users` (`user_id`, `fac_Id`, `user_name`, `user_pass`, `type`, `f_id`) VALUES ('61', '2222', '2222', '934b535800b1cba8f96a5d72f72f1611', '2', '51');
INSERT INTO `users` (`user_id`, `fac_Id`, `user_name`, `user_pass`, `type`, `f_id`) VALUES ('62', '3333', '3333', '2be9bd7a3434f7038ca27d1918de58bd', '2', '52');
INSERT INTO `users` (`user_id`, `fac_Id`, `user_name`, `user_pass`, `type`, `f_id`) VALUES ('63', '7777', '7777', 'dbc4d84bfcfe2284ba11beffb853a8c4', '2', '53');
INSERT INTO `users` (`user_id`, `fac_Id`, `user_name`, `user_pass`, `type`, `f_id`) VALUES ('64', '5555', '5555', '6074c6aa3488f3c2dddff2a7ca821aab', '2', '54');
INSERT INTO `users` (`user_id`, `fac_Id`, `user_name`, `user_pass`, `type`, `f_id`) VALUES ('65', '6666', '6666', 'e9510081ac30ffa83f10b68cde1cac07', '2', '55');


#
# TABLE STRUCTURE FOR: views
#

DROP TABLE IF EXISTS `views`;

CREATE TABLE `views` (
  `v_id` int(11) NOT NULL AUTO_INCREMENT,
  `fac_ID` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `open` int(11) DEFAULT '0',
  PRIMARY KEY (`v_id`)
) ENGINE=InnoDB AUTO_INCREMENT=396 DEFAULT CHARSET=latin1;

INSERT INTO `views` (`v_id`, `fac_ID`, `doc_id`, `open`) VALUES ('386', '2222', '174', '0');
INSERT INTO `views` (`v_id`, `fac_ID`, `doc_id`, `open`) VALUES ('387', '3333', '174', '0');
INSERT INTO `views` (`v_id`, `fac_ID`, `doc_id`, `open`) VALUES ('388', '7777', '174', '0');
INSERT INTO `views` (`v_id`, `fac_ID`, `doc_id`, `open`) VALUES ('389', '5555', '174', '0');
INSERT INTO `views` (`v_id`, `fac_ID`, `doc_id`, `open`) VALUES ('390', '6666', '174', '0');
INSERT INTO `views` (`v_id`, `fac_ID`, `doc_id`, `open`) VALUES ('391', '2222', '175', '0');
INSERT INTO `views` (`v_id`, `fac_ID`, `doc_id`, `open`) VALUES ('392', '3333', '175', '0');
INSERT INTO `views` (`v_id`, `fac_ID`, `doc_id`, `open`) VALUES ('393', '7777', '175', '0');
INSERT INTO `views` (`v_id`, `fac_ID`, `doc_id`, `open`) VALUES ('394', '5555', '175', '0');
INSERT INTO `views` (`v_id`, `fac_ID`, `doc_id`, `open`) VALUES ('395', '6666', '175', '0');


