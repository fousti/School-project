<?php
Class Warrior extends Champion {

    function __construct($name = null)
    {

        parent::__construct(array('strength' => 70, 'intelligence' => -50, 'health' => 0));
        $this->fill(array('name' => 'Riven'));
        $this->fill(array('classe' => 'Warrior'));
        $this->save();
        $this->add_weapons(new Weapon(array('name' => 'Axe of doom','strength_bonus' => 10)));
        $this->save_collections('weapons');
    }

    public function secondaryComp(Champion $enemy)
    {
        $this->add_buff(array('strength' => 20));
        $this->add_buff(array('intelligence' => -5));
        $enemy->add_buff(array('strength' => -20));
    }

	public function mainComp(Champion $enemy)
    {
        $dmg = $this->computed_abilities('strength') + 10;

        $this->receive_attack(20);
        $enemy->receive_attack($dmg);
    }
    
}