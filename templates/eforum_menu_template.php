<?php
/**
 * Copyright (C) e107 Inc (e107.org), Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
 * $Id$
 * 
 * News menus templates
 */

if (!defined('e107_INIT'))  exit;

$EFORUM_MENU_TEMPLATE['info'] 	= "<div class='forummenu overflow-auto'>{INFO}<br>{FORUMINFO}<p><br>{USERLIST}</div>";

$EFORUM_MENU_TEMPLATE['key'] 	= "<div class='d-flex col justify-content-center align-items-center'>
										{EFIM_ICONKEY}
										</div><br>
										<div class='d-flex col justify-content-center align-items-center'>
										{EFIM_USERINFOX}
										</div>";

$EFORUM_MENU_WRAPPER['key']['EFIM_ICONKEY']		= 	"<div class='card col'>{---}</div>";
										/*
$ENEWS_MENU_TEMPLATE['users']['caption'] 	= TD_MENU_L1;
$ENEWS_MENU_TEMPLATE['users']['start']		= "<div class='usersmenu inner'>"; // set the {NEWSIMAGE} dimensions. 								
$ENEWS_MENU_TEMPLATE['users']['item']		= '
<div class="author">
	<div class="row">
		<div class="col-auto post-by-author-avatar">
			<a href="{NEWS_AUTHOR_URL}">{NEWS_AUTHOR_AVATAR: class=rounded-circle me-3&w=50&h=50&crop=1&placeholder=1}</a>
		</div>
		<div class="col">
			{NEWS_AUTHOR}
			<br>
			<a class="icon-link link-info" href="{NEWS_AUTHOR_ITEMS_URL}" data-bs-toggle="tooltip" title="{NEWS_AUTHOR_COUNT}&nbsp;{LAN=LAN_ENEWS_01}">{GLYPH=fa-newspaper}&nbsp;{NEWS_AUTHOR_COUNT}&nbsp;{LAN=ADLAN_0}</a>
			<br>
			<a class="link-primary" href="{NEWS_URL}" data-bs-toggle="tooltip" title="{LAN=LAN_ENEWS_02}:&nbsp;{NEWS_TITLE}">{GLYPH=fa-calendar-week}&nbsp;{LAN=LAN_ENEWS_02}</a>
		</div>
	</div>
</div>
';
$ENEWS_MENU_TEMPLATE['users']['end']			= "</div>";

$ENEWS_MENU_TEMPLATE['tabbed']			= "<div class='tabs-wrapper'> 
<ul class='nav nav-tabs'>
  <li class='nav-item'><a class='active tab-1 nav-link' href='#tab-1' data-bs-toggle='tab'>{LAN=LAN_ENEWS_03}</a></li>
  <li><a class='tab-2 nav-link' href='#tab-2' data-bs-toggle='tab'>{LAN=LAN_ENEWS_04}</a></li>
  <li><a class='tab-3 nav-link' href='#tab-3' data-bs-toggle='tab'>{LAN=LAN_ENEWS_05}</a></li>
</ul>
<div class='tab-content'>
  <div id='tab-1' class='tab-pane fade show active'>
	 {SETSTYLE=tabbedmenu}
	 {MENU: path=enews/usersnews}
	 {MENU=20} 
  </div>
  <div id='tab-2' class='tab-pane fade'>
	{SETSTYLE=tabbedmenu}
	{MENU: path=news/other_news2}
	{MENU=21}  
  </div>
  <div id='tab-3' class='tab-pane fade'>
	{SETSTYLE=tabbedmenu}
	{MENU: path=comment/comment}
	{MENU=22} 
  </div>
</div>
</div>";
*/