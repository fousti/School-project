Ajoutez votre commentaire
<br/>
<br/>
<form method="post" action=<?php echo '"index.php?action=addcomment&view=comment&post_id='.$_GET["post_id"].'"' ?> >
	<textarea name="comment_content" id="new_billet" rows="7"></textarea>
	<input class="post_submit" type="submit" value="Envoyer" />
	<input class="post_submit" type="reset" value="Effacer" />
</form>
<?php if (isset($error_array["comment"])) { ?>
	<br/><span class="form_error"><?php echo $error_array["comment"] ?></span>
<?php } ?>
