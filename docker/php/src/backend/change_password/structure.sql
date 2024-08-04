--
-- Database: `phppot_examples`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(8) NOT NULL AUTO_INCREMENT,
  `userName` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `displayName` varchar(55) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `password`, `displayName`) VALUES
(1, 'admin', '$2a$10$0FHEQ5/cplO3eEKillHvh.y009Wsf4WCKvQHsZntLamTUToIBe.fG', 'Admin');
