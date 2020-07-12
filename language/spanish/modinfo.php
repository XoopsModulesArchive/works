<?php
// Module Info

// The name of this module
define("_MI_WORKS_NAME","Portafolio");

// A brief description of this module
define("_MI_WORKS_DESC", "Se crea un portafolio, donde la persona/empresa puede mostrar sus trabajos realizados.");

//options
define("_MI_WORKS_DATEFORMAT", "<strong>Formato de la fecha</strong>");
define("_MI_WORKS_DATEFORMAT_DESC", "Por favor consulte la <a href=\"http://mx.php.net/manual/es/function.date.php\" target=\"_blank\">documentaci&oacute;n PHP</a>, para obtener m&aacute;s información sobre como configurar el formato de fecha y hora.<br /> Nota: Si no define ning&uacute;n formato, se usar&aacute; el formato por defecto");
define("_MI_WORKS_NCHARITEM", "<strong>Caracteres en cada trabajo</strong>");
define("_MI_WORKS_NCHARITEM_DESC", "N&uacute;mero de caracteres mostrados en el contenido del resumen de la descripci&oacute;n de cada trabajo");
define("_MI_WORKS_NCHARCATEGORY", "<strong>Caracteres en categor&iacute;a</strong>");
define("_MI_WORKS_NCHARCATEGORY_DESC", "N&uacute;mero de caracteres mostrados en el contenido del resumen de la descripci&oacute;n de cada categor&iacute;a");
define("_MI_WORKS_IMAGEMAX", "<strong>Tama&ntilde;o de imagen de trabajo</strong>");
define("_MI_WORKS_IMAGEMAX_DESC", "Tama&ntilde;o m&aacute;ximo en bytes para las imagenes de los trabajos 1 KB = 1024 bytes");

//admin menu options
if (!defined("_MI_WORKS_ADMENU1")) {
	define("_MI_WORKS_ADMENU1", "Administrador de Trabajos");
}
if (!defined("_MI_WORKS_ADMENU2")) {
	define("_MI_WORKS_ADMENU2", "Administrador de Categor&iacute;as");
}
if (!defined("_MI_WORKS_ADMENU3")) {
	define("_MI_WORKS_ADMENU3", "Ajustes generales");
}
// added by Kris FrXoops
if (!defined("_MI_WORKS_ADMENU4")) {
	define("_MI_WORKS_ADMENU4", "Administraci&oacute;n de m&oacute;dulos");
}
?>