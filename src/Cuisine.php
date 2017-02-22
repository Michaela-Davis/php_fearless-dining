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
    }









?>
