<div id="inscription">
     <div id="form">
          <span id="inscr_title">Inscription</span>
          <form action="index.php?action=signup" method="post">
               <table>
                    <?php echo (isset($error_array["form"]["db"])?'<span class="form_error">'.$error_array["form"]["db"].'</span>':"");  ?>
                    <tr>
                         <td class="title">
                              Nom :
                              <?php if (isset($error_array["form"]["nom"])) echo '<br/><span class="form_error">'.$error_array["form"]["nom"].'</span>';?>
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