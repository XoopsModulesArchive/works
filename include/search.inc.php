<?php 
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
if (!defined('XOOPS_ROOT_PATH')) {
	die("XOOPS root path not defined");
}

function works_search($queryarray, $andor, $limit, $offset, $userid){
	global $xoopsDB, $xoopsUser;
	$sql = "SELECT iid, cid, title, description, dateb, uid FROM ".$xoopsDB->prefix("works_items")."";
	if ( $userid != 0 ) {
		$sql .= " WHERE uid=".$userid." AND ";
	} else {
		$sql .= " WHERE ";
	}

	if (is_array($queryarray) && $count = count($queryarray)) {
		$sql .= " ((title LIKE '%".$queryarray[0]."%' OR description LIKE '%".$queryarray[0]."%' OR client LIKE '%".$queryarray[0]."%' OR url LIKE '%".$queryarray[0]."%')";
		for($i=1;$i<$count;$i++){
			$sql .= " $andor ";
			$sql .= "(title LIKE '%".$queryarray[$i]."%' OR description LIKE '%".$queryarray[$i]."%' OR client LIKE '%".$queryarray[$i]."%' OR url LIKE '%".$queryarray[$i]."%')";
		}
		$sql .= ") ";
	}
	$sql .= "ORDER BY iid DESC";
	$result = $xoopsDB->query($sql,$limit,$offset);
	$ret = array();
	$i = 0;
 	while($myrow = $xoopsDB->fetchArray($result)){
		$ret[$i]['image'] = "images/item.gif";
		$ret[$i]['link'] = "item.php?id=".$myrow['iid']."";
		$ret[$i]['title'] = $myrow['title'];
		$ret[$i]['time'] = $myrow['dateb'];
		$ret[$i]['uid'] = $myrow['uid'];
		$i++;
	}
	return $ret;
}
?>