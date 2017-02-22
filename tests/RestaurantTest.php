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

        // function test_saveAndGetAll()
        // {
        //     $restaurant_name = "Matador";
        //     $new_restaurant = new Restaurant($restaurant_name);
        //     $new_restaurant->save();
        //
        //     $restaurant_name2 = "Sivalai Thai";
        //     $new_restaurant2 = new Restaurant($restaurant_name2);
        //     $new_restaurant2->save();
        //
        //     $result = Restaurant::getAll();
        //
        //     $this->assertEquals([$new_restaurant, $new_restaurant2], $result);
        // }





    }





?>
