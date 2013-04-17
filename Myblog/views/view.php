<!DOCTYPE html>
<html lang="fr">
     <head>
          <meta charset="utf-8">
          <title>Ghibli Blog - Le blog r&eacute;f&eacute;rence sur le studio Ghibli</title>
          <meta name="description" content="Ma pr&eacute;sentation">
          <meta name="author" content="Baptiste Gios">
          <link rel="stylesheet" href="styles/style.css" type="text/css"  media="screen">
     </head>
     <body>
          <div id="wrapper">
               <header>
                    <h1>
                         <span>Ghibli Blog - Le blog r&eacute;f&eacute;rence sur le studio Ghibli</span>
                         <a href="index.php">
                              <img height="190" width="247" src="images/logo.png" alt="Ghibli Blog" />
                         </a>
                    </h1>
               </header>

			<?php if ((isset($_GET["view"]) && ($_GET["view"] == "inscription")) || ((isset($error_array["form"])) && (!empty($error_array["form"]))))
				include("inscriptionview_v2.php");
                    else { ?>
               <div id="contentleft" class="top">
               <?php
                if (isset($_SESSION["secure"])) { ?>
               <span class="title"><?php echo $_SESSION["secure"]; ?></span>
               <?php } ?>

               <?php  if ((isset($_GET["view"]))&&(($_GET["view"]=="addpost"))||((isset($error_array["post"])) && (!empty($error_array["post"])))) 
                         include("addpostview.php");
                    elseif ((isset($_GET["view"]))&&(($_GET["view"]=="updatepost")))
                         include("updatepostview.php");
                    elseif ((isset($_GET["action"]))&&($_GET["action"]=="getpostuser")) 
                              {
                                   include("displaypostuser.php");
                                   echo "<div id=\"pagination\">";
                                   for ($i = 1 ; $i <= $number_page ; $i++)
                                        {
                                             if ($page==$i)
                                                  {
                                                       echo '<a href="index.php?action=getpostuser&page=' . $i . '">' .'<strong>'. $i .'</strong>'. '</a>';
                                                  }
                                             else
                                                  {
                                                       echo '<a href="index.php?action=getpostuser&page=' . $i . '">' . $i . '</a>';
                                                  }
                                        }
                                   echo "</div>";                                  
                              }
                    elseif ((isset($_GET["view"]))&&(($_GET["view"]=="comment"))||((isset($error_array["comment"])) && (!empty($error_array["comment"])))) 
                         {
                              include("displaypost.php");
                              include("displaycomment.php");
                              if (isset($_SESSION["user"]))
                                   include("addcommentview.php");
                              else
                                   echo ('<span class="inscr_link">Pour poster un commentaire, <a href="index.php?view=inscription">inscrivez-vous</a> ou connectez-vous !</span>');
                         }
                    elseif ((isset($_GET["view"]))&&(($_GET["view"]=="updatecomment"))) 
                         {
                              include("displaypost.php");
                              include("updatecommentview.php");
                         }
                    elseif ((isset($_GET["view"]))&&(($_GET["view"]=="admin"))) {
                              include('adminview.php');
                              echo "<div id=\"pagination\">";
                                   for ($i = 1 ; $i <= $number_page ; $i++)
                                        {
                                             if ($page==$i)
                                                  {
                                                       echo '<a href="index.php?view=admin&page=' . $i . '">' .'<strong>'. $i .'</strong>'. '</a>'.'&nbsp;';
                                                  }
                                             else
                                                  {
                                                       echo '<a href="index.php?view=admin&page=' . $i . '">' . $i . '</a>'.'&nbsp;';
                                                  }
                                        }
                              echo "</div>";

                         }
                    else
                         {
                              include("displaypost.php");
                              echo "<div id=\"pagination\">";
                              for ($i = 1 ; $i <= $number_page ; $i++)
                                   {
                                        if ($page==$i)
                                             {
                                                  echo '<a href="index.php?action=getlastpost&page=' . $i . '">' .'<strong>'. $i .'</strong>'. '</a>'.'&nbsp;';
                                             }
                                        else
                                             {
                                                  echo '<a href="index.php?action=getlastpost&page=' . $i . '">' . $i . '</a>'.'&nbsp;';
                                             }
                                   }
                              echo "</div>"; 
                         } 
               ?>  
               </div>
               <div id="contentright">
                    <div id="connexion" class="top">
                         <?php 
                         if (isset($_SESSION["user"]))
                         { ?>
               			<?php echo '<span class="title">'.$_SESSION["user"]["user_nickname"].'</span>' ?>
                              <?php if ($_SESSION["user"]["id_role"]>1) { ?>
                              <a class="sousmenu" href="index.php?view=addpost">Nouveau billet</a>
                              <a class="sousmenu" href="index.php?action=getpostuser">Voir mes billets</a>
                              <?php if ($_SESSION["user"]["id_role"]>2) {  ?>
                              <a class="sousmenu" href="index.php?view=admin">Page d'administration</a>
                              <?php } } ?>
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
                    <?php if (!empty($topcomment)) { ?>
                    <div class="top">
                         <span class="title">Billets les plus comment&eacute;s</span>
                         <ul>
                              <li class="bg_opacity">
                                   1. <a href=<?php echo '"index.php?view=comment&action=getcomment&post_id='.$topcomment[0]["post_id"].'"' ?> class="first"><?php echo $topcomment[0]["title"] ?></a><br/>
                                   <span class="infos">Posté le <?php echo $topcomment[0]["created"] ?> par <span class="red"><?php echo $topcomment[0]["user_nickname"] ?></span></span>
                              </li>
                              <?php if (isset($topcomment[1])) { ?>
                              <li>
                                   2. <a href=<?php echo '"index.php?view=comment&action=getcomment&post_id='.$topcomment[1]["post_id"].'"' ?>><?php echo $topcomment[1]["title"] ?></a><br/>
                                   <span class="infos">Posté le <?php echo $topcomment[1]["created"] ?> par <span class="red"><?php echo $topcomment[1]["user_nickname"] ?></span></span>
                              </li>
                              <?php } ?>
                              <?php if (isset($topcomment[2])) { ?>
                              <li class="bg_opacity">
                                   3. <a href=<?php echo '"index.php?view=comment&action=getcomment&post_id='.$topcomment[2]["post_id"].'"' ?>><?php echo $topcomment[2]["title"] ?></a><br/>
                                   <span class="infos">Posté le <?php echo $topcomment[2]["created"] ?> par <span class="red"><?php echo $topcomment[2]["user_nickname"] ?></span></span>
                              </li>
                              <?php } ?>
                         </ul>
                    </div>
                    <?php } ?>
                    
                    <?php if (!empty($topblog)) { ?>
                    <div class="top">
                         <span class="title">Top blogueurs</span>
                         <span id="topmenu"><a href=<?php echo '"index.php?'.'top_blog=commentaire&'.$query_str.'"' ?> >par Commentaires</a> | <a href=<?php echo '"index.php?'.'top_blog=billet&'.$query_str.'"'  ?> >par Billets</a></span>
                         <ul>
                              <li class="bg_opacity">
                                   1. <span class="first"><?php echo $topblog[0]["user_nickname"] ?></span>
                                   <span class="nb_billet"><?php echo $topblog[0]["nbr_elem"] ?> <?php echo ( $topblog[0]["nbr_elem"]>1 ? $_GET["top_blog"].'s' : $_GET["top_blog"] ) ?></span>
                              </li>
                              <?php if (isset($topblog[1])) { ?>
                              <li>
                                   2. <span><?php echo $topblog[1]["user_nickname"] ?></span>
                                   <span class="nb_billet"><?php echo $topblog[1]["nbr_elem"] ?> <?php echo ( $topblog[1]["nbr_elem"]>1 ? $_GET["top_blog"].'s' : $_GET["top_blog"] ) ?></span>
                              </li>
                              <?php } ?>
                              <?php if (isset($topblog[2])) { ?>
                              <li class="bg_opacity">
                                   3. <span><?php echo $topblog[2]["user_nickname"] ?></span>
                                   <span class="nb_billet"><?php echo $topblog[2]["nbr_elem"] ?> <?php echo ( $topblog[2]["nbr_elem"]>1 ? $_GET["top_blog"].'s' : $_GET["top_blog"] ) ?></span>
                              </li>
                              <?php } ?>
                              <?php if (isset($topblog[3])) { ?>
                              <li>
                                   4. <span><?php echo $topblog[3]["user_nickname"] ?></span>
                                   <span class="nb_billet"><?php echo $topblog[3]["nbr_elem"] ?> <?php echo ( $topblog[3]["nbr_elem"]>1 ? $_GET["top_blog"].'s' : $_GET["top_blog"] ) ?></span>
                              </li>
                              <?php } ?>
                              <?php if (isset($topblog[4])) { ?>
                              <li class="bg_opacity">
                                   5. <span><?php echo $topblog[4]["user_nickname"] ?></span>
                                   <span class="nb_billet"><?php echo $topblog[4]["nbr_elem"] ?> <?php echo ( $topblog[4]["nbr_elem"]>1 ? $_GET["top_blog"].'s' : $_GET["top_blog"] ) ?></span>
                              </li>
                              <?php } ?>
                         </ul>
                    </div>

                    <?php } ?>
               </div>
               <?php } ?>
               <footer>
                    <span>Cr&eacute;e par <span class="red">Isma&euml;l Tifous</span> et <span class="red">Baptiste Gios</span></span>
               </footer>
          </div>
          <script language="javascript" type="text/javascript" src="JS/tiny_mce/tiny_mce.js"></script>
          <script src="JS/inscription.js"></script>
          <script src="JS/functions.js"></script>
          <script language="javascript" type="text/javascript">
               tinyMCE.init({
                    theme : "advanced",
                    editor_selector : "mce",
                    mode : "textareas"
               });
          </script>
     </body>
</html>