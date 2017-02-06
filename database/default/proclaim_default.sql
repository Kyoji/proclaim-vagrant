--
-- Table structure for `proclaim_posts`
--

DROP TABLE IF EXISTS `proclaim_posts`;
CREATE TABLE `proclaim_posts` (
  `ID`           BIGINT(20) UNSIGNED                 NOT NULL AUTO_INCREMENT,
  `post_author`  BIGINT(20) UNSIGNED                 NOT NULL DEFAULT '0',
  `post_date`    DATETIME                            NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_name`    VARCHAR(200)
                 COLLATE utf8mb4_unicode_ci          NOT NULL DEFAULT '',
  `post_content` LONGTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_slug`    VARCHAR(200)                        NOT NULL,
  PRIMARY KEY (`ID`)
)
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

LOCK TABLES `proclaim_posts` WRITE;
INSERT INTO `proclaim_posts` VALUES
  (1, 1, '2016-12-10 10:32:31', 'Test Post 1', 'This is some testing text. Do not read into this.', 'test-post-one');
UNLOCK TABLES;

--
-- Table structure for `proclaim_taxonomies`
--

DROP TABLE IF EXISTS `proclaim_taxonomies`;
CREATE TABLE `proclaim_taxonomies` (
  `ID`            BIGINT(20) UNSIGNED        NOT NULL AUTO_INCREMENT,
  `taxonomy_slug` VARCHAR(200)               NOT NULL,
  `taxonomy_name` VARCHAR(200)
                  COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `taxonomy_type` VARCHAR(200)               NOT NULL,
  PRIMARY KEY (`ID`)
)
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

LOCK TABLES `proclaim_taxonomies` WRITE;
INSERT INTO `proclaim_taxonomies` VALUES
  (1, 'test-tax', 'Test Taxonomy', 'Post');
UNLOCK TABLES;

--
-- Table structure for `proclaim_passwords`
--

DROP TABLE IF EXISTS `proclaim_users`;
CREATE TABLE `proclaim_users` (
  `ID`            INT(5) UNSIGNED        NOT NULL,
  `user_password` VARCHAR(60)
                  COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name`     VARCHAR(20)
                  COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role`     VARCHAR(20)
                  COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`ID`)
)
  DEFAULT CHAR SET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

LOCK TABLES `proclaim_users`  WRITE;
INSERT INTO `proclaim_users`  VALUES
  ( FLOOR(RAND() * 500), '$2y$10$HOWOkML8jRpuAJjeGufSg.t1gSHPvfwvhqxe7ClgDejWlLnHbNUi6', 'admin', 'admin');
UNLOCK TABLES;