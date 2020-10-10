DROP TABLE IF EXISTS `player`;

CREATE TABLE `player` (
  `code`  int(11)         auto_increment,
  `name`  varchar(255)    DEFAULT NULL,
  `level` int(11)         DEFAULT NULL,
  `rate`  int(11)         DEFAULT NULL,
  `play`  enum('楽しく', '本気', '両方') DEFAULT '楽しく',
  `done`  enum('自由に動き回る', '前衛で戦う', '指示に従う', '後衛でサポート') DEFAULT '前衛で戦う',
  `voice` enum('YES', 'NO', 'BOTH') DEFAULT 'BOTH',
  PRIMARY KEY(`code`)
)ENGINE=InnoDB;
