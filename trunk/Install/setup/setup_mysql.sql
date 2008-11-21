DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(1) unsigned NOT NULL,
  `username` varchar(24) NOT NULL default '',
  `password` varchar(48) DEFAULT NULL,
  PRIMARY KEY  (`admin_id`),
  UNIQUE KEY LoginName (`username`)
) ENGINE=MyISAM;

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES('1', 'admin', '$1$D/3.QD5.$TT8cyzbK2eo0N7OlxsbIJ/');

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `member_id` int(5) unsigned NOT NULL,
  `name` varchar(24) NOT NULL,
  `sex` varchar(4) NOT NULL default '男',
  `hobbies` text,
  `skills` text,
  `university` varchar(40) NOT NULL default ' ',
  `introduction` text,
  `experiences` decimal(3,1) NOT NULL,
  `headimage` varchar(80) NOT NULL default 'defaulthead.jpg',
  `image` varchar(80) NULL,
  PRIMARY KEY  (`member_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `project_id` int(5) unsigned NOT NULL,
  `name` varchar(40) NOT NULL,
  `introduction` text,
  `status` varchar(12) NOT NULL default '进行中',
  PRIMARY KEY  (`project_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(10) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `body` text,
  `created` datetime default NULL,
  `updated` datetime default NULL,
  PRIMARY KEY  (`post_id`)
)ENGINE=MyISAM;

INSERT INTO `posts` (`post_id`, `title`, `body`, `created`, `updated`) VALUES(1, '欢迎你', '欢迎你访问', '2008-11-21 21:11:37', '2008-11-21 09:11:37');

