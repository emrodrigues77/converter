/**
    Script para criação do banco de dados, usuário MySQL e tabelas
*/

CREATE DATABASE money_converter CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE USER 'money_converter_user' @'localhost' IDENTIFIED BY 'M0n3YC0nv3rt3r!';

GRANT ALL ON money_converter.* TO 'money_converter_user'@'localhost';

DROP TABLE IF EXISTS `conversion_taxes`;

CREATE TABLE `conversion_taxes` (
	`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`valorMaximo` DECIMAL(10, 2) UNSIGNED NOT NULL,
	`taxa` DECIMAL(7, 3) UNSIGNED NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	`deleted_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

/*Data for the table `conversion_taxes` */

INSERT INTO
	`conversion_taxes`(
		`id`,
		`valorMaximo`,
		`taxa`,
		`created_at`,
		`updated_at`,
		`deleted_at`
	)
VALUES
	(
		1,
		3000.00,
		2.000,
		'2022-05-10 12:04:37',
		'2022-05-10 12:04:40',
		NULL
	);

INSERT INTO
	`conversion_taxes`(
		`id`,
		`valorMaximo`,
		`taxa`,
		`created_at`,
		`updated_at`,
		`deleted_at`
	)
VALUES
	(2, 100000.00, 1.000, NULL, NULL, NULL);

/*Table structure for table `conversions` */

DROP TABLE IF EXISTS `conversions`;

CREATE TABLE `conversions` (
	`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` BIGINT UNSIGNED NOT NULL,
	`payment_type_id` BIGINT UNSIGNED NOT NULL,
	`moedaOrigem` CHAR(3) COLLATE utf8mb4_unicode_ci NOT NULL,
	`moedaDestino` CHAR(3) COLLATE utf8mb4_unicode_ci NOT NULL,
	`valorConversao` DECIMAL(10, 2) UNSIGNED NOT NULL,
	`valorMoedaDestino` DECIMAL(10, 4) UNSIGNED NOT NULL,
	`valorCompradoMoedaDestino` DECIMAL(10, 2) UNSIGNED NOT NULL,
	`taxaPagamento` DECIMAL(10, 2) UNSIGNED NOT NULL,
	`taxaConversao` DECIMAL(10, 2) UNSIGNED NOT NULL,
	`valorConvertido` DECIMAL(10, 2) UNSIGNED NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	`deleted_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	KEY `conversions_user_id_foreign` (`user_id`),
	KEY `conversions_payment_type_id_foreign` (`payment_type_id`),
	CONSTRAINT `conversions_payment_type_foreign` FOREIGN KEY (`payment_type`) REFERENCES `payment_types` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `conversions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = INNODB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

/*Table structure for table `currencies` */

DROP TABLE IF EXISTS `currencies`;

CREATE TABLE `currencies` (
	`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`codigo` CHAR(3) COLLATE utf8mb4_unicode_ci NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	`deleted_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `currencies_nome_unique` (`nome`),
	UNIQUE KEY `currencies_codigo_unique` (`codigo`)
) ENGINE = INNODB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

/*Data for the table `currencies` */

INSERT INTO
	`currencies`(
		`id`,
		`nome`,
		`codigo`,
		`created_at`,
		`updated_at`,
		`deleted_at`
	)
VALUES
	(
		1,
		'Real Brasileiro',
		'BRL',
		'2022-05-10 12:04:54',
		'2022-05-10 12:05:07',
		NULL
	);

INSERT INTO
	`currencies`(
		`id`,
		`nome`,
		`codigo`,
		`created_at`,
		`updated_at`,
		`deleted_at`
	)
VALUES
	(
		2,
		'Dólar Americano',
		'USD',
		'2022-05-10 12:04:57',
		'2022-05-10 12:05:10',
		NULL
	);

INSERT INTO
	`currencies`(
		`id`,
		`nome`,
		`codigo`,
		`created_at`,
		`updated_at`,
		`deleted_at`
	)
VALUES
	(
		3,
		'Euro',
		'EUR',
		'2022-05-10 12:05:00',
		'2022-05-10 12:05:13',
		NULL
	);

INSERT INTO
	`currencies`(
		`id`,
		`nome`,
		`codigo`,
		`created_at`,
		`updated_at`,
		`deleted_at`
	)
VALUES
	(
		4,
		'Libra Esterlino',
		'GBP',
		'2022-05-10 12:05:04',
		NULL,
		NULL
	);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
	`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`uuid` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`connection` TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
	`queue` TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
	`payload` LONGTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
	`exception` LONGTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
	`failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`deleted_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE = INNODB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`migration` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`batch` INT NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

/*Data for the table `migrations` */

INSERT INTO
	`migrations`(`id`, `migration`, `batch`)
VALUES
	(1, '00_create_users_table', 1);

INSERT INTO
	`migrations`(`id`, `migration`, `batch`)
VALUES
	(2, '01_create_payment_types_table', 1);

INSERT INTO
	`migrations`(`id`, `migration`, `batch`)
VALUES
	(3, '02_create_conversions_table', 1);

INSERT INTO
	`migrations`(`id`, `migration`, `batch`)
VALUES
	(4, '03_create_password_resets_table', 1);

INSERT INTO
	`migrations`(`id`, `migration`, `batch`)
VALUES
	(5, '04_create_failed_jobs_table', 1);

INSERT INTO
	`migrations`(`id`, `migration`, `batch`)
VALUES
	(6, '05_create_personal_access_tokens_table', 1);

INSERT INTO
	`migrations`(`id`, `migration`, `batch`)
VALUES
	(7, '06_create_parameters_table', 1);

INSERT INTO
	`migrations`(`id`, `migration`, `batch`)
VALUES
	(8, '07_create_conversion_taxes_table', 1);

INSERT INTO
	`migrations`(`id`, `migration`, `batch`)
VALUES
	(9, '08_create_currencies_table', 1);

/*Table structure for table `parameters` */

DROP TABLE IF EXISTS `parameters`;

CREATE TABLE `parameters` (
	`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`moedaPadrao` CHAR(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BRL',
	`valorMinimo` DECIMAL(10, 2) UNSIGNED NOT NULL,
	`valorMaximo` DECIMAL(10, 2) UNSIGNED NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	`deleted_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

/*Data for the table `parameters` */

INSERT INTO
	`parameters`(
		`id`,
		`moedaPadrao`,
		`valorMinimo`,
		`valorMaximo`,
		`created_at`,
		`updated_at`,
		`deleted_at`
	)
VALUES
	(
		1,
		'BRL',
		1000.00,
		1000000.00,
		'2022-05-10 12:05:24',
		'2022-05-10 12:05:27',
		NULL
	);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
	`email` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`token` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	KEY `password_resets_email_index` (`email`)
) ENGINE = INNODB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

/*Table structure for table `payment_types` */

DROP TABLE IF EXISTS `payment_types`;

CREATE TABLE `payment_types` (
	`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`taxa` DECIMAL(6, 3) UNSIGNED NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	`deleted_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

/*Data for the table `payment_types` */

INSERT INTO
	`payment_types`(
		`id`,
		`nome`,
		`taxa`,
		`created_at`,
		`updated_at`,
		`deleted_at`
	)
VALUES
	(
		1,
		'Boleto',
		1.450,
		'2022-05-10 12:05:35',
		'2022-05-10 12:05:37',
		NULL
	);

INSERT INTO
	`payment_types`(
		`id`,
		`nome`,
		`taxa`,
		`created_at`,
		`updated_at`,
		`deleted_at`
	)
VALUES
	(2, 'Cartão de Crédito', 7.630, NULL, NULL, NULL);

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
	`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`tokenable_type` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`tokenable_id` BIGINT UNSIGNED NOT NULL,
	`name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`token` VARCHAR(64) COLLATE utf8mb4_unicode_ci NOT NULL,
	`abilities` TEXT COLLATE utf8mb4_unicode_ci,
	`last_used_at` TIMESTAMP NULL DEFAULT NULL,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	`deleted_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
	KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`, `tokenable_id`)
) ENGINE = INNODB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
	`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`email` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`email_verified_at` TIMESTAMP NULL DEFAULT NULL,
	`password` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`admin` TINYINT UNSIGNED NOT NULL DEFAULT '0',
	`remember_token` VARCHAR(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	`deleted_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `users_email_unique` (`email`)
) ENGINE = INNODB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

/*Data for the table `users` */

INSERT INTO
	`users`(
		`id`,
		`name`,
		`email`,
		`email_verified_at`,
		`password`,
		`admin`,
		`remember_token`,
		`created_at`,
		`updated_at`,
		`deleted_at`
	)
VALUES
	(
		1,
		'Eduardo Rodrigues',
		'eduardo@eduardo.rodrigues.nom.br',
		NULL,
		'$2y$10$zyb2AAEbnH4SZc3XYcg0dOCaPw6EiHk5k5O.YDB0n97K2rByglGGy',
		1,
		NULL,
		'2022-05-10 12:00:44',
		'2022-05-10 12:00:44',
		NULL
	);

INSERT INTO
	`users`(
		`id`,
		`name`,
		`email`,
		`email_verified_at`,
		`password`,
		`admin`,
		`remember_token`,
		`created_at`,
		`updated_at`,
		`deleted_at`
	)
VALUES
	(
		2,
		'Ricardo Rodrigues',
		'ricardo@gmail.com',
		NULL,
		'$2y$10$xA2RePs/.beJJxo59Ez.z.Cqg7qSkcFXQl/afQrVPBr7njuKemvWq',
		0,
		NULL,
		'2022-05-10 12:06:08',
		'2022-05-10 12:06:08',
		NULL
	);
