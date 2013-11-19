<?php

abstract class Table
{
    protected static $tableName;
    protected $primaryKey = 'id';
    protected $collections = array();
    protected $fields = array();
    protected $fillable = array();
    protected $relation = array();

    public function __construct(Array $fields = array())
    {
        if (!empty(static::$tableName))
            $this->detectFields();
        else
            die('Table: table name is required');

        foreach ($fields as $field => $value) {
            if (in_array($field,$this->fillable)) $this->fields[$field]['value'] = $value;
            else $error[$field]['error'] = "Unauthorized field : ".$field;

        }

        return $fields;

    }

    public function fill (array $fields) {
        foreach ($fields as $key => $field) {
            $this->fields[$key]['value'] = $field;
        }
    }

    public function __set($name, $value)
    {
        if (in_array($name, $this->fillable)) $this->fields[$name]['value'] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->fields) && !empty($this->fields[$name]['value'])) return $this->fields[$name]['value'];

        return NULL;
    }

    private function count_save_field() {
        $count = 0;
        foreach ($this->fields as $field) {
            if (isset($field['value'])) $count++;
        }
        return $count;
    }

    private function detectFields()
    {
        $data = myFetchAllAssoc("SHOW COLUMNS FROM `".static::$tableName."`");

        foreach($data AS $field)
        {
            $this->fields[$field['Field']] = $field;


            if($field['Key'] == 'PRI')
            {
                $this->primaryKey = $field['Field'];
            }
        }
    }

    public function delete($params=NULL)
    {
        if ($params == NULL) {
            $params = array("key" => "id", "value" => $this->$primaryKey, "tableName" => static::$tableName);
        }

        $query = "DELETE FROM `".$params['tableName']."` WHERE `".$params['key']."` = '".$params['value']."'";
        myQuery($query);
    }

    public function save()
    {
        $pk = $this->primaryKey;

        if(!empty($this->fields[$pk]['value'])) // UPDATE
        {
            $nbFields = $this->count_save_field($this->fields);

            $counter = 0;

            $query = "UPDATE `".static::$tableName."` SET";

            foreach($this->fields AS $field)
            {
                if (isset($field['value'])) {
                    $query .= " `".$field['Field']."` = '".myEscape($field['value'])."'";

                    if($counter < ($nbFields - 1))
                    {
                        $query .= ",";
                    }

                    $counter++;
                }
            }

            $query .= "WHERE `".$pk."` = '".intval($this->fields[$pk]['value'])."'";
            myQuery($query);
        }
        else // INSERT
        {
            $nbFields = $this->count_save_field($this->fields);
            $counter = 0;

            $query = "INSERT INTO `".static::$tableName."` (";

            foreach($this->fields AS $field)
            {
                if (isset($field['value'])) {
                    $query .= $field['Field'];

                    if($counter < ($nbFields - 1))
                    {
                        $query .= ',';
                    }

                    $counter++;
                }
            }

            $query .= ") VALUES (";

            $counter = 0;

            foreach($this->fields AS $field)
            {
                if (isset($field['value'])) {
                    $query .="'".myEscape($field['value'])."'";

                    if($counter < ($nbFields -1))
                    {
                        $query .= ",";
                    }

                    $counter++;
                }
            }
            $query .= ")";
            myQuery($query);
            $insert_id = myLastInsertId();
            $this->fields[$pk]['value']= $insert_id;
        }
    }

    public function hydrate( array $unique = NULL)
    {
        if (empty($this->fields[$this->primaryKey]['value']))
            die (get_called_class().': cannot hydrate without primary key value');
        if ($unique !== NULL) {
            foreach ($unique as $key => $value) {
                $field = $key;
                $val = $value;
            }
        }
        else {
            $key = $this->primaryKey;
            $val = intval($this->fields[$this->primaryKey]['value']);
        }
        $q = "SELECT * FROM `".static::$tableName."` WHERE `".$field."` = "."'".$val."'";
        $data = myFetchAssoc($q);

        foreach ($this->fields as $field)
        {
            $this->fields[$field['Field']]['value'] = $data[$field['Field']];

        }

        return $this;
    }

    public function with($relation) {

            if ($this->have_relations($relation) === TRUE) {
                if (strpos($this->relation[$relation], "id_".$relation) === 0) {
                    $key = $relation."_id";
                    $class = $relation;
                    $instance = new $class;
                    $class->primaryKey = $key;
                    $class->hydrate();
                    $this->fields[$field['Field']]['value'][] = $instance;
                }
                elseif (strpos($this->relation[$relation], $relation."_has_".static::$tableName) === 0) {
                    $this->collections[$relation] = $this->collection($this->relation[$relation]['table']);

                }
            }

    }


    private function collection($table) {

        $rel_table = substr($table, 0, strpos($table, "_"));
        $rel_table = substr($table,0,-1);
        $q = "SELECT id  FROM ".$table."WHERE ".$field." = ".$this->fields[$this->primaryKey]['value'];
        $data = myFetchAllAssoc($q);
        $collection = array();
        foreach ($data as $field) {
            $instance = new $rel_table;
            $instance->$primaryKey = $field;
            $instance->hydrate();
            $collection[] = $instance;
        }
        return $collection;
    }
    private function have_relations($field) {
        return in_array($field, $this->relation);
    }

    public static function Find($unique) {
        if (is_array($unique)) {
            foreach ($unique as $field => $value) {
                $key = $field;
                $val = $value;
            }
        }
        else {
            $key = "id";
            $val = $unique;
        }
        $q = "SELECT * FROM ".static::$tableName." WHERE ". $key ." = '". $val . "'";
        $data = myFetchAssoc($q);
        if ($data == NULL) return NULL;
        $class = substr(static::$tableName, 0 , -1);
        $instance = new $class($data);
        return $instance;

    }

    public function add_collection(Table $instance, $col) {
        $this->collections[$col][] = $instance;
    }

    public function save_collections($col) {

            if ( $collec = $this->collections[$col]) {
                //var_dump($this->relations);
                if (empty($this->fields[$this->primaryKey]['value'])) $this->save();
                $pivot = $this->relation[$col];
                $fk = substr($pivot, strrpos($pivot,"_"),strlen($pivot));
                $fk = substr($fk,0,-1);
                $fk_col = substr($col, 0, -1);
                foreach ($collec as $c) {
                    if (empty($c->{$c->primaryKey})) $c->save();
                    $q = "INSERT INTO ".$pivot." (id_".$fk_col.", id".$fk.") VALUES (".$c->{$c->primaryKey}." , ".$this->fields[$this->primaryKey]['value'].")";
                    myQuery($q);

                }
            }
    }

    public function  get_collection($col) {
        if (isset($this->collections[$col])) return $this->collections[$col];
        return NULL;
    }

}
