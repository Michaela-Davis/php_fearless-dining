<?php
    class Restaurant
    {
        private $restaurant_name;
        private $address;
        private $keywords;
        private $cuisine_id;
        private $id;

        function __construct($restaurant_name, $address, $keywords, $cuisine_id, $id = null)
        {
            $this->restaurant_name = $restaurant_name;
            $this->address = $address;
            $this->keywords = $keywords;
            $this->cuisine_id = $cuisine_id;
            $this->id = $id;
        }

        function getRestaurantName()
        {
            return $this->restaurant_name;
        }

        function getAddress()
        {
            return $this->address;
        }

        function getKeywords()
        {
            return $this->keywords;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function getRestaurantId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, address, keywords, cuisine_id) VALUES ('{$this->getRestaurantName()}', '{$this->getAddress()}', '{$this->getKeywords()}', {$this->getCuisineId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants ORDER BY name;");
            $all_restaurants = array();
            foreach($returned_restaurants as $restaurant) {
                $restaurant_name = $restaurant['name'];
                $address = $restaurant['address'];
                $keywords = $restaurant['keywords'];
                $cuisine_id = $restaurant['cuisine_id'];
                $id = $restaurant['id'];
                $new_restaurant = new Restaurant($restaurant_name, $address, $keywords, $cuisine_id, $id);
                array_push($all_restaurants, $new_restaurant);
            }
            return $all_restaurants;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }


    }








?>
