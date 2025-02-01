<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2010 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 *
 *
 * $Source: /cvs_backup/e107_0.8/e107_plugins/linkwords/e_tohtml.php,v $
 * $Revision$
 * $Date$
 * $Author$
 */



if (!defined('e107_INIT')) { exit; }


class eforum_parse
{

	protected $forumObj;

	/* constructor */
	function __construct(){
		/*
			parent::__construct();
				$this->e107 = e107::getInstance();
		*/

		
		$arrbread = e107::breadcrumb();
		if ((strpos( e_PAGE, "forum")!==false) && !defined('EFBCCONSTR_EXEC') && $arrbread){
		define('EFBCCONSTR_EXEC', true);
		$this->modbread($arrbread);
		}	
		
		
		
		
		
		
		
		
		
		
		  }


		  public function modbread($arrbread){
			include_once(e_PLUGIN . "forum/forum_class.php");
		  $this->forumObj = new e107forum();
		  
		  //    $this->scn = e107::getScBatch('news');
		  //    $this->scf = e107::getScBatch('forum');
		  //			$this->tp = e107::getParser();
		  //    $this->forumsc = e107::getScBatch('forum',TRUE);
		  //    $this->menu['foruminfo'] = e107::getmenu()->isLoaded("foruminfo");
		  /*
		  $query = "SELECT n.news_category, COUNT(*) FROM #news AS n GROUP BY n.news_category;";
		  ///    return e107::getDb()->retrieve($query);
		  e107::getDb()->gen($query);
		  while($row = e107::getDb()->fetch()){
		  $data[$row['news_category']] = $row['COUNT(*)'];
		  }
		  $this->cat_count = $data;
		  var_dump ($this->cat_count);
		  */
		  
		  
		  /*
		  
		  echo "<pre>»»»»»»»»»»»»»»»»»»»»";
		  var_dump(e107::breadcrumb());
		  echo "</pre>«««««««««««««««««««";
		  
		  e107::breadcrumb(array(array('text'=>'testetetet')));
		  
		  echo "<pre>";
		  var_dump(e107::breadcrumb());
		  echo "</pre>";
		  */
		  /*
		  <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" data-bs-toggle="dropdown" id="navbarDropdownMenuLink-7" data-target="#" aria-haspopup="true" aria-expanded="false" href="#" title="">
		  Content
		  </a>
		  */
		  // ###########################################
		  // ##### FORUM PLUGIN OVERRIDE BREADCRUMB SHORTCODE #####
		  // ###########################################
		  ////
		  ////
		  //// DEPOIS TENHO DE POR AQUI UM PREF PARA ISTO SER OPCIONAL.....
		  ////
		  ////
//		  $arrbread = e107::breadcrumb();
//		  if ((strpos( e_PAGE, "forum")!==false) && !defined('EFBCCONSTR_EXEC') && $arrbread){
//		  define('EFBCCONSTR_EXEC', true);
		  
		  /*
		  echo "<pre>";
		  var_dump(e_PAGE);
		  var_dump($arrbread);
		  echo "</pre>";
		  */		  
		  /*
		  $key = array_search('100', array_column($userdb, 'uid'));
		  
		  
		  
		  */
		  /*
		  echo "<pre>";
		  var_dump(e_PAGE);
		  echo "</pre>";
		  */
		  
		  // Código para injectar uma drop down list nos breadcrumbs...
		  // $arrbread = (e107::breadcrumb());
		  $replarr = array_pop($arrbread);
		  if (strpos( e_PAGE, "viewtopic")!==false) {
		  $endarr = $replarr;
		  $replarr = array_pop($arrbread);
		  }
		  //    $options = '<div class="dropdown"><a data-target="#" aria-haspopup="true" aria-expanded="false" href="#" title="" id="dropdownMenuBC" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" data-bs-togle="dropdown">Geysers del Tatio (Standard)</a><ul class="dropdown-menu">';
		  $options = '<a class="dropdown-toggle" role="button" data-toggle="dropdown" data-bs-toggle="dropdown" id="navbarDropdownMenuLink-7" data-target="#" aria-haspopup="true" aria-expanded="false" href="#" title="">'.
		  $replarr['text'].'</a><ul class="dropdown-menu">';
		  
		  $sql = e107::getDb('forumnav');
		  /////////$forumList = implode(',', $this->forumObj->permList['view']);
		  $forumList = implode(',', $this->forumObj->getForumPermList('view'));
		  //$forumList = implode(',', $forumObj->permList['view']);
		  //var_dump ($forumList);
		  //var_dump ($this->forumObj->getForumPermList('view'));
		  /*
		  $qry = "
		  SELECT forum_id, forum_name, forum_sef FROM `#forum`
		  WHERE forum_id IN ({$forumList}) AND forum_parent != 0
		  ";
		  */
		  /// Isto pode sair se o pull https://github.com/e107inc/e107/pull/5402 for aprovado....
		  $qry = "
		  SELECT f.forum_id, f.forum_name, f.forum_sef, pf.forum_name AS parent_name
		  FROM `#forum` AS f LEFT JOIN `#forum` AS pf
		  ON f.forum_parent = pf.forum_id
		  WHERE f.forum_id IN ({$forumList}) AND f.forum_parent != 0
		  ORDER BY pf.forum_id, f.forum_name";
		  
		  //var_dump ($qry);
		  //$ret = [];
		  //$jumplist = [];
		  if ($sql->gen($qry))
		  {
		  //  while($row = $sql->fetch())
		  while($val = $sql->fetch())
		  {
		  //    $ret[$row['forum_id']] = $row;
		  //    $jumplist[$row['forum_id']] = $row;
		  //  }
		  
		  //}
		  //return $ret;
		  
		  /// ##### Fim das alterações ^^^^^^^^
		  //  foreach($jumpList as $key => $val)
		  //  {
		  /*
		  echo "<pre>";
		  var_dump ($val['parent_name']?$val['parent_name']." - ":"");
		  */
		  ////    $text .= '<li class="dropdown-item"><a href ="' . e107::url('forum', 'forum', $val) . '">' . $val['forum_name'] . '</a></li>';
		  //    $droptions[] = '<a href ="' . e107::url('forum', 'forum', $val) . '">' . $val['forum_name'] . '</a>';
		  $options .= '<li class="dropdown-item"><a href ="' . e107::url('forum', 'forum', $val) . '"><span class="forum-parent">' . $val['parent_name'] . "</span>" . $val['forum_name'] . '</a></li>';
		  }
		  $options .= '</ul>';
		  ////      $arrbread = (e107::breadcrumb());
		  }
		  /*
		  foreach($value as $k=>$v)
		  {
		  $text .= '<li class="dropdown-item">'.$v.'</li>';
		  }
		  */
		  $replarr['text'] = $options;
		  $replarr['url'] = null;
		  /*
		  echo "<pre>";
		  var_dump($arrbread);
		  echo "</pre>";
		  echo "<hr>";
		  echo "<pre>";
		  var_dump($replarr);
		  echo "</pre>";
		  echo "<pre>";
		  var_dump($arrbread[] = $replarr);
		  echo "</pre>";
		  */
		  $arrbread[] = $replarr;
		  if (strpos( e_PAGE, "viewtopic")!==false) {
		  $arrbread[] = $endarr;
		  }
		  /*  
		  var_dump($arrbread);
		  */  
		  e107::breadcrumb($arrbread);
		  /*
		  echo "<pre>";
		  var_dump($options);
		  echo "</pre>";
		  */
		  //    $frm=e107::getForm();
		  
		  //    $optdd = $frm->button('goto',$options,'dropdown',&nbsp;,array('class'=>"btn btn-secondary dropdown-toggle"));
		  /*
		  <span href="#">Geysers del Tatio (Standard) <span class="glyphicon glyphicon-triangle-bottom small" aria-hidden="true"></span></span>
		  <div class="drop bg-white">
		  */
		  /*
		  echo "<pre>";
		  var_dump($optdd);
		  echo "</pre>";
		  */  
		  ///    e107::breadcrumb(array(array('text'=>$options)));
		  
//		  }
		  
		}		  
		  
		  
		  
		  


	/**
	 * Process a string before it is sent to the browser as html.
	 * @param string $text html/text to be processed.
	 * @param string $context Current context ie.  OLDDEFAULT | BODY | TITLE | SUMMARY | DESCRIPTION | WYSIWYG etc.
	 * @return string
	 */
/*
	 function toHTML($text, $context='')
	{
		$text = str_replace('****', '<hr>', $text);
		return $text;
	}
*/



	/**
	 * Process a string before it is saved to the database.
	 * @param string $text html/text to be processed.
	 * @param array $param nostrip, noencode etc.
	 * @return string
	 */
/*
	 function toDB($text, $param=array())
	{
	//	e107::getDebug()->log($text);
		$text = str_replace('<hr>', '****', $text);
		return $text;
	}
*/


}




