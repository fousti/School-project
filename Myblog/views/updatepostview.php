<?php 
foreach ($post as $value) { ?>

	<span class="title">Modifier votre billet</span>
	<form action=<?php echo '"index.php?action=updatepost&view=comment&post_id='.$value["post_id"].'"' ?> method="post">
	     Titre : <input type="text" name="title" value=<?php echo '"'.$value["title"].'"' ?> />
	     <textarea name="content" rows="20" class="mce" id="new_billet"><?php echo $value["content"]; ?></textarea>
	     <input type="hidden" name="post_id" value=<?php echo '"'.$value["post_id"].'"' ?> />
	     <input class="post_submit" type="submit" value="Envoyer" />
	     <input class="post_submit" type="reset" value="Effacer" />
	</form>
<?php } ?>