<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=fearless_dining';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
    ));

    $app['debug'] = true;

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/home", function() use ($app) {
        return $app['twig']->render('homeView.html.twig', array('cuisines'=> Cuisine::getAll()));
    });

    $app->post("/add-cuisine", function() use ($app) {
        $new_cuisine = new Cuisine($_POST['name']);
        $new_cuisine->save();

        return $app['twig']->render('homeView.html.twig', array('cuisines'=> Cuisine::getAll()));
    });

    $app->get("cuisines/{id}", function($id) use ($app) {
        $search_cuisine = Cuisine::findCuisine($id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $search_cuisine, 'restaurants' => $search_cuisine->getRestaurants()));
    });

    $app->post("/add-restaurant", function() use ($app) {
        $new_restaurant = new Restaurant($_POST['name'], $_POST['address'], $_POST['keywords'], $_POST['cuisine_id']);
        $new_restaurant->save();
        $cuisine = Cuisine::findCuisine($_POST['cuisine_id']);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->get("/restaurants/{id}", function($id) use ($app) {
        $search_restaurant = Restaurant::findRestaurant($id);
        return $app['twig']->render('restaurant.html.twig', array('restaurant' => $search_restaurant));
    });

    return $app;
?>
