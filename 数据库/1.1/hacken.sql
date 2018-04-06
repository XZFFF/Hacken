-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-04-06 16:04:14
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hacken`
--

-- --------------------------------------------------------

--
-- 表的结构 `idea`
--

CREATE TABLE IF NOT EXISTS `idea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `summary` text NOT NULL COMMENT '简介',
  `need` text NOT NULL COMMENT '人员需求',
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `user3` int(11) NOT NULL,
  `user4` int(11) NOT NULL,
  `user5` int(11) NOT NULL,
  `user6` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0-需要人员 1-满员',
  `createtime` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='idea表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '申请人id',
  `iid` int(11) NOT NULL COMMENT '申请的idea的id',
  `iuid` int(11) NOT NULL COMMENT 'idea创建人id',
  `status` int(1) NOT NULL COMMENT '0-申请中 1-已同意 2-已拒绝',
  `createtime` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='idea组申请表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(80) NOT NULL,
  `realname` varchar(40) NOT NULL,
  `gender` tinyint(1) NOT NULL COMMENT '0-女 1-男',
  `role` varchar(40) DEFAULT NULL COMMENT '担任角色',
  `tel` varchar(11) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `wechat` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0-无队伍 1-有队伍',
  `skill1` varchar(40) DEFAULT NULL,
  `skill2` varchar(40) DEFAULT NULL,
  `skill3` varchar(40) DEFAULT NULL,
  `skill4` varchar(40) DEFAULT NULL,
  `skill5` varchar(40) DEFAULT NULL,
  `skill6` varchar(40) DEFAULT NULL,
  `resume` text NOT NULL COMMENT '个人简介',
  `createtime` timestamp NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='用户表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `realname`, `gender`, `role`, `tel`, `qq`, `wechat`, `status`, `skill1`, `skill2`, `skill3`, `skill4`, `skill5`, `skill6`, `resume`, `createtime`) VALUES
(1, 'xzfff', '202cb962ac59075b964b07152d234b70', '谢泽丰', 1, '', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '', '2018-04-06 13:15:23');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
