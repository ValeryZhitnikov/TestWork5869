<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'testwork' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'iH>!c4]vDj>xm2c3`Q8r<:AGonh+s6IJR+)cB/sA<k[@z;sA*d<QdMo:KFu}Y>r%' );
define( 'SECURE_AUTH_KEY',  '/$VgcD7d4M;[LuKqVsk9rBQE],R[Uu,jVPhc0|<r^;Mm @~8Y]+Pzqe(m5WNTuZ$' );
define( 'LOGGED_IN_KEY',    'Rz<r+5#go8L<f/:s.zXWY?Z<)lT-N`K6]u/kLjINQ`AoX>`pzImKC+cMc:3lNsKz' );
define( 'NONCE_KEY',        '}ue~CVvWf=3&?!V~WTGr7(~g#g{A{-N?I,k.?OA6-.RT2 q4)X3*S44}NrR.Zc_/' );
define( 'AUTH_SALT',        '$,o*?!R}b_)l#D]CKvY--xh1wfj]-Q0`na`nis+HfN%E1+cFF),F6Npd+m{W#H}.' );
define( 'SECURE_AUTH_SALT', 'DgIJ*@k|8=`b^_c9V +z0i;:Q=W<>=>:kH_z4k.m(3P, qJ@G4[%zs [iAR<l20|' );
define( 'LOGGED_IN_SALT',   'nv*BJO-[vsZfe~93w~15#/ntk(IR,V>hQWjWj(=S8*0-Egqw0{WTNQ7mP1|(DPoa' );
define( 'NONCE_SALT',       'B~]eRPnx.x*:-BLYb?t*IJ-+.S7^~>P$16KLKnYR60*Qgx|2f>ZzGk4xAzf39.Ov' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
