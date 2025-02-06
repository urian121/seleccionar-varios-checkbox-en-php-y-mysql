CREATE TABLE `tbl_users` (
  `idUser` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nameUser` varchar(50) DEFAULT NULL,
  `emailUser` varchar(45) DEFAULT NULL,
  `passwordUser` mediumtext DEFAULT NULL,
  `typeUser` int(11) DEFAULT 1,
  `statusUser` bigint(20) DEFAULT 1,
  `lastDateLogin` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;