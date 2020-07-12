<?php
// $Id: index.php WORKS module for XOOPS by Carlos Leopoldo Magaña Zavala
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
include_once(XOOPS_ROOT_PATH."/modules/works/include/functions.php");
$myts =& MyTextSanitizer::getInstance();

if(isset($_GET['cid'])) {
	$xoopsOption['template_main'] = "works_category.html";

	$result = $xoopsDB->query("SELECT cid, title, description FROM ".$xoopsDB->prefix("works_categories")." WHERE cid = ".$_GET['cid']."");
	$category = $xoopsDB->fetchArray($result);
	$category['title'] = $myts->makeTboxData4Show($category['title']);
	$category['description'] = $myts->makeTareaData4Show($category['description']);
	
	if($category['cid'] != "") {
		$result2 = $xoopsDB->query("SELECT iid, title, description, client, image FROM ".$xoopsDB->prefix("works_items")." WHERE cid = ".$category['cid']." ORDER BY iid DESC");
		$i=0;
		while($item = $xoopsDB->fetchArray($result2)) {
			$items[$i]['id'] = $item['iid'];
			$items[$i]['title'] = "<a href=\"item.php?id=".$item['iid']."\" title=\"".$myts->makeTboxData4Show($item['title'])."\">".$myts->makeTboxData4Show($item['title'])."</a>";
			$items[$i]['description'] = CutString(strip_tags($myts->makeTareaData4Show($item['description'])), $xoopsModuleConfig['ncharitem']);
			$items[$i]['client'] = $myts->makeTboxData4Show($item['client']);
			$i++;
		}
	
		$category['title'] = $myts->makeTboxData4Show($category['title']);
	
		$xoopsTpl->assign("xoops_pagetitle", _WORKS_TITLE." - ".$category['title']);
		$xoopsTpl->assign("portfolio", _WORKS_TITLE);
		$xoopsTpl->assign("category", $category);
		$xoopsTpl->assign("items", $items);
		$xoopsTpl->assign("latestjobs", _WORKS_LATESTJOBSIN." ".$category['title']);
		$xoopsTpl->assign("client_title", _WORKS_CLIENTE);
		$xoopsTpl->assign("powered_by", "<div style=\"text-align:right; margin-top:5em;\">Powered by <a href=\"http://www.neoideas.com.mx\" target=\"_blank\" style=\"color:#333333;\">Neoideas</a> &amp; <a href=\"http://www.miguanajuato.com\" title=\"All about Guanajuato\" target=\"_blank\" style=\"color:#333333;\">Guanajuato</a></div>");
	} else {
		redirect_header(XOOPS_URL."/modules/works/",3,_WORKS_CATEGORYNOEXIST);
	}
	
} else {
	$xoopsOption['template_main'] = "works_index.html";

	$result = $xoopsDB->query("SELECT iid, title, description, client FROM ".$xoopsDB->prefix("works_items")." ORDER BY iid DESC LIMIT 10");
	$i=0;
	while($item = $xoopsDB->fetchArray($result)) {
		$items[$i]['id'] = $item['iid'];
		$items[$i]['title'] = "<a href=\"item.php?id=".$item['iid']."\" title=\"".$myts->makeTboxData4Show($item['title'])."\">".$myts->makeTboxData4Show($item['title'])."</a>";
		$items[$i]['description'] = CutString(strip_tags($myts->makeTareaData4Show($item['description'])), $xoopsModuleConfig['ncharitem']);
		$items[$i]['client'] = $myts->makeTboxData4Show($item['client']);
		$i++;
	}

	$result2 = $xoopsDB->query("SELECT cid, title, description FROM ".$xoopsDB->prefix("works_categories")." ORDER BY sort ASC");
	$i=0;
	while($category = $xoopsDB->fetchArray($result2)) {
		$categories[$i]['id'] = $category['cid'];
		$categories[$i]['description'] = CutString(strip_tags($myts->makeTareaData4Show($category['description'])), $xoopsModuleConfig['ncharcategory']);
		$categories[$i]['title'] = "<a href=\"index.php?cid=".$category['cid']."\" title=\"".$myts->makeTboxData4Show($category['title'])."\">".$myts->makeTboxData4Show($category['title'])."</a>";
		$i++;
	}

	$result3 = $xoopsDB->query("SELECT iid, title FROM ".$xoopsDB->prefix("works_items")." WHERE featured = 1 ORDER BY iid DESC LIMIT 10");
	$i=0;
	while($feature = $xoopsDB->fetchArray($result3)) {
		$featured[$i]['id'] = $feature['iid'];
		$featured[$i]['title'] = "<a href=\"item.php?id=".$feature['iid']."\" title=\"".$myts->makeTboxData4Show($feature['title'])."\">".$myts->makeTboxData4Show($feature['title'])."</a>";
		$i++;
	}
	$xoopsTpl->assign("xoops_pagetitle", _WORKS_TITLE);
	$xoopsTpl->assign("powered_by", "<div style=\"text-align:right; margin-top:5em;\">Powered by <a href=\"http://www.neoideas.com.mx\" target=\"_blank\" style=\"color:#333333;\">Neoideas</a> &amp; <a href=\"http://www.miguanajuato.com\" title=\"All about Guanajuato\" target=\"_blank\" style=\"color:#333333;\">Guanajuato</a></div>");
	$xoopsTpl->assign("items", $items);
	$xoopsTpl->assign("latestjobs", _WORKS_LATESTJOBS);
	$xoopsTpl->assign("featured", $featured);
	$xoopsTpl->assign("categories_title", _WORKS_CATEGORIES);
	$xoopsTpl->assign("categories", $categories);
	$xoopsTpl->assign("featuredtitle", _WORKS_FEATUREDTITLE);
	$xoopsTpl->assign("client_title", _WORKS_CLIENTE);
	
}
$xoopsTpl->assign("powered_by", "<div style=\"text-align:right; margin-top:5em;\">Powered by <a href=\"http://www.neoideas.com.mx\" target=\"_blank\" style=\"color:#333333;\">Neoideas</a> &amp; <a href=\"http://www.miguanajuato.com\" title=\"All about Guanajuato\" target=\"_blank\" style=\"color:#333333;\">Guanajuato</a></div>");

include_once(XOOPS_ROOT_PATH."/footer.php");
?>
