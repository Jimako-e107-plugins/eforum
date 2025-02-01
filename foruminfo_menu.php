<?php
	/**
	 * e107 website system
	 *
	 * Copyright (C) 2008-2017 e107 Inc (e107.org)
	 * Released under the terms and conditions of the
	 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
	 *
	 */

if (!defined('e107_INIT'))  exit;

////var_dump (!e107::isInstalled('forum'));
if (!e107::isInstalled('forum'))
{
//	e107::redirect();
	return;
}
//e107::getMenu()->isVisible(array ('foruminfo_menu' => "1-forum/"));

//echo e_URL_LEGACY;
//echo e_PAGETITLE;
/*
  Set menu visibility to this pages only:
  forum.php
forum_viewforum.php
forum_track.php

Failsafe here
*/
//$menuget = e107::getMenu();// ie. popup config details from within menu-manager.

////var_dump (!e107::getMenu()->isVisible(array ('eforum_menu' => "1-/forum")));
if (!e107::getMenu()->isVisible(array ('eforum_menu' => "1-/forum"))) {
exit;
}

//e107::lan('forum','menu',true);  // English_menu.php or {LANGUAGE}_menu.php
//e107::getTemplate('forum');

//include_once(e_PLUGIN.'forum/forum_class.php');
//$forum = new e107forum;
/*
print "<pre>";
print_r($forum);
print "</pre>";

$forumList = $forum->forumGetForumList();
*/

//$tmp = e_PAGE;
//var_dump (substr($tmp, 0, strpos($tmp, ".")));

//$sc = e107::getScBatch(substr($tmp, 0, strpos($tmp, ".")), true);
/////////////////////////$sc = e107::getScBatch("forum", true);
//$sc = e107::getScBatch("viewforum", "forum");

///////////////////////$forumList = $forum->forumGetForumList(true);
/*
print "<pre>";
print_r($forumList);
print "</pre>";
*/
/*
foreach($forumList['parents'] as $parent)	
{
	print "<pre>";
	print_r($parent);
	print "</pre>";
	$parent = (array) $parent;
	$sc->setVars($parent);
}
*/
/*
$tmp = e_PAGE;
var_dump ($tmp);
*/
/*
print "<pre>";
print_r($forumList['parents'][0]);
print "</pre>";
*/
//////////////$sc->setVars($forumList['parents'][0]);
/*
$sc->setVars($forum);
*/
//global $forum;

//$ssc = e107::getScBatch("foruminfo", "eforum");











////<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2009 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 *
 */

/*
  Set menu visibility to this pages only:
  forum.php
forum_post.php
forum_stats.php
forum_update.php
forum_viewforum.php
forum_viewtopic.php

Failsafe here
*/

////if (!defined('e107_INIT'))  exit;

//$page = array('forum','forum_post','forum_stats','forum_update','forum_viewforum','forum_viewtopic');
//foreach ($page as $p) {
//  $onpage .= (strpos(e_PAGE, $p));
//}

//var_dump (e_PAGE);
//var_dump ($onpage);
//var_dump (is_numeric($onpage));

//var_dump (e107::getMenu()->isVisible(array ('menu_pages' => "1-forum/")));

//echo e_URL_LEGACY;
//echo e_PAGETITLE;
/*????????????????????????
if (!e107::getMenu()->isVisible(array ('menu_pages' => "1-/forum"))) {
	 return;
}
*/
//echo e_PAGE;
//echo e_PAGETITLE;




e107::lan('forum','menu',true);  // English_menu.php or {LANGUAGE}_menu.php
//include_once(e_PLUGIN.'forum/forum_class.php');

////class theme_forum_menu // plugin folder + menu name (without the .php)
/////{

/*
	private $plugPref = null;
	private $menuPref = null;
	private $forumObj = null;
*/

//	function __construct()
//	{
///		$this->forumObj = new e107forum;
///		$this->plugPref = e107::pref('forum'); // general forum preferences.
///		$this->menuPref = e107::getMenu()->pref();// ie. popup config details from within menu-manager.
///		$this->menuget = e107::getMenu();// ie. popup config details from within menu-manager.

//		$forumObj = new e107forum;
//		$plugPref = e107::pref('forum'); // general forum preferences.
//		$menuPref = e107::getMenu()->pref();// ie. popup config details from within menu-manager.
//		$menuget = e107::getMenu();// ie. popup config details from within menu-manager.

//		$this->render();

///	}



/*
	function getQuery()
	{
		$max_age = vartrue($this->menuPref['maxage'], 0);
		$max_age = ($max_age == 0) ? '' : '(p.post_datestamp > '.(time()-(int)$max_age*86400).') AND ';

		$forumList = implode(',', $this->forumObj->getForumPermList('view'));

		$qry = "
		SELECT
			p.post_user, p.post_id, p.post_datestamp, p.post_user_anon, p.post_entry,
			t.thread_id, t.thread_datestamp, t.thread_name, u.user_name, f.forum_sef
		FROM `#forum_post` as p

		LEFT JOIN `#forum_thread` AS t ON t.thread_id = p.post_thread
		LEFT JOIN `#forum` as f ON f.forum_id = t.thread_forum_id
		LEFT JOIN `#user` AS u ON u.user_id = p.post_user
		WHERE {$max_age} p.post_forum IN ({$forumList})
		ORDER BY p.post_datestamp DESC LIMIT 0, ".vartrue($this->menuPref['display'],10);

		return $qry;
	}

*/

	// TODO: cache menu.
///	function render()
///	{
/*
		$tp = e107::getParser();
		$sql = e107::getDb('nfp');
		$pref = e107::getPref();

		$qry = $this->getQuery();


		if($results = $sql->gen($qry))
		{
			$text = "<ul class='newforumposts-menu'>";

			while($row = $sql->fetch())
			{
				$datestamp 	= $tp->toDate($row['post_datestamp'], 'relative');
				$id 		= $row['thread_id'];
				$topic 		= ($row['thread_datestamp'] == $row['post_datestamp'] ?  '' : 'Re:');
				$topic 		.= strip_tags($tp->toHTML($row['thread_name'], true, 'emotes_off, no_make_clickable, parse_bb', '', $pref['menu_wordwrap']));

				$row['thread_sef'] = $this->forumObj->getThreadSef($row);

				if($row['post_user_anon'])
				{
					$poster = $row['post_user_anon'];
				}
				else
				{
					if($row['user_name'])
					{
						$poster = "<a href='".e107::getUrl()->create('user/profile/view', array('name' => $row['user_name'], 'id' => $row['post_user']))."'>{$row['user_name']}</a>";
					}
					else
					{
						$poster = '[deleted]';
					}
				}

				$post = strip_tags($tp->toHTML($row['post_entry'], true, 'emotes_off, no_make_clickable', '', $pref['menu_wordwrap']));
				$post = $tp->text_truncate($post, varset($this->menuPref['characters'],120), varset($this->menuPref['postfix'],'...'));

				// Count previous posts for calculating proper (topic) page number for the current post.
				//	$postNum = $sql2->count('forum_post', '(*)', "WHERE post_id <= " . $row['post_id'] . " AND post_thread = " . $row['thread_id'] . " ORDER BY post_id ASC");
				//	$postPage = ceil($postNum / vartrue($this->plugPref['postspage'], 10)); // Calculate (topic) page number for the current post.
				//	$thread = $sql->retrieve('forum_thread', '*', 'thread_id = ' . $row['thread_id']); 	// Load thread for passing it to e107::url().

				// Create URL for post.
				// like: e107_plugins/forum/forum_viewtopic.php?f=post&id=1
				$url = e107::url('forum', 'topic', $row, array(
					'query'    => array(
						'f' => 'post',
						'id'    => intval($row['post_id']) // proper page number
					),
				));


				$text .= "<li>";

				if ($this->menuPref['title'])
				{
					$text .= "<a href='{$url}'>{$topic}</a><br />{$post}<br /><small class='text-muted muted'>".LAN_FORUM_MENU_001." {$poster} {$datestamp}</small>";
				}
				else
				{
					$text .= "<a href='{$url}'>".LAN_FORUM_MENU_001."</a> {$poster} <small class='text-muted muted'>{$datestamp}</small><br />{$post}<br />";
				}

				$text .= "</li>";

			}

			$text .= "</ul>";
		}
		else
		{
			$text = LAN_FORUM_MENU_002;
		}


		if(!empty($this->menuPref['caption']))
		{
			$caption = !empty($this->menuPref['caption'][e_LANGUAGE])  ? $this->menuPref['caption'][e_LANGUAGE] : $this->menuPref['caption'];
		}
		else
		{
			$caption = LAN_PLUGIN_FORUM_LATESTPOSTS;
		}
*/
e107::lan('eforum');  // English_menu.php or {LANGUAGE}_menu.php
//			$caption = "Forum Menu";
	//	e107::debug('menuPref', $this->menuPref);
require_once(e_PLUGIN.'forum/forum_class.php');
$forum = new e107forum;

    $tp = e107::getParser(); 
/*
	require_once(e_PLUGIN.'forum/forum.php');
	$reflection = new ReflectionClass("forum_front");
	$forum_front = $reflection->newInstanceWithoutConstructor($forum);	
*/
//	var_dump($forum_front->forum_rules('show'));
//	var_dump(function_exists($forum_front->forum_rules()));
//	var_dump(function_exists('forum_rules'));
/*
if (!function_exists('forum_rules')) {
// ****************** INICIO DA C�PIA DA FUN��O FORUM_RULES DO FORUM.PHP. � PRECISO POR CAUSA DO SHORTCODE...
function forum_rules($action = 'check')
{
	if (ADMIN == true)
	{
		$type = 'forum_rules_admin';
	}
	elseif(USER == true)
	{
		$type = 'forum_rules_member';
	}
	else
	{
		$type = 'forum_rules_guest';
	}
	$result = e107::getDb()->select('generic', 'gen_chardata', "gen_type = '$type' AND gen_intdata = 1");
	if ($action == 'check') { return $result; }

	if ($result)
	{
		$row = e107::getDb()->fetch();
		$rules_text = e107::getParser()->toHTML($row['gen_chardata'], true);
	}
	else
	{
		$rules_text = LAN_FORUM_0072;
	}

	$text = '';

	if(deftrue('BOOTSTRAP'))
	{
		$breadarray = array(
			array('text'=> e107::pref('forum','title', LAN_PLUGIN_FORUM_NAME), 'url' => e107::url('forum','index') ),
			array('text'=>LAN_FORUM_0016, 'url'=>null)
		);

		$text = e107::getForm()->breadcrumb($breadarray);
	}

	$text .= "<div id='forum-rules'>".$rules_text."</div>";
	$text .=  "<div class='center'>".e107::getForm()->pagination(e107::url('forum','index'), LAN_BACK)."</div>";

	e107::getRender()->tablerender(LAN_FORUM_0016, $text, array('forum', 'forum_rules'));
}
// ****************** FIM DA C�PIA DA FUN��O FORUM_RULES DO FORUM.PHP. � PRECISO POR CAUSA DO SHORTCODE...
}
*/
////////////////////////////////////    $sc = e107::getScBatch('forum', true);

//    $info = "<div class='forummenu overflow-auto'>".$tp->parseTemplate("{INFO}<br>{FORUMINFO}<p><br>{USERLIST}", true, $sc)."</div>";
///////////////////////////////////    $info = $tp->parseTemplate($template['info'], true, $sc);

//var_dump ($FORUM_VIEWFORUM_TEMPLATE);
//		$check_url = e_PAGE ? e_PAGE : ($_SERVER['REQUEST_URI'] ? SITEURLBASE.$_SERVER['REQUEST_URI'] : e_SELF.(e_QUERY ? "?".e_QUERY : ''));
// POR AGORA TEM DE FICAR ASSIM, POR CAUSA DAS URLS SEF E NORMAIS.... GRRRR
//		$check_url = e_PAGE!="e_PAGE" ? e_PAGE : e_URL_LEGACY;
///////////////////////		$check_url = e_PAGE!="e_PAGE" ? e_PAGE : end(explode('/', parse_url(e_URL_LEGACY)['path']));
//		var_dump(e_URL_LEGACY);
//		var_dump($check_url);
//var_dump (e_HTTP);
//var_dump(parse_url($check_url));
//$temp = parse_url($check_url)['path'];

//var_dump(end(explode('/', $temp)));
//var_dump ($check_url);
//var_dump (strpos($check_url, "rum"));
//var_dump (strpos($check_url, $p[1]));
//var_dump (strpos("forum.php", $check_url) !== false);
//var_dump (strpos("forum_viewforum.php", $check_url) !== false);
//		var_dump(e_URL_LEGACY);
//		var_dump($check_url);
//var_dump (strpos($check_url, "#forum_viewforum.php"));
//var_dump ($check_url==="forum_viewforum.php");

//if (strpos($check_url, "#forum.php") !== false) {
/*
if ($check_url==="forum.php") {

//ICONKEYS
// Iconkey para a p�gina principal do f�rum...
// Este template � meu, n�o existe no core...
		$TEMPLATE['iconkey'] = "
													<div>".IMAGE_new_small." ".LAN_FORUM_0039."</div>
													<div>".IMAGE_nonew_small." ".LAN_FORUM_0040."</div>
													<div>".IMAGE_noreplies_small." ".LAN_FORUM_1008."</div>
                          <div>".IMAGE_closed_small." ".LAN_FORUM_0041."</div>";

//    $text .= '';
}
*/
//elseif (strpos($check_url, "#forum_viewforum.php") !== false) {
///	elseif ($check_url==="forum_viewforum.php") {
		if ($check_url==="forum_viewforum.php") {
//////////////////    $sc = e107::getScBatch('viewforum', 'forum');

//    var_dump ($sc->getParserVars()['ntUrl']);


//    $text = $tp->parseTemplate("{THREADPAGES}", true, $sc);
//////////////////////////////////////////////    $text = $tp->parseTemplate($template['viewforum'], true, $sc);
// {NEWTHREADBUTTONX} n�o necess�rio (j� tenho a lista de subforuns no menu princial...), s� preciso mesmo do bot�o...
//----			if(!empty($sc->getParserVars()['ntUrl']))
//----			{
//----				$textbutton = '<a href="' . $sc->getParserVars()['ntUrl'] . '" class="btn btn-primary btn-sm pull-right">' . LAN_FORUM_1018 . '</a>';
//----			}
//ICONKEYS
//----		$TEMPLATE = e107::getTemplate('forum','forum_viewforum');
//    var_dump ($TEMPLATE);
			if(!empty($sc->getParserVars()['ntUrl']))
			{
				$options[] = '<a class="btn btn-primary'.(USER?'"':' disabled"').' href="'.$sc->getParserVars()['ntUrl'] . '">' . LAN_FORUM_1018 . '</a>';
//				$button = ' btn-primary" href="'.$sc->getParserVars()['ntUrl'] . '">' . LAN_FORUM_1018 . '</a>';
        $btndrop_class = 'btn-primary';
			}
//ICONKEYS
//////////???		$TEMPLATE = e107::getTemplate('forum','forum_viewforum');
//    var_dump ($TEMPLATE);
  }

//elseif (strpos($check_url, "#forum_viewtopic.php") !== false) {
elseif ($check_url==="forum_viewtopic.php") {

    $sc = e107::getScBatch('view', 'forum');

//    var_dump ($sc->getParserVars()['ntUrl']);
	global $thread; 
//    global $thread;
//    var_dump ($thread);
		$sc->setVars($thread->threadInfo);

//    $text = $tp->parseTemplate("<br>{TRACK}&nbsp;{BUTTONSX}<br>", true, $sc);
// BUTTONSX est� mais abaixo, sem os links todos do f�rum
    $text = $tp->parseTemplate("{TRACK}&nbsp;", true, $sc);

// USADO NO FORUM_MENU DO TEMA
// TEM DE FICAR AQUI PORQUE N�O CONSIGO DEFINIR AS VARI�VEIS $THIS DENTRO DO MENU...
//function sc_buttonsx()
//{
//	global $sc; 

//	global $forum, $thread; 
//  $data = e107::getScBatch('view', 'forum');

//var_dump ($thread->threadInfo['forum_id']);	
//var_dump ($forum);	
	if ($forum->checkPerm($thread->threadInfo['thread_forum_id'], 'post') && $thread->threadInfo['thread_active'])
	{
		$url = e107::url('forum','post')."?f=rp&amp;id=".$thread->threadInfo['thread_id']."&amp;post=".$thread->threadId;
	//	$url = e107::getUrl()->create('forum/thread/reply', array('id' => $thread->threadId));
		$options[] = "<a class='btn btn-primary' href='".$url."'>".LAN_FORUM_2006."</a>";
    $btndrop_class = 'btn-primary';
	}
	if ($forum->checkPerm($thread->threadInfo['thread_forum_id'], 'post'))
	{
		$ntUrl = e107::url('forum','post')."?f=nt&amp;id=". $thread->threadInfo['thread_forum_id'];
	//	$ntUrl = e107::getUrl()->create('forum/thread/new', array('id' => $thread->threadInfo['thread_forum_id']));
		$options[] = '<a '.($options?'':'class="btn btn-primary" ')."href='".$ntUrl."'>".LAN_FORUM_2005."</a>";
	}	
	
//	$options[] = "<a href='" . e107::getUrl()->create('forum/thread/prev', array('id' => $thread->threadId)) . "'>".LAN_FORUM_1017." ".LAN_FORUM_2001."</a>";
//	$options[] = "<a href='" . e107::getUrl()->create('forum/thread/prev', array('id' => $thread->threadId)) . "'>".LAN_FORUM_1017." ".LAN_FORUM_2002."</a>";

//---- SIMILAR CODE AS SC_NEXTPREV!!!!!!!
	$prev = $forum->threadGetNextPrev('prev', $thread->threadId,$thread->threadInfo['forum_id'], $thread->threadInfo['thread_lastpost']);
	$next = $forum->threadGetNextPrev('next', $thread->threadId,$thread->threadInfo['forum_id'], $thread->threadInfo['thread_lastpost']);

	if($prev !== false)
	{
		$options[] = "<a href='" . e107::url('forum','topic', $prev) . "'>".LAN_FORUM_1017." ".LAN_FORUM_2001."</a>";
	}
	if($next !== false)
	{
		$options[] = "<a href='" .  e107::url('forum','topic', $next) . "'>".LAN_FORUM_1017." ".LAN_FORUM_2002."</a>";
	}

//$afterdrop = $tp->parseTemplate("{QUICKREPLY}", true, $sc);





//	function sc_quickreply()
//	{
//		  global $forum, $forum_quickreply;
		  global $forum_quickreply;

if ($forum->checkPerm($thread->threadInfo['thread_forum_id'], 'post') && $thread->threadInfo['thread_active'])
{
	//XXX Show only on the last page??
	if (!vartrue($forum_quickreply))
	{
		$ajaxInsert = ($thread->pages == $thread->page || $thread->pages == 0) ? 1 : 0;
	//	$ajaxInsert = 1;
	//	echo "AJAX-INSERT=".$ajaxInsert ."(".$thread->pages." vs ".$thread->page.")";
//Orphan $frm variable????		$frm = e107::getForm();

		$urlParms = array('f'=>'rp','id'=>$thread->threadInfo['thread_id'], 'post'=>$thread->threadInfo['thread_id']);
		$url = e107::url('forum','post', null, array('query'=>$urlParms));; // ."?f=rp&amp;id=".$thread->threadInfo['thread_id']."&amp;post=".$thread->threadInfo['thread_id'];

		$afterdrop =  "
		<form action='" . $url . "' method='post'>
		<div class='form-group'>
			<textarea cols='80' placeholder='".LAN_FORUM_2007."' rows='4' id='forum-quickreply-text' class='tbox input-xxlarge form-control' name='post' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea>
		</div>
		<div class='center text-center form-group'>
			<input type='submit' data-token='".e_TOKEN."' data-forum-insert='".$ajaxInsert."' data-forum-post='".$thread->threadInfo['thread_forum_id']."' data-forum-thread='".$thread->threadInfo['thread_id']."' data-forum-action='quickreply' name='reply' value='".LAN_FORUM_2007. "' class='btn btn-success button' />
			<input type='hidden' name='thread_id' value='".$thread->threadInfo['thread_id']."' />
		</div>
		
		</form>";

		if(E107_DEBUG_LEVEL > 0)
		{
		//	echo "<div class='alert alert-info'>Thread id: ".$threadId."</div>";
		//	print_a($this);
		}


				
		// Preview should be reserved for the full 'Post reply' page. <input type='submit' name='fpreview' value='" . Preview . "' /> &nbsp;
	}
//----	else
//----	{
//		return $forum_quickreply;
//----	}
}
//	}



/*
	$text .= '<div class="btn-group">
   '.$replyUrl.'
    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
    </button>
    <ul class="dropdown-menu pull-right">
    ';
	
	foreach($options as $val)
	{
		$text .= '<li>'.$val.'</li>';
	}
*/	
/*
	$jumpList = $forum->forumGetAllowed();
	
	$text .= "<li class='divider'></li>";
	
	foreach($jumpList as $key=>$val)
	{
		$text .= '<li><a href ="'.e107::url('forum','forum',$val).'">'.LAN_FORUM_1017." ".$val['forum_name'].'</a></li>';
	}
	
*/	
/*
	$text .= '
    </ul>
    </div><br>';
*/
//	return $text;
//}
}

// Construtor do dropdown para a p�gina principal do f�rum...
// O shortcode {STATLINK} tamb�m est� no {USERINFOX}...
//var_dump (sizeof($options)>1);
if (sizeof($options)>1) {$options[] = "";} 
//var_dump (sizeof($options)>1);
$options[] = '<a '.($options?'':'class="btn btn-default btn-block pull-left" ').'href="'.e_HTTP.'top.php?0.active">'.LAN_FORUM_0011.'</a>';

/*
$dropdown = '<div class="btn-group">'.($button?:$firstbutton).'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-original-title="">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
      </button>
  <div class="dropdown-menu">
    <li role="presentation">';
*/
// Aqui vem parte do shortcode legacy {USERINFO}    
//var_dump (e_BASE);
//		$dropdown .= ($button?'<a class="'.$firstbutton."</a></li><li role='presentation'>":"")."<a href='".e_BASE."top.php?0.top.forum.10'>".LAN_FORUM_0010."</a></li><li role='presentation'>";
		$options []= "<a href='".e_HTTP."top.php?0.top.forum.10'>".LAN_FORUM_0010."</a></li><li role='presentation'>";
//$dropdown .= "</li><li role='presentation'>";
// Fim do legacy {USERINFO}

//    $sc = e107::getScBatch('forum', true);
//$dropdown .= str_replace(" | ", "</li><li class='divider'></li><li role='presentation'>", e107::getParser()->parseTemplate("{USERINFOX}", true, e107::getScBatch('forum', true)));

//--------------$dropdown .= str_replace(" | ", "</li><li class='divider'></li><li role='presentation'>", $tp->parseTemplate("{USERINFOX}", true, $sc));

// ****************** INICIO DA C�PIA DO SHORTCODE {USERINFOX}. � um bocadinho diferente aqui...
//	function sc_userinfox()
//	{
//        global $forum;

//----         $uInfo = array();
//----		$uInfo[0] = "<a href='".e107::url('forum','stats')."'>".LAN_FORUM_6013.'</a>';
		$options[] = "<a href='".e107::url('forum','stats')."'>".LAN_FORUM_6013.'</a>';

    $options[]= ""; // String vazia para o divisor
////	var_dump($forum_front->forum_rules('show'));


/*
if(ADMIN == true)
{
	$type = 'forum_rules_admin';
}
elseif(USER == true)
{
	$type = 'forum_rules_member';
}
else
{
	$type = 'forum_rules_guest';
}
var_dump ($type);
//$result = e107::getDb()->select('generic', 'gen_chardata', "gen_type = '$type' AND gen_intdata = 1");

//		if(!empty(forum_rules()))
//		if(e107::getDb()->select('generic', 'gen_chardata', "gen_type = '$type' AND gen_intdata = 1"))
$tmp = (ADMIN?'forum_rules_admin':(USER?'forum_rules_member':'forum_rules_guest'));
var_dump($tmp);
*/
		if(e107::getDb()->select('generic', 'gen_chardata', "gen_type = '".(ADMIN?'forum_rules_admin':(USER?'forum_rules_member':'forum_rules_guest'))."' AND gen_intdata = 1"))
//		if(!empty($forum_rules))
		{
//----			$uInfo[1] = "<a href='".e107::url('forum','rules')."'>".LAN_FORUM_0016.'</a>';
			$options[] = "<a href='".e107::url('forum','rules')."'>".LAN_FORUM_0016.'</a>';
		}

		// To be reworked to get the $forum var
//var_dump ($forum);
		$trackPref = $forum->prefs->get('track');
//var_dump($forum->checkPerm($this->var['forum_id'], 'post'));
// ORIGINAL		if(!empty($trackPref) && $forum->checkPerm($this->var['forum_id'], 'post'))

//----$dropdown .= implode("</li><li class='divider'></li><li role='presentation'>", $uInfo);
//		return implode(" | ",$uInfo);
//	}


//var_dump ($_SERVER['HTTP_HOST']);
// Aqui vem parte do shortcode legacy {USERINFO}    
		if(USER)
		{
		if(!empty($trackPref))
		{
//----			$uInfo[2] = "<a href='".e107::url('forum','track')."'>".LAN_FORUM_0030."</a>";
			$options[] = "<a href='".e107::url('forum','track')."'>".LAN_FORUM_0030."</a>";
		}
//-----			$dropdown .= "</li><li role='presentation'><a href='".e_BASE.'userposts.php?0.forums.'.USERID."'>".LAN_FORUM_0012."</a>";
			$options[] = "<a href='".e_HTTP.'userposts.php?0.forums.'.USERID."'>".LAN_FORUM_0012."</a>";
		// To be reworked to get the $forum var $this->plugPref ???
		  global $pref;
			if($forum->prefs->get('attach') && (check_class($pref['upload_class']) || getperms('0')))
			{
//-----				$dropdown .= "</li><li role='presentation'><a href='".e_PLUGIN."forum/forum_uploads.php'>".LAN_FORUM_0015."</a>";
				$options[] = "<a href='".e_PLUGIN."forum/forum_uploads.php'>".LAN_FORUM_0015."</a>";
			}
		}
// Fim do legacy {USERINFO}

//-----$dropdown .= '</li></div></div>';

// Para n�o ter separador ao fim...
///////////////////
/*
if(empty($options[count($options)-1])) {
    unset($options[count($options)-1]);
}

	$dropdown = '<div class="btn-group">
   '.array_shift($options).'
    <button class="btn dropdown-toggle '.($btndrop_class?:"btn-default").'" data-toggle="dropdown">
    <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
    ';
	
	foreach($options as $val)
	{
		$dropdown .= $val?"<li role='presentation'>".$val."</li>":"<li class='divider'></li>";
	}
	*/
	///////////////
/*
	$jumpList = $forum->forumGetAllowed();
	
	$text .= "<li class='divider'></li>";
	
	foreach($jumpList as $key=>$val)
	{
		$text .= '<li><a href ="'.e107::url('forum','forum',$val).'">'.LAN_FORUM_1017." ".$val['forum_name'].'</a></li>';
	}
	
*/	
/////////////////////	$dropdown .= '</ul></div>';

/*
$dropdown = '<div class="btn-group dropdown">
  <button class="btn btn-default btn-sm btn-block dropdown-toggle" type="button" id="forummenu1" data-toggle="dropdown"><span class="pull-left"><a href="'.e_BASE.'top.php?0.active">'.LAN_FORUM_0011.'</a></span>
  <span class="caret pull-right"></span></button>
  <ul class="dropdown-menu btn-block " role="menu" aria-labelledby="forummenu1">
    <li role="presentation">';

// Aqui vem parte do shortcode legacy {USERINFO}    
		$dropdown .= "<a href='".e_BASE."top.php?0.top.forum.10'>".LAN_FORUM_0010."</a></li><li role='presentation'>";
$dropdown .= "</li><li role='presentation'>";
// Fim do legacy {USERINFO}
$dropdown .= str_replace(" | ", "</li><li class='divider'></li><li role='presentation'>", e107::getParser()->parseTemplate("{USERINFOX}", true, $sc));

// Aqui vem parte do shortcode legacy {USERINFO}    
		if(USER)
		{
			$dropdown .= "</li><li role='presentation'><a href='".e_BASE.'userposts.php?0.forums.'.USERID."'>".LAN_FORUM_0012."</a>";
		// To be reworked to get the $forum var $this->plugPref ???
		  global $forum, $pref;
			if($forum->prefs->get('attach') && (check_class($pref['upload_class']) || getperms('0')))
			{
				$dropdown .= "</li><li role='presentation'><a href='".e_PLUGIN."forum/forum_uploads.php'>".LAN_FORUM_0015."</a>";
			}
		}
// Fim do legacy {USERINFO}

$dropdown .= '</li></ul></div>';
*/    



//$template = e107::getTemplate('eforum','eforum_menu', null, true, true);
$template = e107::getTemplate('eforum', 'eforum_menu', 'foruminfo');

//var_dump ($template);
/////require_once (e_PLUGIN."eforum/eforum_menu_shortcodes.php");
//var_dump ($sc);
$sc = e107::getScBatch("foruminfo_menu", "eforum");
//var_dump ($sc);
$sc->setScVar("drop_options", $options);
$sc->setScVar("btndrop_class", $btndrop_class);
$sc->setScVar("afterdrop", $afterdrop);
//var_dump ($options);

$sc->wrapper('eforum_menu/foruminfo');
//$template .= e107::getTemplate('forum', 'forum_viewforum');
//$foruminfo = e107::getParser()->parseTemplate($template['key'], true, $ssc);
//var_dump ($text);
$text .= $tp->parseTemplate($template['main'], true, $sc);
//var_dump ($template['foruminfo']['caption']);
$caption= $template['caption']?$tp->parseTemplate($template['caption'], true, $sc):LAN_EFORUM_10;
/*
echo "<pre>";
var_dump ($template);
echo "</pre>";
var_dump ($template['caption']);
var_dump ($caption);
*/
///////////////////////////e107::getRender()->tablerender(false, $text, 'ef_menu');

// Sem perms, pois n�o est�o ok na p�gina forum.php....
// A aguardar que o shortcocde {USERLIST} possa levar wrappers...

//		e107::getRender()->tablerender($caption, $info."<br>".$text.$dropdown."<p>".$afterdrop, 'foruminfo_menu');
		echo $tp->parseTemplate($template['start']).e107::getRender()->tablerender($caption, $text, 'foruminfo_menu', true).$tp->parseTemplate($template['end']);
///	}

////}

//new theme_forum_menu;


