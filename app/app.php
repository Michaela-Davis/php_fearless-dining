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

    return $app;
?>
