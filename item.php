<?php
// $Id: item.php WORKS module for XOOPS by Carlos Leopoldo Magaña Zavala
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
include_once("header.php");
include_once(XOOPS_ROOT_PATH."/header.php");


$xoopsOption['template_main'] = "works_item.html";

$result = $xoopsDB->query("SELECT iid, cid, title, description, dateb, datee, client, url, image, featured FROM ".$xoopsDB->prefix("works_items")." WHERE iid = ".$_GET['id']."");
$item = $xoopsDB->fetchArray($result);

if($item['iid'] != "") {
	$myts =& MyTextSanitizer::getInstance();

	$result2 = $xoopsDB->query("SELECT cid, title FROM ".$xoopsDB->prefix("works_categories")." WHERE cid = ".$item['cid']."");
	$category = $xoopsDB->fetchArray($result2);

	if($item['image'] != "") {
		$item['imagedisplay'] = "<img src=\"../../uploads/".$item['image']."\" alt=\"".$item['title']."\" title=\"".$item['title']."\" />";
	}
	
	if($item['url'] != "" && $item['url'] != "http://") {
		$url2 = str_replace(array("http://", "https://"), array("", ""), $item['url']);
		$item['website'] = "<img src=\"images/www.gif\" alt=\""._WORKS_VISITSITE."\" title=\""._WORKS_VISITSITE."\" /> <a href=\"".$item['url']."\" title=\"".$item['client']."\" target=\"_blank\">".$url2."</a><br />";
	}
	$xoopsTpl->assign("powered_by", "<div style=\"text-align:right; margin-top:5em;\">Powered by <a href=\"http://www.neoideas.com.mx\" target=\"_blank\" style=\"color:#333333;\">Neoideas</a> &amp; <a href=\"http://www.miguanajuato.com\" title=\"All about Guanajuato\" target=\"_blank\" style=\"color:#333333;\">Guanajuato</a></div>");
	
	$category['title'] = $myts->makeTboxData4Show($category['title']);
	$item['title'] = $myts->makeTboxData4Show($item['title']);
	$item['description'] = $myts->makeTareaData4Show($item['description']);
	$item['client'] = $myts->makeTboxData4Show($item['client']);
	if($item['dateb'] > 0) {
		$item['date_begin'] = "<img src=\"images/begin.gif\" alt=\""._WORKS_DBEGIN."\" title=\""._WORKS_DBEGIN."\" />".formatTimestamp($item['dateb'], $xoopsModuleConfig['dateformat'])." - ";
	}
	if($item['datee'] > 0) {
		$item['date_end'] = "<img src=\"images/end.gif\" alt=\""._WORKS_DEND."\" title=\""._WORKS_DEND."\" />".formatTimestamp($item['datee'], $xoopsModuleConfig['dateformat'])."<br />";
	}
	
	$xoopsTpl->assign("xoops_pagetitle", _WORKS_TITLE." - ".$item['title']);
	$xoopsTpl->assign("category", $category);
	$xoopsTpl->assign("item", $item);
	$xoopsTpl->assign("portfolio", _WORKS_TITLE);
	$xoopsTpl->assign("description_title", _WORKS_DESCRIPTION);
	$xoopsTpl->assign("client_title", _WORKS_CLIENT);
	$xoopsTpl->assign("details", _WORKS_DETAILS);

} else {
	redirect_header(XOOPS_URL."/modules/works/",3,_WORKS_ITEMNOEXIST);
}

include_once(XOOPS_ROOT_PATH."/footer.php");
?>
