<?php
    class Cuisine
    {
        private $id;
        private $cuisine_name;

        function __construct($cuisine_name, $id = null)
        {
            $this->cuisine_name = $cuisine_name;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getCuisineName()
        {
            return $this->cuisine_name;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cuisines (cuisine_name) VALUES ('{$this->getCuisineName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT FROM cuisines ORDER BY cuisine_name;");
            $all_cuisines = array();
            foreach ($returned_cuisines as $cuisine) {
                $cuisine_name = $cuisine['cuisine_name'];
                $id = $cuisine['id'];
                $new_cuisine = new Cuisine($cuisine_name, $id);
                array_push($all_cuisines, $new_cuisine);
            }
            return $all_cuisines;
        }
    }









?>
