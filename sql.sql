ALTER TABLE `payments` ADD `Token` TEXT NULL AFTER `extraDetail`, ADD `RetrivalRefNo` TEXT NULL AFTER `Token`, ADD `SystemTraceNo` TEXT NULL AFTER `RetrivalRefNo`;


--1400-07-05

CREATE TABLE `users_deleteds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `old_id` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_deleteds`
--
ALTER TABLE `users_deleteds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_deleteds_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_deleteds`
--
ALTER TABLE `users_deleteds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;





CREATE TABLE `students_deleteds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flag_cookie` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `student_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sh_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meli_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sh_sodor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tavalod_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `married` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `phone_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_f` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_m` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_children` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `old_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students_deleteds`
--
ALTER TABLE `students_deleteds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_deleteds_phone_1_unique` (`phone_1`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students_deleteds`
--
ALTER TABLE `students_deleteds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;



