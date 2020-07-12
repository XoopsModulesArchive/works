<?php
// $Id: header_admin.php WORKS module for XOOPS by Carlos Leopoldo Magaña Zavala
// http://www.neoideas.com.mx		http://www.miguanajuato.com
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //

function adminnav() {
	global $xoopsConfig, $xoopsModule;

	// language files
	if(!file_exists(XOOPS_ROOT_PATH."/modules/system/language/".$xoopsConfig['language']."/admin/blocksadmin.php")) {
		include_once(XOOPS_ROOT_PATH.'/modules/system/language/english/admin.php');
		include_once(XOOPS_ROOT_PATH.'/modules/system/language/english/admin/blocksadmin.php');	
	} else {
		include_once(XOOPS_ROOT_PATH.'/modules/system/language/'.$xoopsConfig['language'].'/admin.php');
		include_once(XOOPS_ROOT_PATH.'/modules/system/language/'.$xoopsConfig['language'].'/admin/blocksadmin.php');
	}

	echo "<h1>"._AM_WORKS_TITLEADMIN."</h1><br />\n" ;
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"outer\"><td width=\"25%\" align=\"center\" class=\"even\">";
	echo "<a href=\"index.php\">"._MI_WORKS_ADMENU1."</a>";
	echo "</td><td width=\"25%\" align=\"center\" class='even'>";
	echo "<a href=\"categories.php\">"._MI_WORKS_ADMENU2."</a>";
	echo "</td><td width=\"25%\" align=\"center\" class='even'>";
	echo "<a href=\"".XOOPS_URL."/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule->getVar('mid')."&amp;confcat_id=0\">"._MI_WORKS_ADMENU3."</a>";
	echo "</td><td width=\"25%\" align=\"center\" class='even'>";
	echo "<a href=\"myblocksadmin.php\">"._AM_BADMIN."</a>";
	CloseTable();
	echo "<br />";
}

?>