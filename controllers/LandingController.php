<?php

namespace Controllers;

use MVC\Router;

class LandingController {
    public static function index(Router $router) {
        $esLandingPage = true;
        $router->render('landing', ['esLandingPage' => $esLandingPage]); // Variable que identifica si el usuario está en la landing page o no.
    }
}