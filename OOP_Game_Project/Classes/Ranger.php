<?php

	class Ranger extends Champion {
	    function __construct( )
	    {
	        parent::__construct(array('strength' => 0, 'intelligence' => -50, 'health' => 0));
	        $this->fill(array('name' => 'Ash'));
       	 	$this->fill(array('classe' => 'Ranger'));
	        $this->save();
	        $this->add_weapons(new Weapon(array('name' => 'Bow of sacrifice', 'strength_bonus' => 20)));
	        $this->save_collections('weapons');
	    }

	    public function secondaryComp(Champion $enemy)
	    {
	        $this->fields['strengh']['value'] += 20;
	        $dmg = $this->computed_abilities('strength');
	        $enemy->receive_attack($dmg);
	    }

		public function mainComp(Champion $enemy)
	    {
	        $dmg = $this->computed_abilities('strength') + floor($this->fields['strengh']['value']/6);

	        $this->receive_attack(50);
	        $enemy->receive_attack($dmg);
	    }
	}