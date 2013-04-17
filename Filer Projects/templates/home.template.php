<div id="inscription">
     <div id="form">
          <span id="inscr_title">Inscription</span>
          <form action="index.php?action=signup" method="post">
               <table>
                    <?php echo (isset($error_array["form"]["db"])?'<span class="form_error">'.$error_array["form"]["db"].'</span>':""); ?>
                    <tr>
                         <td class="title">
                              Nom :
                              <?php if (isset($error_array["form"]["nom"])) 
      				     echo '<br/><span class="form_error">'.$error_array["form"]["nom"].'</span>';?>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <input class="text" type="text" name="nom" />
                         </td>
                    </tr>
                    <tr>
                         <td colspan="2" class="title">
                              Adresse email (vous servira de login pour la connexion) :
                              <?php if (isset($error_array["form"]["email"])) 
                              echo '<br/><span class="form_error">'.$error_array["form"]["email"].'</span>';?>
                         </td>
                    </tr>
                    <tr>
                         <td colspan="2" >
                              <input class="text" type="email" name="email" />
                         </td>
                    </tr>
                    <tr>
                         <td colspan="2" class="title">
                              Mot de passe :
                              <?php if (isset($error_array["form"]["pass"])) 
                              echo '<br/><span class="form_error">'.$error_array["form"]["pass"].'</span>';?>
                         </td>
                    </tr>
                    <tr>
                         <td colspan="2">
                              <input class="text" type="password" name="pass" />
                         </td>
                    </tr>
                    <tr>
                         <td colspan="2" class="title">
                              Confirmation du mot de passe :
                              <?php if (isset($error_array["form"]["verif_pass"])) 
           				echo '<br/><span class="form_error">'.$error_array["form"]["verif_pass"].'</span>';?>
                         </td>
                    </tr>
                    <tr>
                         <td colspan="2">
                              <input class="text" type="password" name="verif_pass" />
                         </td>
                    </tr>
                    <tr>
                         <td colspan="2">
                              <input class="inscr_submit" type="submit" value="Envoyer" />
                         </td>
                    </tr>
               </table> 
          </form>
     </div>
</div>
<div id="connexion" class="top">
                         <?php 
                         if (isset($_SESSION["user"]))
                         { ?>
                              <?php echo 'Welcome'.$_SESSION['nickname'] ?>
                              <form action="index.php?action=disconnect" method="post" >
                                    <input class="submit" type="submit" name="disconnect" value="D&eacute;connexion">
                              </form>
                         <?php }
                         else
                         {
                              if (isset($error_array["connect"]))
                                   echo '<span class="error">'.$error_array["connect"].'</span>';

                              if ((isset($_GET["action"])) && (($_GET["action"]) == "sign_up_succeed"))
                                   echo '<span class="error">Inscription r&eacute;ussie, vous pouvez vous connecter</span>';?>
                              <form action="index.php?action=connect" method="post">
                                   <input class="text" type="text" name="mail" placeholder="Adresse email" />
                                   <input class="text" type="password" name="password" placeholder="Mot de passe" />
                                   <input class="submit" type="submit" value="Connexion" />
                              </form>
                              <a class="inscr_link" href="index.php?view=inscription">Vous n'&ecirc;tes pas encore inscrit ?</a>
                         <?php } ?>
                    </div>