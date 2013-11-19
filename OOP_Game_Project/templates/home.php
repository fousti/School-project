<header>
    <h1>
        <img src="./cores/img/logoPOO.png">
    </h1>
</header>
<div id="player_wrapper">
    <div class="center">
                <span class="player">
                    JOUEUR 1
                </span>
                <span class="player player2">
                    JOUEUR 2
                </span>
    </div>
    <div class="clear"></div>
</div>
<form action="?action=init_party" method="post">
    <div id="form_wrapper">
        <div class="center">
            <div class="player" id="player1">
                <table>
                    <tr>
                        <td class="form_subtitle">Choisis ton pseudo</td>
                        <td>
                            <input type="text" id="playerNameOne" name="pseudo[]"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="form_subtitle">Choisis ton personnage</td>
                        <td>
                            <select id="playerClassOne" name="classes[]" id="">
                                <?php foreach ($var as $key => $v) { ?>
                                    <option value="<?php echo $v ?>"><?php echo $v ?></option>
                               <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="player player2">
                <table>
                    <tr>
                        <td class="form_subtitle">Choisis ton pseudo</td>
                        <td>
                            <input type="text" id="playerNameTwo" name="pseudo[]"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="form_subtitle">Choisis ton personnage</td>
                        <td>
                            <select id="playerClassTwo" name="classes[]" id="">
                                <?php foreach ($var as $key => $v) { ?>
                                    <option value="<?php echo $v ?>"><?php echo $v ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <input type="submit" value="START" id="form_init_submit"/>
</form>