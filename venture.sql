-- MariaDB dump 10.19  Distrib 10.10.3-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: venture
-- ------------------------------------------------------
-- Server version	10.10.3-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES
(180,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',6),
(181,'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',6),
(182,'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.',6),
(183,'Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.',6),
(184,'Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &amp;quot;de Finibus Bonorum et Malorum&amp;quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.',2),
(185,'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&amp;#039;t look even slightly believable.',2),
(186,'If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&amp;#039;t anything embarrassing hidden in the middle of text.',2),
(187,'The way I see it, every life is a pile of good things and bad things.…hey.…the good things don&amp;#039;t always soften the bad things; but vice-versa the bad things don&amp;#039;t necessarily spoil the good things and make them unimportant.',2),
(188,'That&amp;#039;s what it said on &amp;#039;Ask Jeeves.&amp;#039; He&amp;#039;ll want to use your yacht, and I don&amp;#039;t want this thing smelling like fish. Guy&amp;#039;s a pro. There&amp;#039;s only one man I&amp;#039;ve ever called a coward, and that&amp;#039;s Brian Doyle Murray. No, what I&amp;#039;m calling you is a television actor.',2),
(189,'Isn&amp;#039;t it true that you have been paid for your testimony? I could if you hadn&amp;#039;t turned on the light and shut off my stereo. This is the worst kind of discrimination: the kind against me! Bender, I didn&amp;#039;t know you liked cooking. That&amp;#039;s so cute.\r\n\r\nSay what? This is the worst kind of discrimination: the kind against me! Do a flip! Our love isn&amp;#039;t any different from yours, except it&amp;#039;s hotter, because I&amp;#039;m involved. Say what? We need rest. The spirit is willing, but the flesh is spongy and bruised.',2),
(190,'I will not kill my sister. I will not kill my sister. I will not kill my sister. I&amp;#039;m really more an apartment person. Hello, Dexter Morgan. I&amp;#039;m a sociopath; there&amp;#039;s not much he can do for me. Oh I beg to differ, I think we have a lot to discuss. After all, you are a client.',2),
(191,'I&amp;#039;m generally confused most of the time. He taught me a code. To survive. I am not a killer. I&amp;#039;m not the monster he wants me to be. So I&amp;#039;m neither man nor beast. I&amp;#039;m something new entirely. With my own set of rules. I&amp;#039;m Dexter. Boo.\r\n\r\nTell him time is of the essence. I like seafood. You look…perfect. Pretend. You pretend the feelings are there, for the world, for the people around you. Who knows? Maybe one day they will be. I&amp;#039;m a sociopath; there&amp;#039;s not much he can do for me.',1),
(192,'You hit me with a cricket bat. *Insistently* Bow ties are cool! Come on Amy, I&amp;#039;m a normal bloke, tell me what normal blokes do! Annihilate? No. No violence. I won&amp;#039;t stand for it. Not now, not ever, do you understand me?! I&amp;#039;m the Doctor, the Oncoming Storm - and you basically meant beat them in a football match, didn&amp;#039;t you?',1),
(193,'The way I see it, every life is a pile of good things and bad things.…hey.…the good things don&amp;#039;t always soften the bad things; but vice-versa the bad things don&amp;#039;t necessarily spoil the good things and make them unimportant. The way I see it, every life is a pile of good things and bad things.…hey.…the good things don&amp;#039;t always soften the bad things; but vice-versa the bad things don&amp;#039;t necessarily spoil the good things and make them unimportant.',1),
(194,'Well, what do you expect, mother? No, I did not kill Kitty. However, I am going to oblige and answer the nice officer&amp;#039;s questions because I am an honest man with no secrets to hide. No, I did not kill Kitty. However, I am going to oblige and answer the nice officer&amp;#039;s questions because I am an honest man with no secrets to hide.',1),
(195,'Bender, I didn&amp;#039;t know you liked cooking. That&amp;#039;s so cute. Can we have Bender Burgers again? Man, I&amp;#039;m sore all over. I feel like I just went ten rounds with mighty Thor. Oh Leela! You&amp;#039;re the only person I could turn to; you&amp;#039;re the only person who ever loved me.',1);
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `permission` varchar(45) NOT NULL,
  `readonly` varchar(45) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'admin','$2y$12$VUuvP/hZLTmkkpVjLGfRaO1oP3ChYT4tbTr3nKVPHeti.VNeievrO','admin','no'),
(2,'user','$2y$12$gor6WNJLUExwVm8dYBDu3eARYrnypT1CHWxWqnL8/r6IejEq8vPte','user','YES'),
(6,'user2','$2y$12$/.3VWeFmUnYGl.t0BVxLsuCfaKU8IZiosgzG9b//mvTCZ2flF5vdu','user','YES');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-19  0:01:13
