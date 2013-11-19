<?php

Class Weapon extends Table {
        protected static $tableName = "weapons";
        function __construct( array $fields) {
            $this->fillable = array('id','name', 'health_bonus', 'strength_bonus', 'intelligence_bonus', 'mana_bonus' );
            if (isset($fields['name'])) $this->fields['name']['value'] = $fields['name'];
            parent::__construct($fields);
        }
}