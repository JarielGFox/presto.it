/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `adverts`;
CREATE TABLE `adverts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `typology` int unsigned DEFAULT NULL,
  `is_accepted` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `adverts_category_id_foreign` (`category_id`),
  KEY `adverts_user_id_foreign` (`user_id`),
  CONSTRAINT `adverts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `adverts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_de` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `advert_id` bigint unsigned DEFAULT NULL,
  `path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `labels` text COLLATE utf8mb4_unicode_ci,
  `adult` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spoof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medical` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `violence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `racy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_advert_id_foreign` (`advert_id`),
  CONSTRAINT `images_advert_id_foreign` FOREIGN KEY (`advert_id`) REFERENCES `adverts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role` int NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `biography` longtext COLLATE utf8mb4_unicode_ci,
  `profilepic` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` longtext COLLATE utf8mb4_unicode_ci,
  `provider_id` longtext COLLATE utf8mb4_unicode_ci,
  `provider` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `adverts` (`id`, `category_id`, `user_id`, `title`, `body`, `price`, `typology`, `is_accepted`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 'Synth TV', 'Una TV accattivante dallo stile Retrò e dallo stile synthwave. Cosa fa una TV in mare? Va in onda!', 75.00, 1, 1, '2023-04-29 07:10:08', '2023-04-29 07:11:14');
INSERT INTO `adverts` (`id`, `category_id`, `user_id`, `title`, `body`, `price`, `typology`, `is_accepted`, `created_at`, `updated_at`) VALUES
(2, 12, 1, 'Synth Bike', 'Una motocicletta dallo stile Synth. A volte può diventare un raptor assassino all\'occorrenza. Il colmo per un motociclista? Mettersi i bastoni tra le ruote.', 1200.00, 2, 1, '2023-04-29 07:25:05', '2023-04-29 07:25:40');
INSERT INTO `adverts` (`id`, `category_id`, `user_id`, `title`, `body`, `price`, `typology`, `is_accepted`, `created_at`, `updated_at`) VALUES
(3, 13, 1, 'Synth Walkman', 'Un accattivante Walkman dallo stile anni \'80. Completo anche di cassette al seguito. ', 35.00, 1, 1, '2023-04-29 07:32:08', '2023-04-29 07:32:24');
INSERT INTO `adverts` (`id`, `category_id`, `user_id`, `title`, `body`, `price`, `typology`, `is_accepted`, `created_at`, `updated_at`) VALUES
(4, 9, 1, 'Synth Watch', 'Un orologio dallo stile accattivante Synthwave con un pizzico di retrò nostalgia. Il colmo per un orologio? Non vedere l\'ora!', 25.00, 2, 1, '2023-04-29 08:08:19', '2023-04-29 08:08:39'),
(5, 12, 1, 'Annuncio di Prova', 'Annuncio di prova e test.', 100.00, 3, 1, '2023-04-29 09:08:32', '2023-04-29 09:10:08');

INSERT INTO `categories` (`id`, `name`, `name_en`, `name_de`, `created_at`, `updated_at`) VALUES
(1, 'Abbigliamento', 'Clothing', 'Kleidung', '2023-04-29 06:53:49', '2023-04-29 06:53:49');
INSERT INTO `categories` (`id`, `name`, `name_en`, `name_de`, `created_at`, `updated_at`) VALUES
(2, 'Animali', 'Animals', 'Tiere', '2023-04-29 06:53:49', '2023-04-29 06:53:49');
INSERT INTO `categories` (`id`, `name`, `name_en`, `name_de`, `created_at`, `updated_at`) VALUES
(3, 'Arredamento', 'Furniture', 'Möbel', '2023-04-29 06:53:49', '2023-04-29 06:53:49');
INSERT INTO `categories` (`id`, `name`, `name_en`, `name_de`, `created_at`, `updated_at`) VALUES
(4, 'Chincaglierie e Miscellanea', 'Trinkets and Miscellaneous', 'Schmuck und Sonstiges', '2023-04-29 06:53:49', '2023-04-29 06:53:49'),
(5, 'Collezionismo', 'Collectables', 'Sammlerstücke', '2023-04-29 06:53:49', '2023-04-29 06:53:49'),
(6, 'Elettronica', 'Electronics', 'Elektronik', '2023-04-29 06:53:49', '2023-04-29 06:53:49'),
(7, 'Giardinaggio', 'Gardening', 'Gartenarbeit', '2023-04-29 06:53:49', '2023-04-29 06:53:49'),
(8, 'Libri e Riviste', 'Books and Magazines', 'Bücher und Zeitschriften', '2023-04-29 06:53:49', '2023-04-29 06:53:49'),
(9, 'Orologi e Gioielli', 'Watches And Jewelry', 'Uhren und Juwelen', '2023-04-29 06:53:49', '2023-04-29 06:53:49'),
(10, 'Immobili', 'Properties', 'Eigenschaften', '2023-04-29 06:53:49', '2023-04-29 06:53:49'),
(11, 'Informatica', 'Informatics', 'Informatik', '2023-04-29 06:53:49', '2023-04-29 06:53:49'),
(12, 'Motori', 'Vehicles and motors', 'Motoren', '2023-04-29 06:53:49', '2023-04-29 06:53:49'),
(13, 'Musica, CD e Vinili', 'Music, CDs and Vinyls', 'Musik, CDs und Vinyls', '2023-04-29 06:53:49', '2023-04-29 06:53:49'),
(14, 'Sport', 'Sport', 'Sport', '2023-04-29 06:53:49', '2023-04-29 06:53:49'),
(15, 'Strumenti Musicali', 'Musical instruments', 'Musikinstrumente', '2023-04-29 06:53:49', '2023-04-29 06:53:49'),
(16, 'Videogiochi', 'Videogame', 'Videospiele', '2023-04-29 06:53:49', '2023-04-29 06:53:49');



INSERT INTO `images` (`id`, `advert_id`, `path`, `created_at`, `updated_at`, `labels`, `adult`, `spoof`, `medical`, `violence`, `racy`) VALUES
(1, 1, 'adverts/1/5f8v7B3XZxcUehOn79zEsCfD33CrQ6o5TjQuNUK8.jpg', '2023-04-29 07:10:08', '2023-04-29 07:10:18', '[\"Plant\",\"Personal computer\",\"Computer\",\"Purple\",\"Tree\",\"Window\",\"Pink\",\"Television set\",\"Flat panel display\",\"Output device\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle');
INSERT INTO `images` (`id`, `advert_id`, `path`, `created_at`, `updated_at`, `labels`, `adult`, `spoof`, `medical`, `violence`, `racy`) VALUES
(2, 1, 'adverts/1/21y9gAH417b9Wdj7OttC6Grw2AN8HggfLPRCqAEj.jpg', '2023-04-29 07:10:08', '2023-04-29 07:10:18', '[\"Entertainment\",\"Gas\",\"Visual effect lighting\",\"Technology\",\"Display device\",\"Machine\",\"Magenta\",\"Games\",\"Event\",\"Electric blue\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle');
INSERT INTO `images` (`id`, `advert_id`, `path`, `created_at`, `updated_at`, `labels`, `adult`, `spoof`, `medical`, `violence`, `racy`) VALUES
(3, 1, 'adverts/1/4GuJXdMt2AIcDxCI7HFZ1zJKKS3Wa7wUu5tTa17j.jpg', '2023-04-29 07:10:08', '2023-04-29 07:10:20', '[\"Font\",\"Art\",\"Gadget\",\"Technology\",\"Bumper\",\"Electronic device\",\"Space\",\"Machine\",\"Magenta\",\"Auto part\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle');
INSERT INTO `images` (`id`, `advert_id`, `path`, `created_at`, `updated_at`, `labels`, `adult`, `spoof`, `medical`, `violence`, `racy`) VALUES
(4, 2, 'adverts/2/OGVaIGovxXa4SBzDifMKtIIYQ3qvQbFDejWf9CgE.jpg', '2023-04-29 07:25:05', '2023-04-29 07:25:11', '[\"Tire\",\"Wheel\",\"Vehicle\",\"Fuel tank\",\"Automotive lighting\",\"Motorcycle\",\"Automotive tire\",\"Motor vehicle\",\"Automotive exhaust\",\"Automotive design\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle'),
(5, 2, 'adverts/2/pWNAvMiNw9nVxlQOLqTR3VbtwtvWAEgaGqWnrswi.jpg', '2023-04-29 07:25:05', '2023-04-29 07:25:12', '[\"Wheel\",\"Tire\",\"Automotive lighting\",\"Automotive tire\",\"Vehicle\",\"Light\",\"Automotive design\",\"Motorcycle\",\"Purple\",\"Motor vehicle\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle'),
(6, 2, 'adverts/2/7fijL5HJxSUiss4CX8i5nxqFsWDhQnBagTYXIfBv.png', '2023-04-29 07:25:05', '2023-04-29 07:25:13', '[\"Tire\",\"Wheel\",\"Automotive lighting\",\"Vehicle\",\"Motorcycle\",\"Automotive tire\",\"Tread\",\"Automotive design\",\"Automotive tail & brake light\",\"Motor vehicle\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle'),
(7, 3, 'adverts/3/hB6UMfwDJAs2CSxkHpfxmODsaZVajswcIQzpxu9m.jpg', '2023-04-29 07:32:08', '2023-04-29 07:32:15', '[\"Automotive lighting\",\"Gadget\",\"Audio equipment\",\"Font\",\"Visual effect lighting\",\"Magenta\",\"Automotive fog light\",\"Output device\",\"Electronic device\",\"Electric blue\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle'),
(8, 3, 'adverts/3/jMI5ResnPze0alwCDtPvc7jEqq7UZ8ZiPmDw2F7X.jpg', '2023-04-29 07:32:08', '2023-04-29 07:32:16', '[\"Liquid\",\"Rectangle\",\"Material property\",\"Gadget\",\"Font\",\"Magenta\",\"Electric blue\",\"Technology\",\"Publication\",\"Packaging and labeling\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle'),
(9, 4, 'adverts/4/hvuYoHeW9sCBa40bk4F1XO8cAML3FSSCLbqljKOP.webp', '2023-04-29 08:08:19', '2023-04-29 08:08:25', '[\"Light\",\"Azure\",\"Automotive lighting\",\"Purple\",\"Wheel\",\"Visual effect lighting\",\"Entertainment\",\"Line\",\"Font\",\"Gas\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle'),
(10, 4, 'adverts/4/I6mcfmFfNbxZdC9WlC51frlOMiEuWqoFfQUAp6NT.jpg', '2023-04-29 08:08:19', '2023-04-29 08:08:25', '[\"Eye\",\"Human body\",\"Violet\",\"Font\",\"Magenta\",\"Tints and shades\",\"Electric blue\",\"Circle\",\"Logo\",\"Symbol\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle'),
(11, 4, 'adverts/4/EE29VxrQIr7kpaCimSGSrKiSJPljD35lY9niIBzd.jpg', '2023-04-29 08:08:19', '2023-04-29 08:08:26', '[\"Bird\",\"Gas\",\"Circle\",\"Electric blue\",\"Font\",\"Symbol\",\"Astronomical object\",\"Logo\",\"Measuring instrument\",\"Fashion accessory\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle'),
(12, 5, 'adverts/5/ycfJpTRMMIAi6j047tc9VpuLTH9fWtvBbGP0rukw.jpg', '2023-04-29 09:08:32', '2023-04-29 09:08:43', '[\"Car\",\"Vehicle\",\"Automotive lighting\",\"Hood\",\"Light\",\"Motor vehicle\",\"Automotive design\",\"Wheel\",\"Purple\",\"Automotive exterior\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle'),
(13, 5, 'adverts/5/dfTx1bRgCZOhAt5UL85hgXHE0Sc12U5Mq6lzgElZ.jpg', '2023-04-29 09:08:32', '2023-04-29 09:08:43', '[\"Car\",\"Land vehicle\",\"Automotive lighting\",\"Sky\",\"Hood\",\"Light\",\"Vehicle\",\"Purple\",\"Automotive design\",\"Automotive tail & brake light\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle'),
(14, 5, 'adverts/5/NboQkJoYCKOixk3jLPWoUstrXkXnfY5ehDbsparC.jpg', '2023-04-29 09:08:32', '2023-04-29 09:08:44', '[\"Tire\",\"Wheel\",\"Car\",\"Vehicle\",\"Automotive lighting\",\"Hood\",\"Automotive tire\",\"Automotive design\",\"Alloy wheel\",\"Bumper\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle'),
(15, 5, 'adverts/5/Z37cMp5Cq1y28oJBGXNmX52U21WRO9vXGxjd5i1S.jpg', '2023-04-29 09:08:32', '2023-04-29 09:08:44', '[\"Tire\",\"Wheel\",\"Vehicle\",\"Automotive tire\",\"Automotive lighting\",\"Purple\",\"Azure\",\"Motor vehicle\",\"Mode of transport\",\"Violet\"]', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle');



INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_03_29_164723_create_adverts_table', 1),
(7, '2023_03_29_191040_create_categories_table', 1),
(8, '2023_03_29_192856_add_category_id_to_adverts_table', 1),
(9, '2023_04_03_163532_add_role_column_to_users_table', 1),
(10, '2023_04_03_180617_add_is_accepted_to_adverts_table', 1),
(11, '2023_04_13_170433_add_google_id_column', 1),
(12, '2023_04_14_200858_add_provider_id_column_to_users_table', 1),
(13, '2023_04_17_165731_create_images_table', 1),
(14, '2023_04_17_184245_add_user_id_to_adverts_table', 1),
(15, '2023_04_19_185658_create_jobs_table', 1),
(16, '2023_04_20_180346_add_name_en_and_name_de_to_categories_table', 1),
(17, '2023_04_20_183338_add_bio_column_to_users_table', 1),
(18, '2023_04_21_174221_add_profilepic_column_to_users_table', 1),
(19, '2023_04_24_172827_add_google_vision_fields_to_images_table', 1),
(20, '2023_05_16_101249_add_typology_column_to_adverts_table', 2);





INSERT INTO `users` (`id`, `role`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `first_name`, `surname`, `date_of_birth`, `country`, `address`, `biography`, `profilepic`, `created_at`, `updated_at`, `google_id`, `provider_id`, `provider`) VALUES
(1, 5, 'Spiffo', 'spiffo@spiffo.com', '2023-04-29 06:57:46', '$2y$10$qCNLGncpwJ.ab6NgPk2cvuIpluiH/9XZADXLOyzBxB//1mx6zhkqm', NULL, NULL, NULL, NULL, 'Spiffo', 'The Raccoon', '2012-02-26', 'Canada, CA', 'Muldraugh, KY, USA.', 'Sono un procione che si diverte a fare tanti soldi.', 'uploads/profile_pictures/1683140487.png', '2023-04-29 06:56:52', '2023-05-03 19:01:27', NULL, NULL, NULL);
INSERT INTO `users` (`id`, `role`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `first_name`, `surname`, `date_of_birth`, `country`, `address`, `biography`, `profilepic`, `created_at`, `updated_at`, `google_id`, `provider_id`, `provider`) VALUES
(2, 0, 'Test', 'test@test.com', '2023-04-29 09:12:04', '$2y$10$olFsWdG.2gpLU9xu6y2NJO42JtuGA82cV0gDa4hVpowhuwBv8hOLa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-29 09:11:06', '2023-04-29 09:12:04', NULL, NULL, NULL);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;