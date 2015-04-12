DROP TABLE periodo;

CREATE TABLE IF NOT EXISTS `periodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(4) NOT NULL,
  `numero` enum('1','2') NOT NULL,
  `inicioPer` date NOT NULL,
  `finPer` date NOT NULL,
  `inicioEval` date NOT NULL,
  `finEval` date NOT NULL,
  `inicioEntrega` date NOT NULL,
  `finEntrega` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


