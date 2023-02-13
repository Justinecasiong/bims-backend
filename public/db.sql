

CREATE TABLE `barangay_information` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipality_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO barangay_information (id, province, municipality, barangay, contact_num, description, municipality_logo, barangay_logo, created_at, updated_at) VALUES ('1','LEYTE','TACLOBAN CITY','BARANGAY 6-A STO. NIÑO EXT.','(053) 300 -2436','','','','2022-10-30 21:19:20','2022-10-30 21:19:20');


CREATE TABLE `barangay_officials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `chairmanship_id` bigint(20) unsigned NOT NULL,
  `position_id` bigint(20) unsigned NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `term_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `term_end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zone_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barangay_officials_chairmanship_id_foreign` (`chairmanship_id`),
  KEY `barangay_officials_position_id_foreign` (`position_id`),
  CONSTRAINT `barangay_officials_chairmanship_id_foreign` FOREIGN KEY (`chairmanship_id`) REFERENCES `chairmanships` (`id`),
  CONSTRAINT `barangay_officials_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `blotters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `complainant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `respondent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `victims` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blotter_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `business_permits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_nature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `certification_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `resident_id` bigint(20) unsigned NOT NULL,
  `certification_id` bigint(20) unsigned NOT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expected_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expected_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `certification_requests_resident_id_foreign` (`resident_id`),
  KEY `certification_requests_certification_id_foreign` (`certification_id`),
  CONSTRAINT `certification_requests_certification_id_foreign` FOREIGN KEY (`certification_id`) REFERENCES `certification_requests` (`id`),
  CONSTRAINT `certification_requests_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `certifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `certification_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO certifications (id, certification_description, title, price, created_at, updated_at) VALUES ('1','Barangay Certificate','BARANGAY CERTIFICATION','180.00','2022-10-30 21:19:21','2022-10-30 21:19:21');

INSERT INTO certifications (id, certification_description, title, price, created_at, updated_at) VALUES ('2','Barangay Clearance','BARANGAY CLEARANCE','180.00','2022-10-30 21:19:21','2022-10-30 21:19:21');

INSERT INTO certifications (id, certification_description, title, price, created_at, updated_at) VALUES ('3','Certificate of Indigency','CERTIFICATE OF INDIGENCY','','2022-10-30 21:19:21','2022-10-30 21:19:21');

INSERT INTO certifications (id, certification_description, title, price, created_at, updated_at) VALUES ('4','Business Permit','BUSINESS PERMIT','180.00','2022-10-30 21:19:21','2022-10-30 21:19:21');


CREATE TABLE `chairmanships` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `chairmanship_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO chairmanships (id, chairmanship_description, created_at, updated_at) VALUES ('1','Presiding Officer','2022-10-30 21:19:19','2022-10-30 21:19:19');

INSERT INTO chairmanships (id, chairmanship_description, created_at, updated_at) VALUES ('2','Committee on Infrastructure','2022-10-30 21:19:19','2022-10-30 21:19:19');

INSERT INTO chairmanships (id, chairmanship_description, created_at, updated_at) VALUES ('3','Committee on Finance','2022-10-30 21:19:19','2022-10-30 21:19:19');

INSERT INTO chairmanships (id, chairmanship_description, created_at, updated_at) VALUES ('4','Committee on Laws and Ordinance','2022-10-30 21:19:19','2022-10-30 21:19:19');

INSERT INTO chairmanships (id, chairmanship_description, created_at, updated_at) VALUES ('5','Committee on Education','2022-10-30 21:19:19','2022-10-30 21:19:19');

INSERT INTO chairmanships (id, chairmanship_description, created_at, updated_at) VALUES ('6','Committee on Peace and Order','2022-10-30 21:19:19','2022-10-30 21:19:19');

INSERT INTO chairmanships (id, chairmanship_description, created_at, updated_at) VALUES ('7','Committee on Health','2022-10-30 21:19:19','2022-10-30 21:19:19');

INSERT INTO chairmanships (id, chairmanship_description, created_at, updated_at) VALUES ('8','Committee on Agriculture','2022-10-30 21:19:19','2022-10-30 21:19:19');

INSERT INTO chairmanships (id, chairmanship_description, created_at, updated_at) VALUES ('9','Committee on Youth & Sports','2022-10-30 21:19:19','2022-10-30 21:19:19');

INSERT INTO chairmanships (id, chairmanship_description, created_at, updated_at) VALUES ('10','None','2022-10-30 21:19:19','2022-10-30 21:19:19');


CREATE TABLE `covid_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `resident_id` bigint(20) unsigned NOT NULL,
  `vaccination_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dose_num` int(11) NOT NULL,
  `booster_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `covid_statuses_resident_id_foreign` (`resident_id`),
  CONSTRAINT `covid_statuses_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `gcash` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `certification_request_id` bigint(20) unsigned NOT NULL,
  `evidence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gcash_certification_request_id_foreign` (`certification_request_id`),
  CONSTRAINT `gcash_certification_request_id_foreign` FOREIGN KEY (`certification_request_id`) REFERENCES `certification_requests` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `gcash_q_r_s` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `households` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `zone_id` bigint(20) unsigned NOT NULL,
  `total_no` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `households_zone_id_foreign` (`zone_id`),
  CONSTRAINT `households_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO migrations (id, migration, batch) VALUES ('1','2014_10_12_000000_create_users_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('2','2022_08_13_125807_create_zones_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('3','2022_08_13_130131_create_business_permits_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('4','2022_08_13_130206_create_revenues_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('5','2022_08_13_130224_create_positions_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('6','2022_08_13_130251_create_barangay_information_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('7','2022_08_13_130313_create_blotters_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('8','2022_08_13_130407_create_chairmanships_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('9','2022_08_13_130548_create_barangay_officials_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('10','2022_08_13_130938_create_households_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('11','2022_08_13_131100_create_residents_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('12','2022_08_13_131200_create_covid_statuses_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('13','2022_09_18_072815_add_permission_in_users_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('14','2022_09_18_115140_add_remember_token_in_residents_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('15','2022_09_20_135437_add_profile_pic_in_barangay_officials','1');

INSERT INTO migrations (id, migration, batch) VALUES ('16','2022_09_21_120904_create_certifications_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('17','2022_09_21_120937_create_certification_requets_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('18','2022_09_28_140842_add_identifacation_in_residents_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('19','2022_10_01_154250_add_resident_id_in_revenues','1');

INSERT INTO migrations (id, migration, batch) VALUES ('20','2022_10_02_074449_add_date_in_revenues','1');

INSERT INTO migrations (id, migration, batch) VALUES ('21','2022_10_09_101701_add_remember_token_in_barangay_officials_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('22','2022_10_26_050138_add_zone_id_in_barangay_officials_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('23','2022_10_29_084133_create_gcash_models_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('24','2022_10_29_102134_create_gcash_q_r_s_table','1');


CREATE TABLE `positions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `position_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO positions (id, position_description, created_at, updated_at) VALUES ('1','Chairperson','2022-10-30 21:19:18','2022-10-30 21:19:18');

INSERT INTO positions (id, position_description, created_at, updated_at) VALUES ('2','Secretary','2022-10-30 21:19:18','2022-10-30 21:19:18');

INSERT INTO positions (id, position_description, created_at, updated_at) VALUES ('3','Treasurer','2022-10-30 21:19:18','2022-10-30 21:19:18');

INSERT INTO positions (id, position_description, created_at, updated_at) VALUES ('4','Kagawad','2022-10-30 21:19:18','2022-10-30 21:19:18');

INSERT INTO positions (id, position_description, created_at, updated_at) VALUES ('5','SK Chairman','2022-10-30 21:19:18','2022-10-30 21:19:18');


CREATE TABLE `residents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `zone_id` bigint(20) unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voter_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identified_as` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pwd_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `educational_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yearly_income` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pregnant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `residents_zone_id_foreign` (`zone_id`),
  CONSTRAINT `residents_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `revenues` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `resident_id` bigint(20) unsigned NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `revenues_resident_id_foreign` (`resident_id`),
  CONSTRAINT `revenues_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, permission) VALUES ('1','admin','admin@gmail.com','','$2y$10$BGkbKIBE5pDymuYnHi3wj.g7gk3Rtrp1wWHJ5SpZ2FW9GJ1s3JQQa','$2y$10$JLT5zmiYtO7Mzf.gsHDb/.X2MY5cQV9NW6G.s/46tDaRIvPAzcnKa','2022-10-30 21:19:21','2022-10-30 21:19:21','admin');


CREATE TABLE `zones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `zone_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO zones (id, zone_description, details, created_at, updated_at) VALUES ('1','Zone 1',' ','2022-10-30 21:19:17','2022-10-30 21:19:17');

INSERT INTO zones (id, zone_description, details, created_at, updated_at) VALUES ('2','Zone 2',' ','2022-10-30 21:19:17','2022-10-30 21:19:17');

INSERT INTO zones (id, zone_description, details, created_at, updated_at) VALUES ('3','Zone 3',' ','2022-10-30 21:19:17','2022-10-30 21:19:17');

INSERT INTO zones (id, zone_description, details, created_at, updated_at) VALUES ('4','Zone 4',' ','2022-10-30 21:19:17','2022-10-30 21:19:17');

INSERT INTO zones (id, zone_description, details, created_at, updated_at) VALUES ('5','Zone 5',' ','2022-10-30 21:19:17','2022-10-30 21:19:17');

INSERT INTO zones (id, zone_description, details, created_at, updated_at) VALUES ('6','Zone 6',' ','2022-10-30 21:19:17','2022-10-30 21:19:17');

INSERT INTO zones (id, zone_description, details, created_at, updated_at) VALUES ('7','Zone 7',' ','2022-10-30 21:19:17','2022-10-30 21:19:17');
