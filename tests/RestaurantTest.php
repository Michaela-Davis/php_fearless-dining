<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost:8889;dbname=fearless_dining_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_saveAndGetAll()
        {
            $restaurant_name = "Matador";
            $address = "1234 N Peach Lane, Portland OR";
            $keywords = "yummy, cheap, spicy";
            $cuisine_id = 1;
            $new_restaurant = new Restaurant($restaurant_name, $address, $keywords, $cuisine_id);
            $new_restaurant->save();

            $restaurant_name2 = "Sivalai Thai";
            $address2 = "5678 W Bark Road, Portland OR";
            $keywords2 = "pricy, friendly";
            $cuisine_id2 = 2;
            $new_restaurant2 = new Restaurant($restaurant_name2, $address2, $keywords2, $cuisine_id2);
            $new_restaurant2->save();

            $result = Restaurant::getAll();

            $this->assertEquals([$new_restaurant, $new_restaurant2], $result);
        }

        function test_findRestaurant()
        {
            $restaurant_name = "Matador";
            $address = "1234 N Peach Lane, Portland OR";
            $keywords = "yummy, cheap, spicy";
            $cuisine_id = 1;
            $new_restaurant = new Restaurant($restaurant_name, $address, $keywords, $cuisine_id);
            $new_restaurant->save();

            $restaurant_name2 = "Sivalai Thai";
            $address2 = "5678 W Bark Road, Portland OR";
            $keywords2 = "pricy, friendly";
            $cuisine_id2 = 2;
            $new_restaurant2 = new Restaurant($restaurant_name2, $address2, $keywords2, $cuisine_id2);
            $new_restaurant2->save();

            /// Act   ///
            $result = Restaurant::findRestaurant($new_restaurant->getId());

            /// Assert ///
            $this->assertEquals($new_restaurant, $result);
        }







    }





?>
