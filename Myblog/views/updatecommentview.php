<?php
foreach ($comment as $value) { ?>

	Modifiez votre commentaire<br/><br/>
	<form method="post" action=<?php echo '"index.php?action=updatecomment&view=comment&comm_id='.$value["comm_id"].'&post_id='.$value["post_id"].'"' ?> >
		<textarea name="comment_content" id="new_billet" rows="7"><?php echo $value["content"] ?></textarea>
		<input type="hidden" name="comm_id" value=<?php echo '"'.$value["comm_id"].'"' ?> />
		<input class="post_submit" type="submit" value="Envoyer" />
		<input class="post_submit" type="reset" value="Effacer" />
	</form>

<?php }

if (isset($error_array["update_comment"]))
{
	echo $error_array["update_comment"];
}

?>