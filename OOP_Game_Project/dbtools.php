<?php
	
	function myQuery($query)
	{
		global $link;

		if (empty($link))
			$link = mysqli_connect('localhost', 'root', 'x5stZny/', 'game_project') or die (mysqli_connect_error());
		$result = mysqli_query($link, $query) or die (mysqli_error($link));
		return $result;
	}

	function myFetchAssoc($query)
	{
		global $link;

		$result = myQuery($query) or die (mysqli_error($link));
		if (!$result)
			return false;
		$tab_res = mysqli_fetch_assoc($result);
		return $tab_res;
		
	}

	function myFetchAllAssoc($query) 	
	{
		global $link;
		$i = 0;

		$result = myQuery($query) or die (mysqli_error($link));
		$tab_res = null;

		if (!$result)
			return false;

		while ($array = mysqli_fetch_assoc($result))
			$tab_res[$i++] = $array;
		return $tab_res;
	}

	function myEscape($data) 	
	{
		global $link;

		return mysqli_real_escape_string($link, $data);
	}

	function myLastInsertId()
	{
		global $link;

		return mysqli_insert_id($link);
	}

	function myPrint($value, $die=NULL)
	{
		echo ('<pre>');
		print_r($value);
		echo ('</pre>');

		if (!is_null($die)) {
			die();
		}
	}

	function getAction()
	{
		if (!empty($_SERVER['PATH_INFO'])) {
		 	$params = explode('/', $_SERVER['PATH_INFO']);
		 	return $params[2];
		} else {
			return false;
		}
	}

?>