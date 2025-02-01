<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

if (!defined('e107_INIT'))  exit;

/*
$menu_config = e107::getConfig('menu'); 
var_dump ($menu_config);
echo "<hr>";
$temp = $old = $menu_config->getPref();
var_dump ($old);
echo "<hr>";
echo "<hr>";
*/
/*
$menuPref = e107::getMenu()->pref();// ie. popup config details from within menu-manager.
var_dump ($menuPref);
*/
//e107::getMenu()->setParms('forum','newforumposts_menu', $newPrefs, 1);
/*
$tmp = e107::getMenu()->getParams('newforumposts_menu', 1);
var_dump ($tmp);
echo "<hr>";
//public function setParms($plugin, $menu, $parms=array(), $location = 'all')
//{
    $newprefs = array(
        'layout'     => 'main',
    );
        $qry = 'menu_parms="'.e107::serialize($newprefs).'" WHERE menu_path="forum/" AND menu_name="newforumposts_menu" ';
//    $qry .= ($location !== 'all') ? 'menu_location='. (int)$location : '';

var_dump (e107::getDb()->update('menus', $qry));
    var_dump (e107::getMenu()->getParams('newforumposts_menu', 1));
    echo "<hr>";
    //}
//e107::getMenu()->pref('layout') = 'default';// ie. popup config details from within menu-manager.
//e107::getMenu()->;// ie. popup config details from within menu-manager.
//$menuPref = e107::getMenu()->pref();// ie. popup config details from within menu-manager.
//var_dump ($menuPref);
include_once(e_PLUGIN.'forum/newforumposts_menu.php?layout=main');

$qry = 'menu_parms="'.e107::serialize($tmp).'" WHERE menu_path="forum/" AND menu_name="newforumposts_menu" ';
//    $qry .= ($location !== 'all') ? 'menu_location='. (int)$location : '';

    e107::getDb()->update('menus', $qry);
    var_dump (e107::getMenu()->getParams('newforumposts_menu', 1));
    echo "<hr>";
*/
//$template = "{MENU: path=forum/newforumposts&layout=main}";

//echo $text;
//$ns->tablerender("", $tp->parseTemplate("{MENU: path=forum/newforumposts&layout=main}",true));
///$text = e107::getParser()->parseTemplate("{MENU: path=forum/newforumposts&layout=main}",true);

require_once (e_PLUGIN.'forum/forum_class.php');
$forum = new e107forum();
require_once(HEADERF);
// render the header (everything before the main content area)
///echo $text;
////echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>---------»";

echo e107::getParser()->parseTemplate("{MENU: path=forum/newforumposts&layout=main}",true);

////echo "________________________________________________<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>";


require_once(FOOTERF);					// render the footer (everything after the main content area)

//new forum_newforumposts_menu;
