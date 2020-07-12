<?php
// $Id: xoops_version.php,v 1.0 2005/12/23 16:11:54 cmagana Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
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
$modversion['name'] = _MI_WORKS_NAME;
$modversion['version'] = 0.9;
$modversion['description'] = _MI_WORKS_DESC;
$modversion['credits'] = "Carlos Leopoldo Magaña Zavala, www.neoideas.com.mx www.miguanajuato.com";
$modversion['author'] = "Carlos Leopoldo Magaña Zavala";
$modversion['help'] = "news.html";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "images/works_slogo.png";
$modversion['dirname'] = "works";

$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = "works_items";
$modversion['tables'][1] = "works_categories";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Templates
$modversion['templates'][0]['file'] = 'works_index.html';
$modversion['templates'][0]['description'] = '';
$modversion['templates'][1]['file'] = 'works_item.html';
$modversion['templates'][1]['description'] = '';
$modversion['templates'][2]['file'] = 'works_category.html';
$modversion['templates'][2]['description'] = '';

// Menu
$modversion['hasMain'] = 1;

// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "include/search.inc.php";
$modversion['search']['func'] = "works_search";

/**
* Format of the date to use in the module, if you don't specify anything then the default date's format will be used
*/
$modversion['config'][0]['name'] = "dateformat";
$modversion['config'][0]['title'] = "_MI_WORKS_DATEFORMAT";
$modversion['config'][0]['description'] = "_MI_WORKS_DATEFORMAT_DESC";
$modversion['config'][0]['formtype'] = "texbox";
$modversion['config'][0]['valuetype'] = "text";
$modversion['config'][0]['default'] = "m/Y";

/**
* Number of characters will be showed in items list
*/
$modversion['config'][1]['name'] = "ncharitem";
$modversion['config'][1]['title'] = "_MI_WORKS_NCHARITEM";
$modversion['config'][1]['description'] = "_MI_WORKS_NCHARITEM_DESC";
$modversion['config'][1]['formtype'] = "texbox";
$modversion['config'][1]['valuetype'] = "int";
$modversion['config'][1]['default'] = 120;

/**
* Number of characters will be showed in categories list
*/
$modversion['config'][2]['name'] = "ncharcategory";
$modversion['config'][2]['title'] = "_MI_WORKS_NCHARCATEGORY";
$modversion['config'][2]['description'] = "_MI_WORKS_NCHARCATEGORY_DESC";
$modversion['config'][2]['formtype'] = "texbox";
$modversion['config'][2]['valuetype'] = "int";
$modversion['config'][2]['default'] = 300;

/**
* Number of characters will be showed in categories list
*/
$modversion['config'][3]['name'] = "imagemax";
$modversion['config'][3]['title'] = "_MI_WORKS_IMAGEMAX";
$modversion['config'][3]['description'] = "_MI_WORKS_IMAGEMAX_DESC";
$modversion['config'][3]['formtype'] = "texbox";
$modversion['config'][3]['valuetype'] = "int";
$modversion['config'][3]['default'] = 102400;
?>