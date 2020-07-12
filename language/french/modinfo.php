<?php
// Module Info

// The name of this module
define("_MI_WORKS_NAME","Portfolio");

// A brief description of this module
define("_MI_WORKS_DESC", "Cr&eacute;ation d'un portfolio permettant de pr&eacute;senter ses projets aux clients et aux visiteurs");

//options
define("_MI_WORKS_DATEFORMAT", "<strong>Format de la date</strong>");
define("_MI_WORKS_DATEFORMAT_DESC", "Merci de vous r&eacute;f&eacute;rer à la documentation Php (http://fr.php.net/manual/en/function.date.php) pour plus d'informations sur les formats d'affichage des dates. Si vous ne saisissez rien, le format de date par d&eacute;faut sera employ&eacute;");
define("_MI_WORKS_NCHARITEM", "<strong>Nombre de caract&egrave;res dans le sommaire des projets</strong>");
define("_MI_WORKS_NCHARITEM_DESC", "Nombre de caract&egrave;res visibles dans le sommaire des projets");
define("_MI_WORKS_NCHARCATEGORY", "<strong>Nombre de caract&egrave;res dans le sommaire des cat&eacute;gories</strong>");
define("_MI_WORKS_NCHARCATEGORY_DESC", "Nombre de caract&egrave;res visibles dans le sommaire des cat&eacute;gories");
define("_MI_WORKS_IMAGEMAX", "<strong>Taille de l'image</strong>");
define("_MI_WORKS_IMAGEMAX_DESC", "Taille maximale de l'image t&eacute;l&eacute;charg&eacute;e pour le projet est de 1 KB = 1024 bytes");

//admin menu options
if (!defined("_MI_WORKS_ADMENU1")) {
	define("_MI_WORKS_ADMENU1", "Gestion des projets");
}
if (!defined("_MI_WORKS_ADMENU2")) {
	define("_MI_WORKS_ADMENU2", "Gestion des cat&eacute;gories");
}
if (!defined("_MI_WORKS_ADMENU3")) {
	define("_MI_WORKS_ADMENU3", "Pr&eacute;f&eacute;rences g&eacute;n&eacute;rales");
}
// added by Kris FrXoops
if (!defined("_MI_WORKS_ADMENU4")) {
	define("_MI_WORKS_ADMENU4", "Gestion des blocs");
}
?>