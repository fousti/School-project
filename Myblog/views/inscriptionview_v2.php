<div id="inscription">
     <div id="form">
          <span id="inscr_title">Inscription</span>
          <form action="index.php?action=signup" method="post" id="inscr_form">
               <table>
                    <?php echo (isset($error_array["form"]["db"])?'<span class="error">'.$error_array["form"]["db"].'</span>':""); ?>
                    <tr>
                         <td class="form_title">
                              Pseudo :
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <input class="form_text" id="nickname" type="text" name="nickname" autocomplete="off" required />
                              <span class="form_error">(entre 2 et 10 caract&egrave;res)</span>
                         </td>
                    </tr>
                    <tr>
                         <td class="form_title">
                              Pr&eacute;nom :
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <input class="form_text" id="prenom" type="text" name="prenom" autocomplete="off" required />
                              <span class="form_error">(que des caract&egrave;res alphab&eacute;tiques)</span>
                         </td>
                    </tr>
                    <tr>
                         <td class="form_title">
                              Nom :
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <input class="form_text" id="nom" type="text" name="nom" autocomplete="off" required />
                              <span class="form_error">(que des caract&egrave;res alphab&eacute;tiques)</span>
                         </td>
                    </tr>
                    <tr>
                         <td class="form_title">
                              Email :
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <input class="form_text" id="email" type="text" name="email" autocomplete="off" required />
                              <span class="form_error">(adresse valide SVP)</span>
                         </td>
                    </tr>
                    <tr>
                         <td class="form_title">
                              Mot de passe :
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <input class="form_text" id="pass" type="password" name="pass" required />
                              <span class="form_error">(8 caract&egrave;res minimum)</span>
                         </td>
                    </tr>
                    <tr>
                         <td class="form_title">
                              Confirmation :
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <input class="form_text" id="verif_pass" type="password" name="verif_pass" required />
                              <span class="form_error">(doit &ecirc;tre identique au mot de passe)</span>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <input class="inscr_submit" type="reset" value="Réinitialiser" />
                              <input class="inscr_submit" type="submit" value="Envoyer" />
                         </td>
                    </tr>
               </table> 
          </form>
     </div>
</div>