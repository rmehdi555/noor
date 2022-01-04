

teachers_work_hours_lists
az 1000   shro shavad

teachers_card_number_banks
teachers_work_hours



ALTER TABLE `act_list_hefz_t_s` CHANGE `mark` `s_h_t` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `act_list_hefzs` ADD `mark_d3` VARCHAR(191) NULL DEFAULT NULL AFTER `j_d2`, ADD `j_d3` INT NULL DEFAULT NULL AFTER `mark_d3`;
