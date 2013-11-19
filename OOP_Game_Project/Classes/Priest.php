<?php

	class Priest extends Champion {
	    function __construct( )
	    {
	        parent::__construct(array('strength' => -10, 'intelligence' => 0, 'health' => 0));
	        $this->fill(array('name' => 'Rosho'));
        	$this->fill(array('classe' => 'Priest'));
	        $this->save();
	        $this->add_weapons(new Weapon(array('name' => "Queen's staff", 'intelligence_bonus' => 20)));
	        $this->save_collections('weapons');
	    }

	    public function secondaryComp(Champion $enemy)
	    {
	        $this->fields['intelligence']['value'] += 20;
	        $dmg = $this->computed_abilities('strength');
	        $enemy->receive_attack($dmg);
	    }

		public function mainComp(Champion $enemy)
	    {
	        $dmg = $this->computed_abilities('intelligence') + floor($this->fields['intelligence']['value']/6);

	        $this->receive_attack(50);
	        $enemy->receive_attack($dmg);
	    }
	}