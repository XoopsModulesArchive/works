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
include_once("../../../include/cp_header.php");
$myts =& MyTextSanitizer::getInstance();

function pageindex() {
	global $xoopsDB, $xoopsModuleConfig;

	include_once(XOOPS_ROOT_PATH."/include/xoopscodes.php");
	include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

	$outputfunc = "<h2>"._AM_WORKS_LATESTWORKS."</h2>";
	$outputfunc .= "<table cellspacing=\"1\" class=\"outer\"><tr>\n
    <th width=\"15%\">"._AM_WORKS_IDWORK."</th>\n
    <th>"._AM_WORKS_WORKTITLE."</th>\n
    <th>"._AM_WORKS_CATEGORY."</th>\n
    <th>"._AM_WORKS_ACTION."</th>\n</tr>";
	$result = $xoopsDB->query("SELECT iid, cid, title, featured FROM ".$xoopsDB->prefix("works_items")." ORDER BY iid DESC LIMIT 20");
	while($items = $xoopsDB->fetchArray($result)) {
		list($cid, $category) = $xoopsDB->fetchRow($xoopsDB->query("SELECT cid, title FROM ".$xoopsDB->prefix("works_categories")." WHERE cid = ".$items['cid'].""));
		$outputfunc .= "<tr>\n
		<td align=\"center\" class=\"odd\">".$items['iid']."</td>\n
		<td class=\"odd\"><strong>".$items['title']."</strong></td>\n
		<td class=\"odd\">".$category."</td>\n
		<td align=\"center\" class=\"odd\"><a href=\"index.php?iid=".$items['iid']."&amp;action=edit\">"._AM_WORKS_EDIT."</a> - <a href=\"index.php?iid=".$items['iid']."&amp;action=delete\">"._AM_WORKS_DELETE."</a></td>\n</tr>";	
	}
	$outputfunc .= "</table><br /><hr /><h2>"._AM_WORKS_EDITAWORK."</h2>";
	$outputfunc .= "<div align=\"center\" class=\"outer odd\"><form action=\"index.php\" method=\"get\">"._AM_WORKS_IDWORK.": <input type=\"text\" name=\"iid\" size=\"10\" /> <select name=\"action\">\n<option value=\"edit\" selected=\"selected\">"._AM_WORKS_EDIT."</option>\n<option value=\"delete\">"._AM_WORKS_DELETE."</option>\n</select>\n
    	<input type=\"submit\" value=\""._AM_WORKS_CONTINUE."\"  class=\"formButton\" />
    	</form></div>\n";
	$outputfunc .= "<br /><hr /><h2>"._AM_WORKS_ADDAWORK."</h2>";

	echo $outputfunc;

	$sform = new XoopsThemeForm(_AM_WORKS_ADDAWORK, "add_work", XOOPS_URL."/modules/works/admin/index.php");
	$sform->setExtra("enctype=\"multipart/form-data\"");
	$sform->addElement(new XoopsFormText(_AM_WORKS_WORKTITLE, 'title', 50, 250, ""), true);
	$result = $xoopsDB->query("SELECT cid, title FROM ".$xoopsDB->prefix("works_categories")." ORDER BY sort ASC");
	$cat_list = new XoopsFormSelect(_AM_WORKS_CATEGORY, 'cid');
	while(list($cid, $cat_title) = $xoopsDB->fetchRow($result)) {
		$cat_list->addOption($cid, $cat_title);
		$show_form = true;
	}
	$sform->addElement($cat_list, true);
	$sform->addElement(new XoopsFormText(_AM_WORKS_CLIENT, 'client', 50, 250, ""), true);
	$sform->addElement(new XoopsFormDhtmlTextArea(_AM_WORKS_DESCRIPTION, "description", ""), true);
	$sform->addElement(new XoopsFormTextDateSelect(_AM_WORKS_DATEB, "dateb"));
	$sform->addElement(new XoopsFormTextDateSelect(_AM_WORKS_DATEE, "datee"));
	$sform->addElement(new XoopsFormFile(_AM_WORKS_IMAGE, 'image', $xoopsModuleConfig['imagemax']));
	$sform->addElement(new XoopsFormText(_AM_WORKS_URL, 'url', 50, 250, "http://"));
	$sform->addElement(new XoopsFormRadioYN(_AM_WORKS_FEATURED, "featured", 0));
	$sform->addElement(new XoopsFormButton('', 'post', _AM_WORKS_SAVE, 'submit'));
	$sform->addElement(new XoopsFormHidden("action", "add"));
	if($show_form) {
		$sform->display();
	} else {
		echo "<a href=\"categories.php\">"._AM_WORKS_ADDACATEGORY."</a>";
	}
}

function editwork() {
	global $xoopsDB, $xoopsModuleConfig;

	include_once(XOOPS_ROOT_PATH."/include/xoopscodes.php");
	include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

	$result = $xoopsDB->query("SELECT iid, cid, title, description, dateb, datee, client, url, image, featured FROM ".$xoopsDB->prefix("works_items")." WHERE iid = ".$_GET['iid']."");
	$item = $xoopsDB->fetchArray($result);

	echo "<h2>"._AM_WORKS_EDITTITLE."</h2>";

	$sform = new XoopsThemeForm(_AM_WORKS_ADDAWORK, "edit_work", XOOPS_URL."/modules/works/admin/index.php");
	$sform->setExtra("enctype=\"multipart/form-data\"");
	$sform->addElement(new XoopsFormText(_AM_WORKS_WORKTITLE, 'title', 50, 250, $item['title']), true);
    $cat_list = new XoopsFormSelect(_AM_WORKS_CATEGORY, 'cid', $item['cid']);
	$result = $xoopsDB->query("SELECT cid, title FROM ".$xoopsDB->prefix("works_categories")." ORDER BY sort ASC");
	while(list($cid, $cat_title) = $xoopsDB->fetchRow($result)) {
		$cat_list->addOption($cid, $cat_title);
	}
    $sform->addElement($cat_list, true);
	$sform->addElement(new XoopsFormText(_AM_WORKS_CLIENT, 'client', 50, 250, $item['client']), true);
    $sform->addElement(new XoopsFormDhtmlTextArea(_AM_WORKS_DESCRIPTION, "description", $item['description']), true);
    $sform->addElement(new XoopsFormTextDateSelect(_AM_WORKS_DATEB, "dateb", 15, $item['dateb']));
    $sform->addElement(new XoopsFormTextDateSelect(_AM_WORKS_DATEE, "datee", 15, $item['datee']));
    if($item['image'] != "") {
		$current_image = sprintf(_AM_WORKS_CURRENTIMAGE, "<a href=\"../../../uploads/".$item['image']."\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=500,height=400'); return false;\">".$item['image']."</a>");
		$sform->addElement(new XoopsFormRadioYN($current_image, "deleteimage", 0));
		$sform->addElement(new XoopsFormFile(_AM_WORKS_REPLACEIMAGE, 'image', $xoopsModuleConfig['imagemax']));
	} else {
		$sform->addElement(new XoopsFormFile(_AM_WORKS_IMAGE, 'image', $xoopsModuleConfig['imagemax']));
		$sform->addElement(new XoopsFormHidden("deleteimage", 0));
	}
	$sform->addElement(new XoopsFormText(_AM_WORKS_URL, 'url', 50, 250, $item['url']));
    $sform->addElement(new XoopsFormRadioYN(_AM_WORKS_FEATURED, "featured", $item['featured']));
	$sform->addElement(new XoopsFormButton('', 'post', _AM_WORKS_SAVE, 'submit'));
	$sform->addElement(new XoopsFormHidden("action", "editok"));
	$sform->addElement(new XoopsFormHidden("iid", $item['iid']));
	$sform->addElement(new XoopsFormHidden("imagename", $item['image']));
	$sform->display();

}

function deletework() {
	global $xoopsDB;

	include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

	$result = $xoopsDB->query("SELECT iid, title, image FROM ".$xoopsDB->prefix("works_items")." WHERE iid = ".$_GET['iid']."");
	$item = $xoopsDB->fetchArray($result);

	echo "<form action=\"index.php\" name=\"delete\" method=\"post\">";
	echo "<table class=\"outer\"><tr><th align=\"center\">";
	echo "<h2>"._AM_WORKS_DELETEWORK."</h2>";
	echo "</th></tr>";
	echo "<tr><td class=\"odd\">"._AM_WORKS_DELETEWORKTEXT."<br />";
	echo "<strong>".$item['title']."</strong></td></tr>";
	echo "<tr><td class=\"odd\" align=\"center\">";
	echo "<input type=\"hidden\" name=\"iid\" value=\"".$item['iid']."\">";
	echo "<input type=\"hidden\" name=\"action\" value=\"deleteok\">";
	echo "<input type=\"hidden\" name=\"image\" value=\"".$item['image']."\">";
	echo "<input type=\"submit\" class=\"formButton\" value=\""._AM_WORKS_DELETE."\" /> &nbsp; ";
	echo "<input type=\"button\" class=\"formButton\" value=\""._AM_WORKS_CANCEL."\" onClick=\"window.open('index.php', '_self'); return false;\" />";
	echo "</td></tr></table>";
	echo "</form>";

}

function addwork() {
	global $xoopsModuleConfig, $myts, $xoopsDB, $xoopsUser;
	if (!empty($_FILES['image']['name']) ) {
		include_once(XOOPS_ROOT_PATH."/class/uploader.php");
		$upload = new XoopsMediaUploader(XOOPS_ROOT_PATH."/uploads/", array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/jpg', 'image/pjpg', 'image/x-png', 'image/png'), $xoopsModuleConfig['imagemax']);
	
		$filename1 = explode(".", $_FILES['image']['name']);
		$filenameext = strtolower(end($filename1));
		
		$upload->setTargetFileName("works_".mktime().".".$filenameext);
		$upload->fetchMedia('image');
		if (!$upload->upload()) {
			redirect_header("index.php", 3, $upload->getErrors());
			exit();
		} else {
			$image = $upload->getSavedFileName();
		}		
	} else {
		$image = "";
	}

	$title = $myts->makeTboxData4Save($_POST['title']);
	$description = $myts->makeTareaData4Save($_POST['description']);
	$client = $myts->makeTboxData4Save($_POST['client']);
	$url = $myts->makeTboxData4Save($_POST['url']);

	if($_POST['dateb'] != "YYYY/MM/DD") {
		list($year, $month, $day) = explode("/", $_POST['dateb']);
		$dateb = mktime(0,0,0,$month,$day,$year);
	} else {
		$dateb = 0;
	}
	if($_POST['datee'] != "YYYY/MM/DD") {
		list($year2, $month2, $day2) = explode("/", $_POST['datee']);
		$datee = mktime(0,0,0,$month2,$day2,$year2);
	} else {
		$datee = 0;
	}
	
	$sql = sprintf("INSERT INTO %s (iid, cid, title, description, dateb, datee, client, url, image, featured, uid) VALUES ('', %u, '%s', '%s', %u, %u, '%s', '%s', '%s', %u, %u)", $xoopsDB->prefix("works_items"), $_POST['cid'], $title, $description, $dateb, $datee, $client, $url, $image, $_POST['featured'], $xoopsUser->getVar("uid", "E"));
	$xoopsDB->query($sql);
	
	redirect_header("index.php",1,_AM_WORKS_ADDOK);
	exit();
 
}

function editok() {
	global $xoopsModuleConfig, $myts, $xoopsDB;
	if($_POST['deleteimage'] == 1){
		if (file_exists(XOOPS_ROOT_PATH."/uploads/".$_POST['imagename'])) {
			 unlink(XOOPS_ROOT_PATH."/uploads/".$_POST['imagename']);
		}
		$image = "";
	}
	if (!empty($_FILES['image']['name']) ) {
		include_once(XOOPS_ROOT_PATH."/class/uploader.php");
		$upload = new XoopsMediaUploader(XOOPS_ROOT_PATH."/uploads/", array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/jpg', 'image/pjpg', 'image/x-png', 'image/png'), $xoopsModuleConfig['imagemax']);
	
		$filename1 = explode(".", $_FILES['image']['name']);
		$filenameext = strtolower(end($filename1));
		
		$upload->setTargetFileName("works_".mktime().".".$filenameext);
		$upload->fetchMedia('image');
		if (!$upload->upload()) {
			redirect_header("index.php", 3, $upload->getErrors());
			exit();
		} else {
			if ($_POST['imagename'] != "") {
				if (file_exists(XOOPS_ROOT_PATH."/uploads/".$_POST['imagename'])) {
					 unlink(XOOPS_ROOT_PATH."/uploads/".$_POST['imagename']);
				}
			}
		$image = $upload->getSavedFileName();
		}		
	}

	$title = $myts->makeTboxData4Save($_POST['title']);
	$description = $myts->makeTareaData4Save($_POST['description']);
	$client = $myts->makeTboxData4Save($_POST['client']);
	$url = $myts->makeTboxData4Save($_POST['url']);

	if($_POST['dateb'] != "YYYY/MM/DD") {
		list($year, $month, $day) = explode("/", $_POST['dateb']);
		$dateb = mktime(0,0,0,$month,$day,$year);
	} else {
		$dateb = 0;
	}
	if($_POST['datee'] != "YYYY/MM/DD") {
		list($year2, $month2, $day2) = explode("/", $_POST['datee']);
		$datee = mktime(0,0,0,$month2,$day2,$year2);
	} else {
		$datee = 0;
	}

    $xoopsDB->query("UPDATE ".$xoopsDB->prefix("works_items")." SET cid='".$_POST['cid']."', title='".$title."', description='".$description."', dateb='".$dateb."', datee='".$datee."', client='".$client."', url='".$url."', image='".$image."', featured='".$_POST['featured']."' WHERE iid=".$_POST['iid']."");

	redirect_header("index.php",1,_AM_WORKS_EDITOK);
	exit();
}

function deleteok() {
	global $xoopsDB;
	if($_POST['image'] != "") {
		if (file_exists(XOOPS_ROOT_PATH."/uploads/".$_POST['image'])) {
			 unlink(XOOPS_ROOT_PATH."/uploads/".$_POST['image']);
		}
	}
	$xoopsDB->query("DELETE FROM ".$xoopsDB->prefix("works_items")." WHERE iid=".$_POST['iid']."");
	
	redirect_header("index.php",1,_AM_WORKS_DELETEOK);
	exit();
}

// actions
if(isset($_POST['action']) && $_POST['action'] == "add") {
	addwork();

} elseif(isset($_POST['action']) && $_POST['action'] == "editok") {
	editok();

} elseif(isset($_POST['action']) && $_POST['action'] == "deleteok") {
	deleteok();

} elseif(isset($_GET['action']) && $_GET['action'] == "edit") {
	include_once("header_admin.php");
	xoops_cp_header();
	adminnav();
	editwork();
	xoops_cp_footer();

} elseif(isset($_GET['action']) && $_GET['action'] == "delete") {
	include_once("header_admin.php");
	xoops_cp_header();
	adminnav();
	deletework();
	xoops_cp_footer();

} else {
	include_once("header_admin.php");
	xoops_cp_header();
	adminnav();
	pageindex();
	xoops_cp_footer();
	
}
?>