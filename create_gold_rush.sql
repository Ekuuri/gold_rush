CREATE DATABASE IF NOT EXISTS gold_rush_game
DEFAULT CHARACTER SET utf8mb4;

USE gold_rush_game;

CREATE TABLE IF NOT EXISTS users (
	userId INT UNSIGNED NOT NULL AUTO_INCREMENT, 			# unsinged povoluje pouze přirozená čísla a rozšíří tím int limit
    userName VARCHAR(12) NOT NULL,
    email VARCHAR(320) NOT NULL, 							# nejdelší možná emailová adresa má 320 znaků
    passwordBcrypt BINARY(60) NOT NULL, 					# bcrypt vždy vyhodí 60 znakový hash
    `role` ENUM("admin", "user") NOT NULL DEFAULT "user",
    createdDate DATETIME NOT NULL DEFAULT now(),
    PRIMARY KEY (userId),
    UNIQUE KEY (userName)
);

CREATE TABLE IF NOT EXISTS score (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    userId INT UNSIGNED NOT NULL,
    createdDatetime DATETIME NOT NULL DEFAULT now(),
    result INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (userId) REFERENCES users(userId)
);

CREATE VIEW leaderboard AS
SELECT u.userName, s.*
FROM score s LEFT JOIN users u
ON s.userId = u.userId
ORDER BY s.result DESC; 										# předběžný žebříček pro otestování databáze

-- testovací hodnoty budou odstraněny ve finální verzi --

insert into users (userName, email, passwordBcrypt, role)
values ("GM", "tlescenko@gmail.com", 2, "admin");

insert into score (userId, result)
values (1, 69);

insert into users (userName, email, passwordBcrypt, role)
values ("QT", "tlescenkos@gmail.com", 3, "admin");

insert into score (userId, result)
values (2, 1337);

SELECT * FROM leaderboard;

SELECT * FROM score;

SELECT * FROM users;

-- konec testovacích hodnot --
