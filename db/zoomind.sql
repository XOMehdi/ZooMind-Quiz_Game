CREATE TABLE `quiz`(
    `number` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `category` VARCHAR(255) NOT NULL,
    `difficulty` ENUM('') NOT NULL,
    `count_attempts` INT NOT NULL,
    `count_passed` INT NOT NULL,
    `upload_by` VARCHAR(255) NOT NULL,
    `upload_date` DATE NOT NULL
);
CREATE TABLE `progress`(
    `username` VARCHAR(255) NOT NULL,
    `quiz_number` INT NOT NULL,
    `marks` INT NOT NULL,
    `result` ENUM('') NOT NULL,
    `is_favourite` TINYINT(1) NOT NULL,
    PRIMARY KEY(`username`)
);
ALTER TABLE
    `progress` ADD PRIMARY KEY(`quiz_number`);
CREATE TABLE `option`(
    `number` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `question_id` VARCHAR(255) NOT NULL
);
CREATE TABLE `question`(
    `id` VARCHAR(255) NOT NULL,
    `statement` TEXT NOT NULL,
    `answer_option_number` INT NOT NULL,
    `quiz_number` INT NOT NULL,
    PRIMARY KEY(`id`)
);
CREATE TABLE `profile`(
    `username` VARCHAR(255) NOT NULL,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NULL,
    `password` VARCHAR(255) NOT NULL,
    PRIMARY KEY(`username`)
);
ALTER TABLE
    `profile` ADD CONSTRAINT `profile_last_name_foreign` FOREIGN KEY(`last_name`) REFERENCES `progress`(`quiz_number`);
ALTER TABLE
    `question` ADD CONSTRAINT `question_statement_foreign` FOREIGN KEY(`statement`) REFERENCES `option`(`question_id`);
ALTER TABLE
    `quiz` ADD CONSTRAINT `quiz_count_attempts_foreign` FOREIGN KEY(`count_attempts`) REFERENCES `progress`(`marks`);
ALTER TABLE
    `question` ADD CONSTRAINT `question_statement_foreign` FOREIGN KEY(`statement`) REFERENCES `quiz`(`number`);