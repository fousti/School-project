<header>
    <h1>
        <img src="./cores/img/logoPOO.png">
    </h1>
</header>
<div id="player_wrapper">
    <div class="center">
                <span class="player">
                    <?php echo($var['user1']->pseudo); ?> (<?php echo($var['champion_user1'][0]->name); ?>)
                    <span class="hp"><?php echo($var['champion_user1'][0]->health); ?></span>
                </span>
                <span class="player player2">
                    <?php echo($var['user2']->pseudo); ?> (<?php echo($var['champion_user2'][0]->name); ?>)
                    <span class="hp"><?php echo($var['champion_user2'][0]->health); ?></span>
                </span>
    </div>
    <div class="clear"></div>
</div>
<div id="form_wrapper">
    <div class="center">
        <div class="player" id="player1">
            <?php if (isset($var['turn_is']) && $var['turn_is'] == $var['user1']->id) { ?>
                <form class="action_player" action="?action=action" method="post">
                    <span>
                        <input type="radio" name="method" data-user-id="<?php echo $var['user1']->id; ?>" class="battleActionPone" value="attack" id="form_attack"/><label for="form_attack">Attack</label>
                    </span>
                    <span>
                        <input type="radio" name="method" data-user-id="<?php echo $var['user1']->id; ?>" class="battleActionPone" value="protection" id="form_protection"/><label for="form_protection">Protect</label>
                    </span>
                    <span>
                        <input type="radio" name="method" data-user-id="<?php echo $var['user1']->id; ?>" class="battleActionPone" value="heal" id="form_heal"/><label for="form_heal">Heal</label>
                    </span>
                    <span>
                        <input type="radio" name="method" data-user-id="<?php echo $var['user1']->id; ?>" class="battleActionPone" value="mainComp" id="form_mainComp"/><label for="form_mainComp">mainComp</label>
                    </span>
                    <span>
                        <input type="radio" name="method" data-user-id="<?php echo $var['user1']->id; ?>" class="battleActionPone" value="secondaryComp" id="form_secondaryComp"/><label for="form_secondaryComp">secondaryComp</label>
                    </span>
                    <input type="hidden" name="id_user" value="<?php echo $var['user1']->id; ?>" />
                    <input type="submit" value="GO"/>
                </form>
            <?php } ?>
        </div>
        <div class="j2 player2">
            <?php if (isset($var['turn_is']) && $var['turn_is'] == $var['user2']->id) { ?>
                <form class="action_player" action="?action=action" method="post">
                    <span>
                        <input type="radio" name="method" data-user-id="<?php echo $var['user2']->id; ?>" class="battleActionTwo" value="attack" id="form_attack"/><label for="form_attack">Attack</label>
                    </span>
                    <span>
                        <input type="radio" name="method" data-user-id="<?php echo $var['user2']->id; ?>" class="battleActionTwo" value="protection" id="form_protection"/><label for="form_protection">Protect</label>
                    </span>
                    <span>
                        <input type="radio" name="method" data-user-id="<?php echo $var['user2']->id; ?>" class="battleActionTwo" value="heal" id="form_heal"/><label for="form_heal">Heal</label>
                    </span>
                    <span>
                        <input type="radio" name="method" data-user-id="<?php echo $var['user2']->id; ?>" class="battleActionTwo" value="mainComp" id="form_mainComp"/><label for="form_mainComp">mainComp</label>
                    </span>
                    <span>
                        <input type="radio" name="method" data-user-id="<?php echo $var['user2']->id; ?>" class="battleActionTwo" value="secondaryComp" id="form_secondaryComp"/><label for="form_secondaryComp">secondaryComp</label>
                    </span>
                    <input type="hidden" name="id_user" value="<?php echo $var['user2']->id; ?>" />
                    <input type="submit" value="GO"/>
                </form>
            <?php } ?>
        </div>
        <div class="clear"></div>
        <div>
            <div class="center">
                <!-- affiche le player gagnant -->
            </div>
        </div>
        <div id="restartButton">
            <form method="post" action="index.php?action=restart">
                <input type="submit" value="RECOMMENCER" ?>
            </form>
        </div>
    </div>
    <div class="clear"></div>
</div>