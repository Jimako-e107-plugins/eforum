<?php
/*
 * Copyright e107 Inc e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
 *
 * Forum plugin - view shortcodess
 *
*/
if (!defined('e107_INIT')) { exit; }

/////e107::plugLan('forum', 'front', true);
//var_dump ("34234234234242342342");
class plugin_eforum_foruminfo_menu_shortcodes extends e_shortcode
{
/*
	private $forum_rules;
	private $gen;
	private $prefs;	
	private $sql;
	public $newFlagList;
*/

	function __construct()
	{
//		$this->forum_rules = function_exists('forum_rules') ? forum_rules('check') : '';
//        $this->gen = e107::getDate();
//		$this->sql = e107::getDb();
		$this->forum_sc = e107::getScBatch('forum', true);
		$this->viewforum_sc = e107::getScBatch('viewforum', 'forum');

		include_once(e_PLUGIN.'forum/forum_class.php');
		$forum = new e107forum;//		$this->count = 1;
		$forumList = $forum->forumGetForumList();
		foreach($forumList['parents'] as $parent)	
		{
//			print "<pre>";
//			print_r($parent);
//			print "</pre>";
			$parent = (array) $parent;
			$this->forum_sc->setVars($parent);
			$this->viewforum_sc->setVars($parent);
		}//        $this->prefs = e107::pref('forum');
/*
$this->sql->select('forum_post', 'post_datestamp', 'post_datestamp > 0 ORDER BY post_datestamp ASC LIMIT 0,1', 'default');
		$fp = $this->sql->fetch();
		$fp = is_array($fp) ? $fp : array();
//		var_dump ($row);
//		var_dump ($fp);
		$this->open_ds_in = (int) varset($fp['post_datestamp']);
*/
}

function sc_efim_info()
{
	$text = $this->forum_sc->sc_info();
/*
var_dump ($text);
var_dump (strrpos( $text, '<br>'));
var_dump (strrpos( $text, '<br'));
*/
	if (strrpos( $text, '<br'))
	{
		return substr($text, 0, strrpos( $text, '<br'));
	}
	return false;

}
function sc_efim_foruminfo()
{
	return $this->forum_sc->sc_foruminfo();
}
function sc_efim_userlist()
{
	return $this->forum_sc->sc_userlist();
}
function sc_efim_threadpages()
{
	$check_url = e_PAGE!="e_PAGE" ? e_PAGE : end(explode('/', parse_url(e_URL_LEGACY)['path']));

	if ($check_url==="forum_viewforum.php") {
		return $this->viewforum_sc->sc_threadpages();
	}
	return false;
}

/*
function sc_efim_iconkey()
{
	return $this->forum_sc->sc_iconkey();
}
*/
function sc_efim_iconkey()
{
	global $forum;

	if ($forum && (strpos( e_PAGE, "forum")!==false)){
//		return $this->sc_perms(array('show' => 1));
	//    return false;
/*
		if (!$forum){
		return false;
	}
*/
  //	var_dump($GLOBALS['FORUM_TEMPLATE']['iconkey']="werq23ecvzwdx<q0ufjlkfja39");
//	var_dump($FORUM_VIEWFORUM_TEMPLATE['iconkey']);
/*
	var_dump(e_PAGE);
	var_dump (e_PAGE === 'forum_viewtopic.php');
*/
/*
	if (e_PAGE === 'forum.php'){
		$GLOBALS['FORUM_VIEWFORUM_TEMPLATE'] =  e107::getTemplate('forum');
		//		$GLOBALS['FORUM_TEMPLATE']['iconkey']="v,.ncm,hdknax39";
//		$sc = $this->forum_sc->sc_iconkey();
	} else {
		$GLOBALS['FORUM_VIEWFORUM_TEMPLATE'] = e107::getTemplate('forum', 'forum_viewforum');
//		$GLOBALS['FORUM_VIEWFORUM_TEMPLATE']['iconkey']="4q0ufjlkfja39";
//		$sc = $this->viewforum_sc->sc_iconkey();
	}
//	$sc = $this->viewforum_sc->sc_iconkey();
//	$sc = $this->viewforum_sc;
*/
// reescrever isto....
$GLOBALS['FORUM_VIEWFORUM_TEMPLATE'] = ((e_PAGE === 'forum.php')?e107::getTemplate('forum'):e107::getTemplate('forum', 'forum_viewforum'));
//$GLOBALS['FORUM_VIEWFORUM_TEMPLATE'] = ((e_PAGE === 'forum.php')?e107::getTemplate('forum', null, null, true, null, true):e107::getTemplate('forum', 'forum_viewforum', null,true, null, true));
/*
	var_dump($GLOBALS['FORUM_VIEWFORUM_TEMPLATE']);
	echo "<hr>";
	var_dump($GLOBALS['FORUM_TEMPLATE']);
*/

	//return $this->forum_sc->sc_iconkey();
///	return $this->viewforum_sc->sc_iconkey();
//	return $sc;
	return (e_PAGE === 'forum_viewtopic.php')?null:$this->viewforum_sc->sc_iconkey();
}
	
return false;
}
function sc_efim_perms()
{
	global $forum;

//	if ($forum && (substr( e_PAGE, 0, 5 ) === "forum")){
	if ($forum && (strpos( e_PAGE, "forum")!==false)){
			//		if (!$forum){
//		return false;
//	}

	return $this->viewforum_sc->sc_perms();
}

return false;
}
function sc_efim_viewable_by()
{
	global $forum;

//	if ($forum && (substr( e_PAGE, 0, 5 ) === "forum")){
	if ($forum && (strpos( e_PAGE, "forum")!==false)){
			//		if (!$forum){
//		return false;
//	}

	return $this->viewforum_sc->sc_viewable_by();
}
return false;
}

function sc_efim_userinfox()
{
	return $this->forum_sc->sc_userinfox();
}

function sc_efim_dropdown()
{
//	var_dump($this->getSCvar('drop_options'));
	$options = $this->getSCvar('drop_options');
	$btndrop_class = $this->getSCvar('btndrop_class');
	// Para n�o ter separador ao fim...
if(empty($options[count($options)-1])) {
    unset($options[count($options)-1]);
}
// Para refazer para poder ser templatizado...
	$dropdown = '<div class="btn-group btn-sm">'.array_shift($options);

	if ($options) { $dropdown .='
    <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split '.($btndrop_class?:"btn-default").'" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
	<span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu pull-right dropdown-menu-end float-right">
    ';
	
	foreach($options as $val)
	{
		$dropdown .= $val?"<li class='dropdown-item'>".$val."</li>":"<li class='divider'></li>";
	}
	
/*
	$jumpList = $forum->forumGetAllowed();
	
	$text .= "<li class='divider'></li>";
	
	foreach($jumpList as $key=>$val)
	{
		$text .= '<li><a href ="'.e107::url('forum','forum',$val).'">'.LAN_FORUM_1017." ".$val['forum_name'].'</a></li>';
	}
	
*/	
	$dropdown .= '</ul>';
   }
	$dropdown .= '</div>';

	return $dropdown;
}

function sc_efim_afterdrop()
{
	return $this->getSCvar('afterdrop');
}
/*	function sc_open_date()
	{
//var_dump ($this->var['open_ds']);
//var_dump ($this->open_ds_in);
//var_dump ("PLUGIN");
		return $this->gen->convert_date($this->var['open_ds'], 'long');
	}
		
	function sc_open_since()
	{
		return $this->gen->computeLapse($this->var['open_ds']);
	}

	function sc_postsperday()
	{
        $open_days = floor((time()-$this->var['open_ds']) / 86400);
		return ($open_days < 1 ? $this->sc_total_posts() : round($this->sc_total_posts() / $open_days));
	}

	function sc_total_views()
	{
		$total_views = 0;

	//	$sql = e107::getDb();
		if ($this->sql->gen('SELECT sum(thread_views) AS total FROM `#forum_thread` '))
		{
			$row = $this->sql->fetch();
			$total_views = $row['total'];
		}
		return $total_views;
	}

	function sc_total_posts(){
		return e107::getDb()->count('forum_post');
	}

	function sc_total_topics(){
		return e107::getDb()->count('forum_thread');
	}

	function sc_total_replies(){
		return $this->sc_total_posts() - $this->sc_total_topics();
	}
	
	function sc_db_size(){
		return $this->var['db_size'];
	}

	function sc_avg_row_len(){
		return $this->var['avg_row_len'];
	}

	function sc_uinfo(){
//var_dump ($this->var);
		if($this->var['ma']['user_name'])
		{
*/			//$uinfo = "<a href='".e_HTTP."user.php ?id.{$ma['user_id']}'>{$ma['user_name']}</a>"; //TODO SEf Url .
/*
			$uparams = array('id' => $ma['user_id'], 'name' => $ma['user_name']);
			$link = e107::getUrl()->create('user/profile/view', $uparams);
			$uinfo = "<a href='".$link."'>".$ma['user_name']."</a>";
*/
/*			return "<a href='".e107::getUrl()->create('user/profile/view', array('id' => $this->var['ma']['user_id'], 'name' => $this->var['ma']['user_name']))."'>".$this->var['ma']['user_name']."</a>";
		}
		else
		{
			$tmp = explode(chr(1), $this->var['ma']['thread_anon']);
			return e107::getParser()->toHTML($tmp[0]);
		}
	}

	function sc_url(){
		$this->var['ma']['thread_sef'] = eHelper::title2sef($this->var['ma']['thread_name'],'dashl');
		return e107::url('forum','topic', $this->var['ma']);
	}

	function sc_thread_name(){
		return $this->var['ma']['thread_name'];
	}
	
	function sc_thread_total_replies(){
		return $this->var['ma']['thread_total_replies'];
	}

	function sc_thread_views(){
		return $this->var['ma']['thread_views'];
	}

	function sc_thread_datestamp(){
		return $this->gen->convert_date($this->var['ma']['thread_datestamp'], "forum");
	}

	function sc_count(){
		return $this->count++;
	}

	function sc_user_name(){
		return $this->var['ma']['user_name'];
	}
	
	function sc_user_url(){
		return e107::url('user/profile/view', $this->var['ma']);
	}

	function sc_user_forums(){
		return $this->var['ma']['user_forums'];
	}

	function sc_user_percentage(){
		return $this->var['ma']['percentage'];
	}

	function sc_percentage_bar(){
		return e107::getForm()->progressBar('prog',$this->var['ma']['percentage']);
	}
		*/
}

//var_dump ("90790890890890870");