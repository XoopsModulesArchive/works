<?php
// $Id: categories.php WORKS module for XOOPS by Carlos Leopoldo Magaña Zavala
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
include_once("../../../include/cp_header.php");
$myts =& MyTextSanitizer::getInstance();

function pageindex() {
	global $xoopsDB, $xoopsModuleConfig;

	include_once(XOOPS_ROOT_PATH."/include/xoopscodes.php");
	include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

	$outputfunc = "<h2>"._AM_WORKS_CATEGORIESLIST."</h2>";
	$outputfunc .= "<table cellspacing=\"1\" class=\"outer\"><tr>\n
    <th width=\"15%\">"._AM_WORKS_IDCATEGORY."</th>\n
    <th align=\"center\">"._AM_WORKS_WORKTITLE."</th>\n
    <th align=\"center\">"._AM_WORKS_ACTION."</th>\n</tr>";
	$result = $xoopsDB->query("SELECT cid, title FROM ".$xoopsDB->prefix("works_categories")." ORDER BY sort ASC");
	while($items = $xoopsDB->fetchArray($result)) {
		$outputfunc .= "<tr>\n
		<td align=\"center\" class=\"odd\">".$items['cid']."</td>\n
		<td class=\"odd\"><strong>".$items['title']."</strong></td>\n
		<td align=\"center\" class=\"odd\"><a href=\"categories.php?cid=".$items['cid']."&amp;action=edit\">"._AM_WORKS_EDIT."</a> - <a href=\"categories.php?cid=".$items['cid']."&amp;action=delete\">"._AM_WORKS_DELETE."</a></td>\n</tr>";	
	}
	$outputfunc .= "</table>";
	$outputfunc .= "<br /><hr /><h2>"._AM_WORKS_ADDACATEGORY."</h2>";

	echo $outputfunc;

	$sform = new XoopsThemeForm(_AM_WORKS_ADDACATEGORY, "add_cat", XOOPS_URL."/modules/works/admin/categories.php");
	$sform->addElement(new XoopsFormText(_AM_WORKS_WORKTITLE, 'title', 50, 250, ""), true);
    $sform->addElement(new XoopsFormDhtmlTextArea(_AM_WORKS_DESCRIPTION, "description", ""), true);
	$sform->addElement(new XoopsFormText(_AM_WORKS_ORDER, 'sort', 4, 11, 0));
	$sform->addElement(new XoopsFormButton('', 'post', _AM_WORKS_SAVE, 'submit'));
	$sform->addElement(new XoopsFormHidden("action", "add"));
	$sform->display();
}

function editcategory() {
	global $xoopsDB, $xoopsModuleConfig;

	include_once(XOOPS_ROOT_PATH."/include/xoopscodes.php");
	include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

	$result = $xoopsDB->query("SELECT cid, title, description, sort FROM ".$xoopsDB->prefix("works_categories")." WHERE cid = ".$_GET['cid']."");
	$item = $xoopsDB->fetchArray($result);

	echo "<h2>"._AM_WORKS_EDITCATTITLE."</h2>";

	$sform = new XoopsThemeForm(_AM_WORKS_EDITCATTITLE, "edit_cat", XOOPS_URL."/modules/works/admin/categories.php");
	$sform->addElement(new XoopsFormText(_AM_WORKS_WORKTITLE, 'title', 50, 250, $item['title']), true);
    $sform->addElement(new XoopsFormDhtmlTextArea(_AM_WORKS_DESCRIPTION, "description", $item['description']), true);
	$sform->addElement(new XoopsFormText(_AM_WORKS_ORDER, 'sort', 4, 11, $item['sort']));
	$sform->addElement(new XoopsFormButton('', 'post', _AM_WORKS_SAVE, 'submit'));
	$sform->addElement(new XoopsFormHidden("action", "editok"));
	$sform->addElement(new XoopsFormHidden("cid", $item['cid']));
	$sform->display();

}

function deletecategory() {
	global $xoopsDB;

	include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

	$result = $xoopsDB->query("SELECT cid, title FROM ".$xoopsDB->prefix("works_categories")." WHERE cid = ".$_GET['cid']."");
	$item = $xoopsDB->fetchArray($result);

	echo "<form action=\"categories.php\" name=\"delete\" method=\"post\">";
	echo "<table class=\"outer\"><tr><th align=\"center\">";
	echo "<h2>"._AM_WORKS_DELETECATEGORY."</h2>";
	echo "</th></tr>";
	echo "<tr><td class=\"odd\">"._AM_WORKS_DELETECATTEXT."<br />";
	echo "<strong>".$item['title']."</strong></td></tr>";
	echo "<tr><td class=\"odd\" align=\"center\">";
	echo "<input type=\"hidden\" name=\"cid\" value=\"".$item['cid']."\">";
	echo "<input type=\"hidden\" name=\"action\" value=\"deleteok\">";
	echo "<input type=\"submit\" class=\"formButton\" value=\""._AM_WORKS_DELETE."\" /> &nbsp; ";
	echo "<input type=\"button\" class=\"formButton\" value=\""._AM_WORKS_CANCEL."\" onClick=\"window.open('categories.php', '_self'); return false;\" />";
	echo "</td></tr></table>";
	echo "</form>";

}

function addcategory() {
	global $myts, $xoopsDB;

	$title = $myts->makeTboxData4Save($_POST['title']);
	$description = $myts->makeTareaData4Save($_POST['description']);
	$sort = intval($_POST['sort']);

	$sql = sprintf("INSERT INTO %s (cid, title, description, sort) VALUES ('', '%s', '%s', %u)", $xoopsDB->prefix("works_categories"), $title, $description, $sort);
	$xoopsDB->query($sql);
	
	redirect_header("categories.php",1,_AM_WORKS_ADDCATOK);
	exit();
 
}

function editok() {
	global $myts, $xoopsDB;
	$title = $myts->makeTboxData4Save($_POST['title']);
	$description = $myts->makeTareaData4Save($_POST['description']);
	$sort = intval($_POST['sort']);

    $xoopsDB->query("UPDATE ".$xoopsDB->prefix("works_categories")." SET title='".$title."', description='".$description."', sort=".$sort." WHERE cid=".$_POST['cid']."");

	redirect_header("categories.php",1,_AM_WORKS_EDITCATOK);
	exit();
}

function deleteok() {
	global $xoopsDB;
	$xoopsDB->query("DELETE FROM ".$xoopsDB->prefix("works_categories")." WHERE cid=".$_POST['cid']."");
	
	redirect_header("categories.php",1,_AM_WORKS_DELETECATOK);
	exit();
}

// actions
if(isset($_POST['action']) && $_POST['action'] == "add") {
	addcategory();

} elseif(isset($_POST['action']) && $_POST['action'] == "editok") {
	editok();

} elseif(isset($_POST['action']) && $_POST['action'] == "deleteok") {
	deleteok();

} elseif(isset($_GET['action']) && $_GET['action'] == "edit") {
	include_once("header_admin.php");
	xoops_cp_header();
	adminnav();
	editcategory();
	xoops_cp_footer();

} elseif(isset($_GET['action']) && $_GET['action'] == "delete") {
	include_once("header_admin.php");
	xoops_cp_header();
	adminnav();
	deletecategory();
	xoops_cp_footer();

} else {
	include_once("header_admin.php");
	xoops_cp_header();
	adminnav();
	pageindex();
	xoops_cp_footer();
	
}
?>