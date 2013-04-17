<?php
  foreach ($post as $value)
    { ?>
      <div class="billet">
          <h2 class="billet_titre">
              <?php echo $value["title"]; ?>
          </h2>
          <?php echo $value["content"]; ?>
          <div class="billet_infos">
              Post&eacute; le <?php echo $value["created"]; ?>,<?php echo(($value["updated"]=="") ? "" : "Modifié le ".$value["updated"]);  ?> par <span class="red"><?php echo $value["user_nickname"] ?></span> |<?php if ((isset($_SESSION["user"]))&&($_SESSION["user"]["user_id"]==$value["id_user"])||(isset($_SESSION["user"])&&$_SESSION["user"]["id_role"]==3)) { ?> <img src="images/edit.png" height="16" width="16" alt="&Eacute;diter" /> <a href=<?php echo '"index.php?view=updatepost&action=getpostbyid&post_id='.$value["post_id"].'"' ?> >Editer</a> | <img src="images/suppr.png" height="16" width="16" alt="Supprimer" /> <a onclick="ConfirmDeleteMessage('<?php echo 'index.php?action=deletepost&post_id='.$value["post_id"] ?>'); return false;" href="#" >Supprimer</a> |<?php } ?> <img src="images/comments.png" height="16" width="16" alt="Commentaires" /> <a href=<?php echo '"index.php?view=comment&action=getcomment&post_id='.$value["post_id"].'"' ?> >Commentaires (<?php echo $value["nbrcomment"] ?>)</a>
          </div>
      </div>
<?php	 } ?>