<?php
Class Tank extends Champion {

    function __construct( )
    {
        parent::__construct(array('strength' => -60, 'intelligence' => 0, 'health' => +450));
        $this->fill(array('name' => 'Alistar'));
        $this->fill(array('classe' => 'Tank'));
        $this->save();
        $this->add_weapons(new Weapon(array('name' => 'Shield of concrete','health_bonus' => 10)));
        $this->save_collections('weapons');
    }

    public function secondaryComp(Champion $enemy)
    {
        $this->fields['strength']['value'] += 20;
        $dmg = $this->computed_abilities('strength');
        $enemy->receive_attack($dmg);
    }

	public function mainComp(Champion $enemy)
    {
        $dmg = $this->computed_abilities('strength') + floor($this->fields['strength']['value']/6);

        $this->receive_attack(20);
        $enemy->receive_attack($dmg);
    }

}