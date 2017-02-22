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

    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_saveAndGetAll()
        {
            $cuisine_name = "Mexican";
            $new_cuisine = new Cuisine($cuisine_name);
            $new_cuisine->save();

            $cuisine_name2 = "Thai";
            $new_cuisine2 = new Cuisine($cuisine_name2);
            $new_cuisine2->save();

            $result = Cuisine::getAll();

            $this->assertEquals([$new_cuisine, $new_cuisine2], $result);
        }

        function test_findCuisine()
        {
            $cuisine_name = "Mexican";
            $new_cuisine = new Cuisine($cuisine_name);
            $new_cuisine->save();

            $cuisine_name2 = "Thai";
            $new_cuisine2 = new Cuisine($cuisine_name2);
            $new_cuisine2->save();

            $result = Cuisine::findCuisine($new_cuisine->getId());

            $this->assertEquals($new_cuisine, $result);
        }

        function test_getRestaurantsByCuisine()
        {
            $cuisine_name = "Mexican";
            $new_cuisine = new Cuisine($cuisine_name);
            $new_cuisine->save();

            $restaurant_name = "Matador";
            $address = "1234 N Peach Lane, Portland OR";
            $keywords = "yummy, cheap, spicy";
            $cuisine_id = $new_cuisine->getId();
            $new_restaurant = new Restaurant($restaurant_name, $address, $keywords, $cuisine_id);
            $new_restaurant->save();

            $restaurant_name2 = "Sivalai Thai";
            $address2 = "5678 W Bark Road, Portland OR";
            $keywords2 = "pricy, friendly";
            $cuisine_id2 = 2;
            $new_restaurant2 = new Restaurant($restaurant_name2, $address2, $keywords2, $cuisine_id2);
            $new_restaurant2->save();

            $result = $new_cuisine->getRestaurants();

            $this->assertEquals([$new_restaurant], $result);
        }

        function testUpdateCuisine()
        {
            $cuisine_name = "Mexican";
            $new_cuisine = new Cuisine($cuisine_name);
            $new_cuisine->save();

            $updated_name = "South American";

            $new_cuisine->updateCuisine($updated_name);

            $this->assertEquals("South American", $new_cuisine->getCuisineName());
        }
    }





?>
