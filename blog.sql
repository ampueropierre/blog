CREATE TABLE roles (
                id INT AUTO_INCREMENT NOT NULL,
                name VARCHAR(20) NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE users (
                id INT AUTO_INCREMENT NOT NULL,
                firstname VARCHAR(100) NOT NULL,
                lastname VARCHAR(100) NOT NULL,
                mail VARCHAR(100) NOT NULL,
                password VARCHAR(80) NOT NULL,
                roles_id INT DEFAULT 3 NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE posts (
                id INT AUTO_INCREMENT NOT NULL,
                title VARCHAR(100) NOT NULL,
                chapo VARCHAR(100) NOT NULL,
                img TEXT NOT NULL,
                content TEXT NOT NULL,
                date_creation DATETIME NOT NULL,
                date_modification DATETIME NOT NULL,
                users_id INT DEFAULT 1 NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE TABLE comments (
                id INT AUTO_INCREMENT NOT NULL,
                posts_id INT NOT NULL,
                content TEXT NOT NULL,
                status TINYINT DEFAULT 0 NOT NULL,
                comment_date DATETIME NOT NULL,
                users_id INT NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


ALTER TABLE users ADD CONSTRAINT roles_users_fk
FOREIGN KEY (roles_id)
REFERENCES roles (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE posts ADD CONSTRAINT users_posts_fk
FOREIGN KEY (users_id)
REFERENCES users (id)
ON DELETE CASCADE
ON UPDATE NO ACTION;

ALTER TABLE comments ADD CONSTRAINT users_comments_fk
FOREIGN KEY (users_id)
REFERENCES users (id)
ON DELETE CASCADE
ON UPDATE NO ACTION;

ALTER TABLE comments ADD CONSTRAINT posts_comments_fk
FOREIGN KEY (posts_id)
REFERENCES posts (id)
ON DELETE CASCADE
ON UPDATE NO ACTION;

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Editeur'),
(3, 'Connecté');

INSERT INTO `users` (`firstname`, `lastname`, `mail`, `password`, `roles_id`) VALUES
('Admin', 'Admin', 'admin@gmail.com', '$2y$10$CzQtBuWb0GCWCn799dDoau6lD/egTdL6cLeUK.stetxvu1TI7ENAC', 1);

INSERT INTO `posts` (`users_id`, `title`, `chapo`, `img`, `content`, `date_creation`, `date_modification`) VALUES
(1, 'Création du blog', 'Le début de la gloire !', 'private/img/bicycle-blue.jpg', 'Suspendisse at lacinia ipsum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris pretium ex eget massa convallis, in faucibus ipsum efficitur. Vivamus tempus mauris quis ligula tempus faucibus. Fusce dapibus nulla accumsan ante egestas, gravida mattis est luctus. Vivamus laoreet blandit sagittis. Quisque aliquet, mi a vulputate gravida, eros eros porta nisi, vel dignissim turpis sem id urna. Nam mollis ornare imperdiet. Suspendisse potenti. Donec convallis tempus condimentum.\r\n\r\nNulla dapibus placerat lectus sit amet rhoncus. Maecenas pretium libero efficitur efficitur condimentum. Nulla sed ultricies nisl. Vestibulum orci sem, sodales non sodales a, maximus sit amet elit. Pellentesque eu ultricies elit. Donec commodo vel ligula eu lobortis. Curabitur ultricies urna sit amet magna scelerisque convallis. Etiam imperdiet neque vel velit cursus finibus. Suspendisse potenti. Nunc dapibus nibh eu mi auctor, ac sollicitudin nisl scelerisque. Nunc cursus molestie ex, in lacinia nisi vulputate nec.\r\n\r\nIn hac habitasse platea dictumst. Donec egestas aliquam tincidunt. Sed maximus at nulla nec semper. Vestibulum vitae ipsum ac ipsum interdum lobortis. Ut facilisis ipsum tincidunt imperdiet ornare. Donec aliquam suscipit pharetra. Praesent vitae ante quis quam cursus dapibus a non diam. Mauris condimentum condimentum magna a fringilla. Praesent blandit ipsum malesuada.', '2019-02-24 10:49:24', '2019-02-24 10:49:24');

INSERT INTO `comments` (`posts_id`, `users_id`, `content`, `status`, `comment_date`) VALUES
(1, 1, 'Donec suscipit mollis orci, id venenatis ipsum fermentum nec.', 1, '2019-02-24 16:53:16');