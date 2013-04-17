<?php 
if (empty($comment))
    {
        echo "<span class=\"title\">Aucun commentaire pour le moment</span>";
    }
else
    {
	foreach ($comment as $value) { ?>

		<div class="comment">
			<p class="comment_content">
				<?php echo $value["content"]; ?>
			</p>
			<div class="comment_infos">
				Post&eacute; le <?php echo $value["date_create"]; ?>,<?php echo(($value["updated"]=="") ? "" : "Modifié le ".$value["updated"]);  ?> par <span class="red"><?php echo $value["author"] ?></span> <?php if ((isset($_SESSION["user"]))&&($_SESSION["user"]["user_id"]==$value["user_id"])||(isset($_SESSION["user"])&&$_SESSION["user"]["id_role"]==3)) { ?>| <img src="images/edit.png" height="16" width="16" alt="&Eacute;diter" /> <a href=<?php echo '"index.php?view=updatecomment&action=getcommentbyid&comm_id='.$value["comm_id"].'&post_id='.$value["post_id"].'"' ?> >Editer</a> | <img src="images/suppr.png" height="16" width="16" alt="Supprimer" /> <a onclick="ConfirmDeleteMessage('<?php echo 'index.php?view=comment&action=deletecomment&comm_id='.$value["comm_id"].'&post_id='.$value["post_id"] ?>'); return false;" href="#" >Supprimer</a> <?php } ?>
			</div>
		</div>
<?php } } ?>