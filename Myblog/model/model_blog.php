<?php 
function gettopblogcomm() {

	global $link ; 
	$query = "SELECT `user_nickname`, COUNT(c.`comm_id`) AS nbr_elem FROM `users` AS u LEFT JOIN `comments` AS c ON u.`user_id` = c.`comm_user_id` GROUP BY c.`comm_user_id` ORDER BY nbr_elem DESC LIMIT 0,5";

	$result = mysqli_query($link, $query);

	if ($result == false)
		{
			die(mysqli_error($link));
		}

	$topblogcom = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return($topblogcom);
}



function gettopblogpost() {

	global $link;
	$query = "SELECT `user_nickname`, COUNT(p.`post_id`) AS nbr_elem FROM `users` AS u LEFT JOIN `posts` AS p ON u.`user_id` = p.`id_user` GROUP BY p.`id_user` ORDER BY nbr_elem DESC LIMIT 0,5";

	$result = mysqli_query($link, $query);

	if ($result == false)
		{
			die(mysqli_error($link));
		}

	$topblogpost = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return($topblogpost);
}

function getmostcommented() {

	global $link;
	$query = "SELECT `title`, DATE_FORMAT(`created`, '%d/%m') AS created, u.`user_nickname`, COUNT(c.`comm_id`) AS nbrcomment, p.post_id AS post_id FROM `posts` AS p LEFT JOIN `users` AS u ON u.`user_id` = p.`id_user` LEFT JOIN `comments` AS c ON c.`post_id` = p.`post_id` GROUP BY c.`post_id` ORDER BY nbrcomment DESC LIMIT 0,3";

	$result = mysqli_query($link, $query);

	if ($result == false)
		{
	    	die(mysqli_error($link));
		}

	$topcomment = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return($topcomment);
}


?>