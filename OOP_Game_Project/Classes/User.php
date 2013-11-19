<?php
Class User extends Table {
    protected static $tableName = 'users';
    public function __construct(Array $fields) {
        $this->relation = array('champions' => 'champions_has_users');
        $this->fillable = array('id','pseudo');

        parent::__construct($fields);
    }

    public function add_champion(Champion $champ) {
        $this->collections['champions'][] = $champ;
    }

    public function with($relation) {
        if ($relation !== 'champions') {
            parent::with($relation);
        }
        else {
            $q = "SELECT id_champion FROM champions_has_users WHERE id_user = ".$this->fields[$this->primaryKey]['value'];
            $data = myFetchAllAssoc($q);
            foreach ($data as $field) {
                $q = "SELECT * FROM champions WHERE id = ".$field['id_champion'];
                $data = myFetchAssoc($q);
                $instance = new $data['classe'];
                $instance->fill($data);
                $this->collections['champions'][] = $instance;
            }
        }
    }
}