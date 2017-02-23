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

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

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

    $app->get("/cuisines/{id}", function($id) use ($app) {
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

    $app->get("/cuisines/{id}/edit", function($id) use ($app) {
        $cuisine = Cuisine::findCuisine($id);
        return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $cuisine));
    });

    $app->post("/cuisines/{id}/edit", function($id) use ($app) {
        $cuisine = Cuisine::findCuisine($id);
        return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $cuisine));
    });

    $app->patch("/cuisines/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $this_cuisine = Cuisine::findCuisine($id);
        $this_cuisine->updateCuisine($name);
        return $app['twig']->render('homeView.html.twig', array('cuisine' => $this_cuisine, 'cuisines' => Cuisine::getAll()));
    });

    $app->delete("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::findCuisine($id);
        $cuisine->deleteCuisine();
        return $app['twig']->render('homeView.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/restaurants/{id}/edit", function($id) use ($app) {
        $restaurant = Restaurant::findRestaurant($id);
        $cuisine = Cuisine::findCuisine($id);
        return $app['twig']->render('restaurant_edit.html.twig', array('restaurant' => $restaurant, 'cuisine' => $cuisine));
    });

    $app->post("/restaurants/{id}/edit", function($id) use ($app) {
        $restaurant = Restaurant::findRestaurant($id);
        return $app['twig']->render('restaurant_edit.html.twig', array('restaurant' => $restaurant));
    });

    $app->patch("/restaurants/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $keywords = $_POST['keywords'];
        $this_restaurant = Restaurant::findRestaurant($id);
        $this_restaurant->updateRestaurant($name, $address, $keywords);
        $cuisine = Cuisine::findCuisine($this_restaurant->getCuisineId());
        return $app['twig']->render('cuisine.html.twig', array('restaurant' => $this_restaurant, 'restaurants' => $cuisine->getRestaurants(), 'cuisine' => $cuisine));
    });

    $app->delete("/restaurants/{id}", function($id) use ($app) {
        $restaurant = Restaurant::findRestaurant($id);
        $restaurant_cuisine_id = $restaurant->getCuisineId();
        $cuisine = Cuisine::findCuisine($restaurant_cuisine_id);
        $restaurant->deleteRestaurant();
        return $app['twig']->render('cuisine.html.twig', array('restaurants' => $cuisine->getRestaurants(), 'cuisine' => $cuisine));
    });

    return $app;
?>
