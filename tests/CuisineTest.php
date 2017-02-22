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
    }





?>
