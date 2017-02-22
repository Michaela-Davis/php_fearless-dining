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
            $GLOBALS['DB']->exec("INSERT INTO cuisines (name) VALUES ('{$this->getCuisineName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $all_cuisines = array();
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines ORDER BY name;");
            foreach($returned_cuisines as $cuisine) {
                $cuisine_name = $cuisine['name'];
                $id = $cuisine['id'];
                $new_cuisine = new Cuisine($cuisine_name, $id);
                array_push($all_cuisines, $new_cuisine);
            }
            return $all_cuisines;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines;");
        }

        static function findCuisine($search_id)
        {
            $found_cuisine = null;
            $all_cuisines = Cuisine::getAll();
            foreach($all_cuisines as $cuisine) {
                $found_id = $cuisine->getId();
                if ($search_id == $found_id) {
                    $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }

        function getRestaurants()
        {
            $found_restaurants = array();
            $all_restaurants = Restaurant::getAll();
            foreach($all_restaurants as $restaurant) {
                if ($restaurant->getCuisineId() == $this->getId()) {
                    array_push($found_restaurants, $restaurant);
                }
            }
            return $found_restaurants;
        }
    }

?>
