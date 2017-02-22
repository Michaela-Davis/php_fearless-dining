<?php
    class Restaurant
    {
        private $restaurant_id;
        private $restaurant_name;
        private $address;
        private $keywords;
        private $cuisine_id;

        function __construct($restaurant_name, $address, $keywords, $cuisine_id, $restaurant_id = null)
        {
            $this->restaurant_name = $restaurant_name;
            $this->address = $address;
            $this->keywords = $keywords;
            $this->cuisine_id = $cuisine_id;
            $this->restaurant_id = $restaurant_id;
        }

        function getRestaurantId()
        {
            return $this->restaurant_id;
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

        
    }








?>
