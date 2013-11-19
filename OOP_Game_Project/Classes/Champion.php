<?php

abstract class Champion extends Table {
    public static $class = array('Wizard' , 'Warrior' , 'Tank' , 'Priest' , 'Ranger');
    protected $error = array();
    protected $protect = FALSE;
    protected $buff = array();
    protected static $tableName = 'champions';
    public function __construct( array $fields ) {

        $this->relation = array('weapons' => 'weapons_has_champions');
        $this->fillable = array('id', 'name', 'health', 'strength', 'intelligence', 'classe');

        $param = array_map(function($n, $m){return $n+$m;}, $fields, array('strength' => 100, 'intelligence' => 100, 'health' => 500));
        $param = array_combine(array_keys($fields), $param);
        return parent::__construct($param);

    }



    public function add_weapons(Weapon $weapon) {
       $this->collections['weapons'][] = $weapon;
        if (!isset($weapon->id)) $weapon->save();


    }

    public function computed_abilities($abilities) {
        if (!empty($this->fields[$abilities]['value'])) {
            $computed_val = $this->fields[$abilities]['value'];
            if (!empty($this->collections['weapons'])) {
                foreach ($this->collections['weapons'] as $weapon){
                    $computed_val += $weapon->$abilities."_bonus";
                }

            }
            if (!empty($this->buff[$abilities])) $computed_val += $this->buff[$abilities];
            if (!empty($this->debuff[$abilities])) $computed_val += $this->debuff[$abilities];
            return (int) $computed_val;
        }
        else {
            die('No value for this abitlites');
        }
    }


    public function add_buff(array $fields) {
       $this->buff = array_merge($this->buff, $fields);
        foreach ($this->buff as $field => $buf) {
            $this->fields[$field]['value'] = $buf;
        }
    }

    public function get_buff ($abilities) {
        return (isset($this->buff[$abilities]) ? $this->buff[$abilities] : 0);
    }
    public function attack(Champion $ennemy) {
        $damages = $this->computed_abilities('strength');
        $ennemy->receive_attack($damages);
    }

    public function protection() {
        $this->protect = TRUE;
    }

    public function no_protection() {
        $this->protect = FALSE;
    }
    public function receive_attack($damage) {
        if ($this->protect) {
            $this->fields['health']['value'] = floor($damage * ((100-75) / 100));
        }
        else {
            $this->fields['health']['value'] = $this->fields['health']['value'] - $damage;
        }
    }

    public function heal() {
        $intel = $this->computed_abilities('intelligence')  ;
        $this->fields['health']['value'] += $intel;
    }

    public function deleteChampion() {
        $this->delete(array("tableName" => "weapons_has_champions", "key" => "id_champion", "value" => $this->{$this->primaryKey}));
        $this->delete(array("tableName" => "champions_has_users", "key" => "id_champion", "value" => $this->{$this->primaryKey}));
        $this->delete(array("tableName" => "champions", "key" => "id", "value" => $this->{$this->primaryKey}));
    }

    public function setName($name){}
    public function setStrengh($strengh){}
    public function setVelocity($velocity){}
    public function setIntelligence($intelligence){}
    public function setHealthPoint($hp){}
    public function setWeapon(Weapon $weapon){}
    public function setWeapons(Array $weapons){}

    public function getName(){}
    public function getStrengh(){}  // return player strengh + strengh bonuses from weapons
    public function getVelocity(){}
    public function getIntelligence(){}
    public function getHealthPoint(){}


}