<?php
/*
* Copyright (c) e107 Inc e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
*
* Featurebox shortcode batch class - shortcodes available site-wide. ie. equivalent to multiple .sc files.
*/

if (!defined('e107_INIT')) { exit; }

//e107::lan('eforum');  // English_menu.php or {LANGUAGE}_menu.php

////e107::includeLan(e_PLUGIN.'eforum/languages/'.e_LANGUAGE);


class eforum_shortcodes extends e_shortcode// must match the plugin's folder name. ie. [PLUGIN_FOLDER]_shortcodes
{	
	public $override = true; // when set to true, existing core/plugin shortcodes matching methods below will be overridden. 
	protected $forumObj;
	protected $tp;

	function __construct(){
		/*
			parent::__construct();
				$this->e107 = e107::getInstance();
		*/
				include_once(e_PLUGIN . "forum/forum_class.php");
				$this->forumObj = new e107forum();
		
		//    $this->scn = e107::getScBatch('news');
		//    $this->scf = e107::getScBatch('forum');
			$this->tp = e107::getParser();
		//    $this->forumsc = e107::getScBatch('forum',TRUE);
		//    $this->menu['foruminfo'] = e107::getmenu()->isLoaded("foruminfo");
		
		// O breadcrumb passou para o e_parse do eforum
		  }
		
// ###########################################
// ##### FORUM PLUGIN OVERRIDE SHORTCODES #####
// ###########################################

// Possivelmente pode sair se este pull for aprovado no github e107 https://github.com/e107inc/e107/pull/5415
function sc_post_content($parm = null)
{
	$tp = e107::getParser();
	$pref = e107::getPref();
	$post = strip_tags($tp->toHTML(e107::getScBatch('view', 'forum')->var['post_entry'], true, 'emotes_off, no_make_clickable', '', $pref['menu_wordwrap']));
//		$post = $tp->text_truncate($post, varset($this->param['nfp_characters'], 120), varset($this->param['nfp_postfix'], '...'));
	$post = $tp->truncate($post, varset($this->param['nfp_characters'], (intval($parm['truncate'])??120)), varset($this->param['nfp_postfix'], '...'));

//	var_dump(intval($parm['truncate'])??120);
	return $post;
}

function sc_newflag($parms) // Forum template
{
  $sc = e107::getScBatch('forum');
////////////////////////// MUDAR, já cá tenho o forum sem ser preciso a global..... ainda não...
//  global $forum;
//  var_dump ($forum);
  
//      $forumList = $forum->forumGetForumList();
//-----  $newflag_list = $forum->forumGetUnreadForums();
  $newflag_list = $this->forumObj->forumGetUnreadForums();

//  		$newflag_list = array(1,2,3,4,5);
  //var_dump ($sc->var['forum_replies']);
//  var_dump ($sc->var['forum_id']);
/*
	echo "<pre>";
var_dump ($newflag_list);
  var_dump ($parms);
  echo "</pre>";
*/
  if(USER && is_array($newflag_list) && in_array($sc->var['forum_id'], $newflag_list))
  {
    $url = $sc->sc_lastpost(array('type'=>'url'));
    return ($parms['class']?'forum_newmess':"<a href='".$url."'>".defset('IMAGE_new').'</a>');
  }
  elseif(empty($sc->var['forum_replies']) && defined('IMAGE_noreplies'))
  {
    return ($parms['class']?false:defset('IMAGE_noreplies'));
  }
  return ($parms['class']?false:defset('IMAGE_nonew'));
}

	///
	/// EM TESTE, PARA VER SE VALE A PENA TRAZER O DO TEMA
	///
/*
	function sc_iconkey($template, $force = false)
	{
		return "sdlkfldsfjklsdjfklsdfjaljflksj";
	}
*/
	///
	/// PARA SAIR SE APROVAREM O PULL https://github.com/e107inc/e107/pull/5414
	///
/* ----------------------------
	function sc_quickreply()
	{
//		echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>#######################<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>";
//
		global $forum, $forum_quickreply, $thread, $FORUM_VIEWTOPIC_TEMPLATE;

		// Define which tinymce4 template should be used, depending if the current user is registered or a guest
		if(!deftrue('e_TINYMCE_TEMPLATE'))
		{
			define('e_TINYMCE_TEMPLATE', (USER ? 'member' : 'public')); // allow images / videos.
		}

//		if($forum->checkPerm($this->var['thread_forum_id'], 'post') && $this->var['thread_active'])
		if($forum->checkPerm($thread->threadInfo['thread_forum_id'], 'post') && $thread->threadInfo['thread_active'])
		{
			//XXX Show only on the last page??
			if(!vartrue($forum_quickreply))
			{
//				$ajaxInsert = ($thread->pages == $thread->page || $thread->pages == 0) ? 1 : 0;
				//	$ajaxInsert = 1;
				//	echo "AJAX-INSERT=".$ajaxInsert ."(".$thread->pages." vs ".$thread->page.")";
//Orphan $frm variable????		$frm = e107::getForm();

				$urlParms = array('f' => 'rp', 'id' => $this->var['thread_id'], 'post' => $this->var['thread_id']);
//				$url = e107::url('forum', 'post', null, array('query' => $urlParms)); // ."?f=rp&amp;id=".$thread->threadInfo['thread_id']."&amp;post=".$thread->threadInfo['thread_id'];

				$vars = array(
					'QR_URL' => e107::url('forum', 'post', null, array('query' => $urlParms)),
					'QR_TOKEN' => e_TOKEN,
					'QR_AJAX' => ($thread->pages == $thread->page || $thread->pages == 0) ? 1 : 0,
					'QR_THID' => $this->var['thread_id'],
					'QR_THFORUMID' => $this->var['thread_forum_id']
				);

				$qr = e107::getPlugPref('forum', 'quickreply', 'default');

				if($qr == 'default')
				{


					$template = e107::getParser()->parseTemplate($FORUM_VIEWTOPIC_TEMPLATE['quickreply'], true, $vars);

				}
				else
				{
					$pref = (array) e107::pref('forum');
					$editor =  varset($pref['editor'], null);
					$editor = is_null($editor) ? 'default' : $editor;

					$textarea = e107::getForm()->bbarea('post', '', 'forum', 'forum', 'medium', array('id' => 'forum-quickreply-text', 'wysiwyg' => $editor));
					$template = preg_replace("~(?s)<textarea.*?</textarea>~", $textarea, $FORUM_VIEWTOPIC_TEMPLATE['quickreply']);
					


//					return $text;
				}

				return e107::getParser()->parseTemplate($template, true, $vars);
				// Preview should be reserved for the full 'Post reply' page. <input type='submit' name='fpreview' value='" . Preview . "' /> &nbsp;
			}
//----	else
//----	{
			return $forum_quickreply;
//----	}
		}
	}
---------------------------------------------*/
// Customizei para os dois tipos (botões em ecras largos e lista em pequenos), até eventualmente posso customizar para tres tipos de ecrans....
// mas vai ser dificil templatizar....
// Provavelmente tenho de propor isto no gihub.....
function sc_postoptions($parms=null)
{
  $sc = e107::getScBatch('view', 'forum');

//  $tp = e107::getParser();
var_dump($sc->postInfo['post_thread']);
  $threadID = !empty($sc->postInfo['post_thread']) ? $sc->postInfo['post_thread'] : 0;
  $postID = !empty($sc->postInfo['post_id']) ? $sc->postInfo['post_id'] : 0;
  $page= (varset($_GET['p']) ? (int)$_GET['p'] : 1);
  // {EMAILITEM} {PRINTITEM} {REPORTIMG}{EDITIMG}{QUOTEIMG}

  $textbut = "<div class='btn-toolbar d-none d-md-flex'>";

  $text = '<div class="btn-group pull-right float-right float-end d-md-none">
      <button class="btn btn-default btn-secondary btn-sm btn-small dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown">
      ' . LAN_FORUM_8013 . '
        ';
  if(defined('BOOTSTRAP') && BOOTSTRAP !== 4)
  {
    $text .= '<span class="caret"></span>';
  }

  $text .= '</button><ul class="dropdown-menu pull-right dropdown-menu-end float-right text-right text-end">';

  if ($parms['what']=='thread' || !$parms['what']) {
  $textbut .= "<div class='btn-group me-2 justify-content-center'>";
  $text .= "<li class='text-right text-end float-right'>";
  $textbut .= "<a class='btn btn-default text-nowrap' role='button'" .
  $temptext =" href='" . e_HTTP . "print.php?plugin:forum." . $threadID . "'>" . $this->tp->toGlyph('fa-print') . LAN_FORUM_2045 . "</a>";
  $text .="<a class='dropdown-item'" . $temptext ."</li>"; // FIXME

  $text .= "<li class='text-right text-end float-right'>";
  $textbut .= "<a class='btn btn-default text-nowrap' role='button'" .
  // O sc {GLYPH=edit} nem squer dá aqui... tenho de chamar a função...
  $temptext = " href='" . e_HTTP . "email.php?plugin:forum." . $threadID . "'>" . $this->tp->toGlyph('fa-envelope') . LAN_FORUM_2044 . "</a>";
  $text .= "<a class='dropdown-item'" . $temptext ."</li>";
  $textbut .= "</div>";
  }
  
  if ($parms['what']=='post' || !$parms['what']) {
    $textbut .= "<div class='btn-group justify-content-center'>";

  if(USER) // Report
  {
    $urlReport = e107::url('forum', 'post') . "?f=report&amp;id=" . $threadID . "&amp;post=" . $postID;
    //	$urlReport = $this->e107->url->create('forum/thread/report', "id={$threadID}&post={$postID}");
    $text .= "<li class='text-right text-end float-right'>";
    $textbut .= "<a class='btn btn-warning text-nowrap' role='button'" .
    $temptext = " href='" . $urlReport . "'>" . $this->tp->toGlyph('fa-flag') . LAN_FORUM_2046 . "</a>";
    $text .= "<a class='dropdown-item'".$temptext."</li>";
  }

  // Edit
  if((USER && isset($sc->postInfo['post_user']) && $sc->postInfo['post_user'] == USERID && $sc->var['thread_active']))
  {
    //$url = e107::url('forum', 'post') . "?f=edit&amp;id=" . $threadID . "&amp;post=" . $postID;
    $url = e107::url('forum', 'post') . "?f=edit&amp;id=" . $threadID . "&amp;post=" . $postID . "&amp;p=".$page;
    //$url = e107::getUrl()->create('forum/thread/edit', array('id' => $threadID, 'post'=>$postID));
    $text .= "<li class='text-right text-end float-right'>";
    $textbut .= "<a class='btn btn-default text-nowrap' role='button'" .
    $temptext = " href='" . $url . "'>" . $this->tp->toGlyph('fa-edit') . LAN_EDIT . "</a>";
    $text .= "<a class='dropdown-item'".$temptext."</li>";
  }

  // Delete own post, if it is the last in the thread
  if($sc->thisIsTheLastPost && USER && $sc->thread->threadInfo['thread_lastuser'] == USERID && !defset('MODERATOR'))
  {
    /* only show delete button when post is not the initial post of the topic
     * AND if this post is the last post in the thread */
    if($sc->var['thread_active'] && empty($sc->postInfo['thread_start']))
    {
      $text .= "<li class='text-right text-end float-right'>";
      $textbut .= "<a class='btn btn-danger text-nowrap' role='button'" .
      $temptext = " href='" . e_REQUEST_URI . "' data-forum-action='deletepost'  data-confirm='" . LAN_JSCONFIRM . "' data-forum-post='" . $postID . "'>" . $this->tp->toGlyph('fa-trash') . LAN_DELETE . "</a>";
      $text .= "<a class='dropdown-item'".$temptext."</li>";
    }
  }

  if(isset($sc->postInfo['post_forum']) && $this->forumObj->checkperm($sc->postInfo['post_forum'], 'post'))
  {
    $url = e107::url('forum', 'post') . "?f=quote&amp;id=" . $threadID . "&amp;post=" . $postID;
    //$url = e107::getUrl()->create('forum/thread/quote', array('id' => $threadID, 'post'=>$postID));
    $text .= "<li class='text-right text-end float-right'>";
    $textbut .= "<a class='btn btn-default text-nowrap' role='button'" .
    $temptext = " href='" . $url . "'>" . $this->tp->toGlyph('fa-share-alt') . LAN_FORUM_2041 . "</a>";
    $text .= "<a class='dropdown-item'".$temptext."</li>";

    //	$text .= "<li class='text-right float-right'><a href='".e107::getUrl()->create('forum/thread/quote', array('id' => $postID))."'>".LAN_FORUM_2041." ".$this->tp->toGlyph('share-alt')."</a></li>";
  }
  $textbut .= "</div><div class='btn-group me-2 justify-content-center'>";

  if(defset('MODERATOR'))
  {
    $textbut .= "</div><div class='btn-group justify-content-center'>";
    $text .= "<li role='presentation' class='divider'><hr class='dropdown-divider'></li>";
    $type = ($sc->postInfo['thread_start']) ? 'thread' : 'Post';

    //	print_a($sc->postInfo);

// Edit
    if((USER && isset($sc->postInfo['post_user']) && $sc->postInfo['post_user'] != USERID && $sc->var['thread_active']))
    {

      //$url = e107::url('forum', 'post') . "?f=edit&amp;id=" . $threadID . "&amp;post=" . $postID;
      $url = e107::url('forum', 'post') . "?f=edit&amp;id=" . $threadID . "&amp;post=" . $postID . "&amp;p=".$page;
      // $url = e107::getUrl()->create('forum/thread/edit', array('id' => $threadID, 'post'=>$postID));

      $text .= "<li class='text-right text-end float-right'>";
      $textbut .= "<a class='btn btn-default text-nowrap' role='button'" .
      $temptext = " href='" . $url . "'>" . $this->tp->toGlyph('fa-edit') . LAN_EDIT . "</a>";
      $text .= "<a class='dropdown-item'" . $temptext . "</li>";
    }

    // only show delete button when post is not the initial post of the topic
    //	if(!$this->forum->threadDetermineInitialPost($postID))
    if(empty($sc->postInfo['thread_start']))
    {
      $text .= "<li class='text-right text-end float-right'>";
      $textbut .= "<a class='btn btn-danger text-nowrap' role='button'" .
      $temptext = " href='" . e_REQUEST_URI . "' data-forum-action='deletepost' data-confirm='" . LAN_JSCONFIRM . "'  data-forum-post='" . $postID . "'>" . $this->tp->toGlyph('fa-trash') . LAN_DELETE . "</a>";
      $text .= "<a class='dropdown-item'" . $temptext . "</li>";
    }

// Move
    if($type == 'thread')
    {
      $url = e107::url('forum', 'move', array('thread_id' => $threadID));
      $text .= "<li class='text-right text-end float-right'>";
      $textbut .= "<a class='btn btn-default text-nowrap' role='button'" .
      $temptext = " href='" . $url . "'>" . $this->tp->toGlyph('fa-arrows') . LAN_FORUM_2042 . "</a>";
      $text .= "<a class='dropdown-item'" . $temptext . "</li>";
    }
    elseif(e_DEVELOPER === true) //TODO
    {
      $text .= "<li class='text-right text-end float-right'>";
      $textbut .= "<a class='btn btn-default text-nowrap' role='button'" .
      $temptext = " href='" . e107::url('forum', 'split', array('thread_id' => $threadID, 'post_id' => $postID)) . "'>" . $this->tp->toGlyph('fa-cut') . LAN_FORUM_2043 . "</a>";
      $text .= "<a class='dropdown-item'" . $temptext . "</li>";

    }
    $textbut .= '</div>';
  }
}

  $textbut .= '</div>';
  $text .= '</ul></div>';

  return $textbut.$text;

}

}
