DROP DATABASE IF EXISTS zoomind;
CREATE DATABASE zoomind;
USE zoomind;

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `number` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_answer` tinyint(1) DEFAULT NULL,
  `question_id` varchar(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `username` varchar(255) NOT NULL,
  `quiz_number` int NOT NULL,
  `attempt_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obtained_marks` int NOT NULL DEFAULT '0',
  `total_marks` int NOT NULL DEFAULT '0',
  `result` enum('pass','fail') NOT NULL,
  `is_favourite` tinyint(1) NOT NULL DEFAULT '0'
);

--
-- Triggers `progress`
--
DELIMITER $$
CREATE TRIGGER `increment_attempt_on_insert` AFTER INSERT ON `progress` FOR EACH ROW BEGIN
    UPDATE quiz
    SET count_attempt = count_attempt + 1
    WHERE number = NEW.quiz_number;
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `increment_passed_on_pass` AFTER INSERT ON `progress` FOR EACH ROW BEGIN
    IF NEW.result = 'pass' THEN
        UPDATE quiz
        SET count_passed = count_passed + 1
        WHERE number = NEW.quiz_number;
    END IF;
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `update_count_favourite` AFTER INSERT ON `progress` FOR EACH ROW BEGIN
    IF NEW.is_favourite = '1' THEN
        UPDATE quiz
        SET count_favourite = count_favourite + 1
        WHERE number = NEW.quiz_number;
    END IF;
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `update_count_favourite_update` AFTER UPDATE ON `progress` FOR EACH ROW BEGIN
    IF OLD.is_favourite = '1' AND NEW.is_favourite = '0' THEN
        UPDATE quiz
        SET count_favourite = count_favourite - 1
        WHERE number = OLD.quiz_number;
    ELSEIF OLD.is_favourite = '0' AND NEW.is_favourite = '1' THEN
        UPDATE quiz
        SET count_favourite = count_favourite + 1
        WHERE number = NEW.quiz_number;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `update_count_favourite_delete` AFTER DELETE ON `progress` FOR EACH ROW BEGIN
    IF OLD.is_favourite = '1' THEN
        UPDATE quiz
        SET count_favourite = count_favourite - 1
        WHERE number = OLD.quiz_number;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `update_high_score` AFTER INSERT ON `progress` FOR EACH ROW BEGIN
    DECLARE max_marks INT;

    SELECT MAX(obtained_marks) INTO max_marks
    FROM progress
    WHERE quiz_number = NEW.quiz_number;

    UPDATE quiz
    SET high_score = max_marks
    WHERE number = NEW.quiz_number;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` varchar(255) NOT NULL,
  `statement` text NOT NULL,
  `quiz_number` int DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `number` int NOT NULL,
  `title` text NOT NULL,
  `description` text,
  `category` varchar(255) NOT NULL,
  `difficulty` enum('1','2','3','4','5') NOT NULL,
  `count_attempt` int DEFAULT '0',
  `count_passed` int DEFAULT '0',
  `count_favourite` int NOT NULL DEFAULT '0',
  `high_score` int DEFAULT '0',
  `upload_by` varchar(255) NOT NULL,
  `upload_on` date NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`number`),
  ADD KEY `fk_question_id` (`question_id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`username`,`quiz_number`),
  ADD KEY `fk_progress_quiz_number` (`quiz_number`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_number_index` (`quiz_number`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`number`),
  ADD KEY `difficulty_index` (`difficulty`),
  ADD KEY `upload_by_index` (`upload_by`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `number` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `number` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `fk_question_id` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `fk_progress_quiz_number` FOREIGN KEY (`quiz_number`) REFERENCES `quiz` (`number`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_progress_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT;
--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_question_quiz_number` FOREIGN KEY (`quiz_number`) REFERENCES `quiz` (`number`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `fk_upload_by_username` FOREIGN KEY (`upload_by`) REFERENCES `user` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;