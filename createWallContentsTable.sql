--
-- Table structure for table `wallContents`
--

CREATE TABLE IF NOT EXISTS wallChallengeCI.wallContents
(
	postNumber	INT NOT NULL AUTO_INCREMENT,
	name	VARCHAR(24) NOT NULL,
	email 	VARCHAR(64) NOT NULL,
	website VARCHAR(64),
	comment VARCHAR(512),
	submittedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(postNumber)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
