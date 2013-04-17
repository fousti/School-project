<span class="title">Page d'administration</span>
<ul id=admin>
<?php
foreach ($users as $value) {

?>
<li class="bg_opacity">
<span class="red"><?php echo '<a href="index.php?action=getpostuser&user_id='.$value["id"].'" >'.$value["nickname"].'</a>' ?><span>
<a href=<?php echo '"index.php?action=deleteuser&user_id='.$value["id"].'"' ?> ><img id="supp_member" src="images/supp_member.png" title="Supprimer le membre" alt="Supprimer le membre" width="22" height="21"/></a>
<form method="post" action=<?php echo '"index.php?action=updaterole&user_id='.$value["id"].'"' ?> >
<input type="hidden" name="user_id" value=<?php echo '"'.$value["id"].'"' ?> />
<input src="images/ok.png" type="image" alt="Valider" value="submit" />
<?php echo $value['nickname'] ?> est actuellement : <?php echo $value['role'] ?>
<select name="id_role">
<option value='3'>administrateur</option>
<?php if ($value['id_role']==1) { ?>
<option value="2">bloggeur</option>
<?php }
else { ?>
<option value="1">membre</option>
<?php } ?>
</select>
</form>
</li>


<?php } ?>
</ul>
