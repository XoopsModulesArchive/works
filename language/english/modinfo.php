<?php
// Module Info

// The name of this module
define("_MI_WORKS_NAME","Portfolio");

// A brief description of this module
define("_MI_WORKS_DESC", "It create a portfolio to show your work to clients and visitors");

//options
define("_MI_WORKS_DATEFORMAT", "<strong>Date format</strong>");
define("_MI_WORKS_DATEFORMAT_DESC", "Please refer to the Php documentation (http://fr.php.net/manual/en/function.date.php) for more information on how to select the format. Note, if you don't type anything then the default date's format will be used");
define("_MI_WORKS_NCHARITEM", "<strong>Characters in works sumary</strong>");
define("_MI_WORKS_NCHARITEM_DESC", "Characters showed in works sumary");
define("_MI_WORKS_NCHARCATEGORY", "<strong>Characters in categories sumary</strong>");
define("_MI_WORKS_NCHARCATEGORY_DESC", "Characters showed in categories sumary");
define("_MI_WORKS_IMAGEMAX", "<strong>Image size</strong>");
define("_MI_WORKS_IMAGEMAX_DESC", "Max size for upload images in works 1 KB = 1024 bytes");

//admin menu options
if (!defined("_MI_WORKS_ADMENU1")) {
	define("_MI_WORKS_ADMENU1", "Works Manager");
}
if (!defined("_MI_WORKS_ADMENU2")) {
	define("_MI_WORKS_ADMENU2", "Categories Manager");
}
if (!defined("_MI_WORKS_ADMENU3")) {
	define("_MI_WORKS_ADMENU3", "General Settings");
}
// added by Kris FrXoops
if (!defined("_MI_WORKS_ADMENU4")) {
	define("_MI_WORKS_ADMENU4", "Blocks Manager");
}
?>