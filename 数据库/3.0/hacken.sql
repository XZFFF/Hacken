-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-04-07 02:12:23
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
  `user1` int(11) DEFAULT NULL,
  `user2` int(11) DEFAULT NULL,
  `user3` int(11) DEFAULT NULL,
  `user4` int(11) DEFAULT NULL,
  `user5` int(11) DEFAULT NULL,
  `user6` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0-需要人员 1-满员',
  `createtime` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='idea表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `idea`
--

INSERT INTO `idea` (`id`, `uid`, `title`, `summary`, `need`, `user1`, `user2`, `user3`, `user4`, `user5`, `user6`, `status`, `createtime`) VALUES
(2, 1, 'Hacken', '采用信息流平台的方式，采取Idea + Hacker信息的方式，一方面大家可以看到目前没有组队人的基本信息和技能树，一方面大家可以看到目前一些已经提出的想法以及这些想法参与的人的基本信息和技能以及这个Idea还需要会哪方面技能的大佬的参与。', '满员啦', 1, 2, 3, NULL, NULL, NULL, 1, '2018-04-07 00:09:17'),
(3, 4, 'Perfect Crime', 'Hack这方面，hack是不可能hack的，这辈子不可能hack的。代码又不会写，只能划划水这个样子，才能维持得了生活这样子。来hackathon感觉像回宿舍一样，在hackathon的感觉比宿舍好多了！里面个个都超屌的，志愿者小姐姐又漂亮声音又好听，我超喜欢这里的。', 'hacker不需要组员hhh', 4, NULL, NULL, NULL, NULL, NULL, 1, '2018-04-07 00:10:47'),
(4, 5, 'No Perfect Crime', 'Hack这方面，hack是一定要hack的，这辈子不可能hack那就下辈子。代码不会写，也要抱大腿来维持维持生活这样子。来hackathon感觉像回宿舍一样，在hackathon的感觉比宿舍好多了！里面个个都超屌的，但是我们又漂亮声音又好听志愿者小姐姐被某个嫌疑人X盯上了，我们一定会秉公执法，找出ta。', '只有Haker才能拯救世界', 5, NULL, NULL, NULL, NULL, NULL, 0, '2018-04-07 00:11:41');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='idea组申请表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`id`, `uid`, `iid`, `iuid`, `status`, `createtime`) VALUES
(2, 6, 2, 1, 0, '2018-04-07 00:12:17');

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
  `read` int(1) NOT NULL DEFAULT '0' COMMENT '0-无新消息 1-有未读消息',
  `skill1` varchar(40) DEFAULT NULL,
  `skill2` varchar(40) DEFAULT NULL,
  `skill3` varchar(40) DEFAULT NULL,
  `skill4` varchar(40) DEFAULT NULL,
  `skill5` varchar(40) DEFAULT NULL,
  `skill6` varchar(40) DEFAULT NULL,
  `resume` text COMMENT '个人简介',
  `createtime` timestamp NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='用户表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `realname`, `gender`, `role`, `tel`, `qq`, `wechat`, `status`, `read`, `skill1`, `skill2`, `skill3`, `skill4`, `skill5`, `skill6`, `resume`, `createtime`) VALUES
(1, 'xzfff', '202cb962ac59075b964b07152d234b70', '谢泽丰', 1, '后端开发', '13125177868', '616973936', 'XXZZFF00', 1, 1, 'PHP', 'MATLAB', 'Python', '前端', NULL, NULL, '使用PHP有过不少项目的后端开发的经历，熟练使用MATLAB，有过图像处理、数据挖掘、智能算法的经验。对前沿有一定的了解，乐观，善于沟通。（最重要是能肝）', '2018-04-06 23:59:00'),
(2, 'zyr', '202cb962ac59075b964b07152d234b70', '张馨蓉', 0, '安卓开发', '13498764587', '138316528161', 'zxr-38261', 1, 0, 'Android', 'C++', NULL, NULL, NULL, NULL, '熟练掌握Android下的四大组件以及它们之间的数据传递、五种常用布局并能灵活的运用\r\n熟悉android中常用动画和组合动画的使用\r\n熟悉android中的图片处理方式从而防止加载图片时发生内存溢出\r\n 掌握APP应用开发框架结构的基本搭建，抽取activity,fragment,adapter，holder等公用代码，能够将常见的单例模式，代理模式，抽象工厂模式，观察者模式等设计模式灵活应用在APP开发中。\r\n 熟悉使用sharesdk实现一键分享、三方登录功能\r\n使用C++进行算法设计\r\n', '2018-04-06 23:58:42'),
(3, 'zww', '202cb962ac59075b964b07152d234b70', '郑文伟', 1, 'UI设计', '13576489302', '1263836318', 'wwdlijka', 1, 0, '建模', '视频渲染', '网页/移动端设计', NULL, NULL, NULL, '有若干视频渲染经验，能应用高级炫酷动画\r\n有若干网页UI设计经验\r\n有若干手机客户端UI设计经验\r\n熟悉游戏背景建模\r\n熟悉自主编写动画插件\r\n', '2018-04-07 00:03:13'),
(4, 'wwj', '202cb962ac59075b964b07152d234b70', '王玉珏', 1, 'Web开发', '15894750394', '192837460', '989802xx', 1, 0, 'Web', 'PHP', NULL, NULL, NULL, NULL, '使用HTML标记、div+css+javascript Dom操作等前端WEB技术进行网站的开发与制造; 　　\r\n使用mvc思想、oop面向对象思想、ThinkPHP模板框架、基于jQuery的EasyUI框架、Smarty模板引擎等技术来做项目开发。\r\n熟练掌握photoshop，dreamweaver，fireworks等日常网站设计工具，能运用所学技能，完成网页设计和制作，实现交互功能，不断创新，符合用户体验，并兼容主流浏览器。\r\n', '2018-04-07 00:03:05'),
(5, 'gjl', '202cb962ac59075b964b07152d234b70', '郭嘉璐', 1, '产品经理', NULL, '2938376584', 'gjl1912', 1, 0, '脑图设计', '原型图', '人员调配', '时间控制', NULL, NULL, '熟练掌握网站产品策划，提供需求分析、产品原型设计、功能描述等文档的撰写的能力; 　　\r\n擅长产品上线后的改进，组织产品测试，进行BUG跟踪、收集改进意见、提供改进方案，引导用户熟悉使用产品。\r\n擅长制作产品销售单(workshop order sheet)，编制生产工艺流程sop ，核对校正或者重新制作产品说明书; \r\n擅长协助采购部门开发新供应商，协助供应商解决生产过程中图纸的解释，工艺等; 7.根据工程项目需要，设计非标准产品\r\n', '2018-04-07 00:07:19'),
(6, 'lx', '202cb962ac59075b964b07152d234b70', '廖星', 1, '全栈', NULL, NULL, 'lx', 0, 0, '全栈', '全栈', '全栈', NULL, NULL, NULL, '精通各类语言\r\n自主开发若干项目，拥有丰富的PHP开发，移动端开发，网页开发，微信小程序开发项目经验\r\n擅长产品的运营维护\r\n擅长用高级算法解决问题\r\n', '2018-04-07 00:08:27');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
