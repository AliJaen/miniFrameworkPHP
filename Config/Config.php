<?php

const base_url = 'http://localhost/miniFrameworkPHP';

/**
 * DB constants
 */
const DB_HOST = "localhost";
const DB_NAME = ""; // It's the default DB, but the constructor accept another DB to use
const DB_USER = "root"; // Use the correct USER
const DB_PASSWORD = "*********"; // Change the password according to your DB
const DB_CHARSET = "utf8";

/**
 * Siete Info
 */
define('SITE_CHARSET', 'UTF-8');
define('SITE_LANG', 'en');
define('SITE_NAME', 'MeowCode MiniFramework');
define('SITE_AUTHOR', 'MeowCode');
define('SITE_VERSION', '1.0.0');
define('SITE_LOGO', 'dark-logo.svg');
define('SITE_FAVICON', 'favicon.png');
define('SITE_DESC', 'Mini Framework PHP');
define('SITE_LOGO_MAIN', 'main.logo.png');

/**
 * Direc torios de la APP
 */
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('CONTROLLER', ROOT . DS . 'Controllers');
define('VIEW', ROOT . DS . 'Views');
define('TEMPLATES', VIEW . DS . 'Templates');
define('IMAGE_PATH', ROOT . DS . 'Assets' . DS . 'img' . DS . 'logos');

/**
 * Public Directories
 */
define('ASSETS', base_url.'/Assets');
define('CSS', ASSETS."/css");
define('SCSS', ASSETS."/scss");
define('JS', ASSETS."/js");
define('PLUGINS', ASSETS."/plugins");
define('LIBS', ASSETS."/libs");
define('FONTS', ASSETS."/font-fonts");
define('IMG', ASSETS."/img");
define('FAVICON', IMG."/logos/");
define('UPLOADS', ASSETS."/uploads");

/**
 * Controller, Method & Error Default
 */
define('CONTROLLER_DEFAULT', 'Login');
define('METHOD_DEFAULT', 'index');
define('CONTROLLER_ERROR', 'Error404');