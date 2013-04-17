<div id="connexion" class="top">
     <?php 
     if (isset($_SESSION["user"]))
     { ?>
          <p><?php echo 'Welcome '.$_SESSION['user']['name']; ?></p>
          <p>Last connection : <?php echo $_SESSION['user']['last_connect']; ?></p>
          <form action="index.php?action=disconnect" method="post" >
                <input class="submit" type="submit" name="disconnect" value="Disconnect">
          </form>
     <?php }
     else
     {
          if (isset($error_array["connect"]))
               echo '<span class="error">'.$error_array["connect"].'</span>';

          ?>
          <form action="index.php?action=connect" method="post">
               <input class="text" type="text" name="mail" placeholder="email" />
               <input class="text" type="password" name="password" placeholder="Password" />
               <input class="submit" type="submit" value="Sign In" />
          </form>
         
     <?php } ?>
</div>