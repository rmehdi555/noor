ALTER TABLE `deposits` ADD `month` VARCHAR(191) NOT NULL DEFAULT '1' AFTER `title`, ADD `year` VARCHAR(191) NOT NULL DEFAULT '1400' AFTER `month`;
