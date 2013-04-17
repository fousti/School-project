<h2 class="billet_titre">
     Poster un nouveau billet
</h2>
<form action="index.php?action=addpost" method="post">
     Titre : <input type="text" name="title" />
     <textarea name="content" rows="20" class="mce" id="new_billet"></textarea>
     <input class="post_submit" type="submit" value="Envoyer" />
     <input class="post_submit" type="reset" value="Effacer" />
</form>
<?php if (isset($error_array["post"])) { ?>
	<br/><span class="form_error"><?php echo $error_array["post"] ?></span>
<?php } ?>

