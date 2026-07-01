<?php
include_once(BASEPATH."class/first-class.php");
class TopMenu extends FirstClass
{
	
	function getTopMenuByParentId($parentId=0, $data=array())
	{
		$this->setDatabaseConnection();
		$strsqlTopMenu = "select * from tbl_top_menu where parent_id=".$parentId;

		if((isset($data['sortBy']))&&(!empty($data['sortBy'])))
		{
			$strsqlTopMenu .=" order by ".$data['sortBy'];
		}

		$resultTopMenu = mysql_query($strsqlTopMenu);
		$topMenuLists = array();
		while($infoTopMenu = mysql_fetch_array($resultTopMenu,MYSQL_ASSOC))
		{
			$topMenuLists[]=$infoTopMenu;
		}
		$this->closeDBConnection();
		return $topMenuLists;
	}

	function addNewTopMenu($post)
	{
		
		$this->setDatabaseConnection();
		$title = $this->filterReceivedData($post['title']);
		$link = $this->filterReceivedData($post['link']);
		$position = $this->filterReceivedData($post['position']);
		$parent_id = $this->filterReceivedData($post['parent_id']);

		$strsqlTopMenu = "insert into tbl_top_menu (title, link, position, parent_id) values('".$title."','".$link."',".$position.",".$parent_id.")";
		if(mysql_query($strsqlTopMenu))
		{
			$_SESSION['sess_msg']='Record has been saved in the list.';
			$this->closeDBConnection();
			return true;
		}
		else
		{
			$_SESSION['sess_msg']='Record was not added in the list. Please try again';
			$this->closeDBConnection();
			return false;
		}
	}

	function getTopMenuById($topMenuId)
	{
		if($topMenuId=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$topMenuId = $this->filterReceivedData($topMenuId);
		$strsqlTopMenu = "select * from tbl_top_menu where id=".$topMenuId;
		$resultTopMenu = mysql_query($strsqlTopMenu);
		$infoTopMenu = mysql_fetch_array($resultTopMenu,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoTopMenu;
	}

	function updateTopMenu($post)
	{
		$this->setDatabaseConnection();
		$topMenuId = $this->filterReceivedData($post['topMenuId']);
		$title = $this->filterReceivedData($post['title']);
		$link = $this->filterReceivedData($post['link']);
		$position = $this->filterReceivedData($post['position']);
		$parent_id = $this->filterReceivedData($post['parent_id']);

		$strsqlTopMenu = "update tbl_top_menu set title='".$title."', link='".$link."', position=".$position.", parent_id=".$parent_id." where id=".$topMenuId; 
		if(mysql_query($strsqlTopMenu))
		{
			$_SESSION['sess_msg']='Record has been saved in the list.';
			$this->closeDBConnection();
			return true;
		}
		else
		{
			$_SESSION['sess_msg']='Record was not added in the list. Please try again';
			$this->closeDBConnection();
			return false;
		}
	}

	function deleteTopMenu($post)
	{
		
		if($post['topMenuIds']=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$topMenuIds = $this->filterReceivedData($post['topMenuIds']);
		$topMenuIdsList = array();
		$topMenuIdsList = explode(",",$topMenuIds);
		
		$countDelete = 0;
		foreach($topMenuIdsList as $topMenuId)
		{
			$strsqlTopMenu = "delete from tbl_top_menu where id=".$topMenuId;
			if(mysql_query($strsqlTopMenu))
			{
				$countDelete++;
			}
		}

		if($countDelete>0)
		{
			$_SESSION['sess_msg']=$countDelete.' Record has been deleted from the list.';
			$this->closeDBConnection();
			return true;
		}
		else
		{
			$_SESSION['sess_msg']='Record was not deleted from the list. Please try again';
			$this->closeDBConnection();
			return false;
		}
	}

}
?>