<?php

Class Wizard extends Champion {

    function __construct()
    {
        parent::__construct(array('strength' => -20, 'intelligence' => 50, 'health' => 0));
        $this->fill(array('name' => 'Veigar'));
        $this->fill(array('classe' => 'Wizard'));
        $this->save();
        $this->add_weapons(new Weapon(array('name' => "Street's wand",'intelligence_bonus' => 10)));
        $this->save_collections('weapons');
    }

    public function secondaryComp(Champion $enemy)
    {
        $this->add_buff(array('intelligence' => 20));
        $enemy->add_buff(array('intelligence' => -10));
    }

	public function mainComp(Champion $enemy)
    {
        $dmg = $this->computed_abilities('intelligence') + 10;

        $this->receive_attack(20);
        $enemy->receive_attack($dmg);
    }


}