<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 5/02/17
 * Time: 19:11
 */
use app\controller\GameController;
use app\controller\UserController;
use app\controller\ManagementController;
use Slim\Middleware\JwtAuthentication;
\Firebase\JWT\JWT::$leeway = 5;
//SECRET for testing purposes
$app->add(new JwtAuthentication([
    "secret"=>"papo",
    "path"=>['/places','/destinations'],
    "secure" => false,
    "passthrough" => ['/user/login'],
    "error" => function ($request, $response, $arguments) {
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
]))->add('CORS');

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
})->add('CORS');

/**
 * @apiGroup Users
 * @apiName Register
 * @apiVersion 0.1.0
 *
 * @api {post} /user/register  Crée une ressource de type utilisateur
 *
 * @apiDescription Crée d'une ressource de type user.<br/>
 * Retourne cette ressource, incluant son id, last_name, first_name, username et password
 *
 *
 * @apiSuccess (Succès : 200) {id} Identifiant de l'utilisateur
 * @apiSuccess (Succès : 200) {first_name} Prénom de l'utilisateur
 * @apiSuccess (Succès : 200) {last_name} Nom de l'utilisateur
 * @apiSuccess (Succès : 200) {username} Username de l'utilisateur
 * @apiSuccess (Succès : 200) {password} Mot de passe de l'utilisateur
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        user : {
 *            "last_name"  : "Nom" ,
 *            "first_name" : "PRénom",
 *            "username" : "user1",
 *            "password" : "$2y$10$30Z9Pdft7rzJqHWlYhcA2Oaf92YCPqjQuRgsxukULVK5D5aNzYNlq"
 *        }
 *     }
 *
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 400
 *
 */

 /**
 * @apiGroup Users
 * @apiName Login
 * @apiVersion 0.1.0
 *
 * @api {post} /user/login  Authentifie un utilisateur
 *
 * @apiDescription Authentifie un utilisateur.<br/>
 * Retourne un objet data, incluant le username, first_name, last_name de l'utilisateur ainsi qu'un token
 *
 * @apiSuccess (Succès : 200) {first_name} Prénom de l'utilisateur
 * @apiSuccess (Succès : 200) {last_name} Nom de l'utilisateur
 * @apiSuccess (Succès : 200) {username} Username de l'utilisateur
 * @apiSuccess (Succès : 200) {token} token d'authentification
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        user : {
 *            "last_name"  : "Nom" ,
 *            "first_name" : "PRénom",
 *            "username" : "user1",
 *            "token" : "$2y$10$30Z9Pdft7rzJqHWlYhcA2Oaf92YCsdfhDFds455SDs2481Sd21361sDSsdsqAsq"
 *        }
 *     }
 *
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 401 Incorrect Username or Password
 *
 */

$app->group('/user', function (){

    $this->post('/register', UserController::class. ':register')->setName('register');

    $this->post('/login', UserController::class. ':login')->setName('login');

});

/**
 * @apiGroup Places
 * @apiName GetPlaces
 * @apiVersion 0.1.0
 *
 * @api {get} /places Accès à une table de ressources de type place
 *
 * @apiDescription Accès à une table de ressources de type place.<br/>
 * Retourne cette table, incluant un ensemble de ressources de type place avec leurs id,
 * last_name, first_name, username et password.
 *
 *
 *
 * @apiSuccess (Succès : 200) {Object[]} table Table de ressources de type place
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *          "0" => {
 *              place : {
 *                  "id"  : 1 ,
 *                  "name"  : "Paris",
 *                  "lng"   : 2.287592000000018,
 *                  "lat"   : 48.862725
 *                  "type_indication" : "text",
 *                  "indication" : "La ville lumière"
 *              }
 *          },
 *          "1" => {
 *              place : {
 *                  "id"  : 2 ,
 *                  "name"  : "Metz",
 *                  "lng"   : 6.1757155999999895,
 *                  "lat"   : 49.1193089,
 *                  "type_indication" : "text",
 *                  "indication" : "Ancienne capitale de la Lorraine"
 *              }
 *          },
 *        
 *     }
 */

 /**
 * @apiGroup Places
 * @apiName AddPlaces
 * @apiVersion 0.1.0
 *
 * @api {post} /places Crée une ressource de type place
 * @apiPermission admin
 *
 * @apiDescription Crée une ressource de type place.<br/>
 * Retourne cette ressource incluant son id, name, lng, lat, type_indication et indication.
 *
 *
 * @apiSuccess (Succès : 200) {Object} place Ressource de type place
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *      {
 *          place : {
 *              "id"  : 1 ,
 *              "name"  : "Paris",
 *              "lng"   : 2.287592000000018,
 *              "lat"   : 48.862725
 *              "type_indication" : "text",
 *              "indication" : "La ville lumière"
 *          }     
 *     }
 */

/**
 * @apiGroup Places
 * @apiName UpdatePlace
 * @apiVersion 0.1.0
 *
 * @api {patch} /places/:id Modifie une ressource de type place
 * @apiPermission admin
 *
 * @apiDescription Modifie une ressource de type place.<br/>
 * Retourne cette ressource, incluant son id, name, lng, lat, type_indication et indication.
 *
 *
 * @apiSuccess (Succès : 200) {Object} place Ressource de type place
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *      {
 *          place : {
 *              "id"  : 1 ,
 *              "name"  : "Paris",
 *              "lng"   : 2.287592000000018,
 *              "lat"   : 48.862725
 *              "type_indication" : "text",
 *              "indication" : "La ville lumière"
 *          }     
 *     }
 */

$app->group('/places', function (){

    $this->get('', ManagementController::class. ':getListePlaces')->setName('listPlaces');

    $this->put('/{id}', ManagementController::class. ':editPlace');

    $this->post('[/]', ManagementController::class. ':addPlace');
    
});

/**
 * @apiGroup Destinations
 * @apiName GetDestinations
 * @apiVersion 0.1.0
 *
 * @api {get} /destinations Accès à une table de ressources de type destination
 *
 * @apiDescription Accès à une table de ressources de type destination.<br/>
 * Retourne cette table, incluant un ensemble de ressources de type place avec leurs id,
 * name, lng, lat.
 *
 *
 *
 * @apiSuccess (Succès : 200) {Object[]} table Table de ressources de type destination
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *          "0" => {
 *              destination : {
 *                  "id"  : 1 ,
 *                  "name"  : "Toulouse",
 *                  "lng"   : "1.450488",
 *                  "lat"   : "43.607489"
 *              }
 *          },
 *          "1" => {
 *              destination : {
 *                  "id"  : 2 ,
 *                  "name"  : "Le Havre",
 *                  "lng"   :"0.121646",
 *                  "lat"   : "49.527592"
 *              }
 *          },
 *        
 *     }
 */

 /**
 * @apiGroup Destinations
 * @apiName AddDestination
 * @apiVersion 0.1.0
 *
 * @api {post} /destinations Crée une ressource de type destination
 * @apiPermission admin
 *
 * @apiDescription Crée une ressource de type destination.<br/>
 * Retourne cette ressource incluant son id, name, lng, lat.
 *
 *
 * @apiSuccess (Succès : 200) {Object} destination Ressource de type destination
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *      {
 *          destination : {
 *              "id"  : 1 ,
 *              "name"  : "Toulouse",
 *              "lng"   : "1.450488",
 *              "lat"   : "43.607489"
 *          }     
 *     }
 */

/**
 * @apiGroup Destinations
 * @apiName UpdateDestination
 * @apiVersion 0.1.0
 *
 * @api {put} /destinations/:id Modifie une ressource de type destination
 * @apiPermission admin
 *
 * @apiDescription Modifie une ressource de type destination.<br/>
 * Retourne cette ressource, incluant son id, name, lng, lat.
 *
 *
 * @apiSuccess (Succès : 200) {Object} destination Ressource de type destination
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *   {
 *          destination : {
 *              "id"  : 1 ,
 *              "name"  : "Toulouse",
 *              "lng"   : "1.4504880014",
 *              "lat"   : "43.6074896589"
 *          }     
 *     }
 */

 /**
 * @apiGroup Hints
 * @apiName GetHints
 * @apiVersion 0.1.0
 *
 * @api {get} /destinations/:id/hints Accès à une table de ressources de type hint d'une destination désignée
 *
 * @apiDescription Accès à une table de ressources de type hint.<br/>
 * Retourne cette table, incluant un ensemble de ressources de type hint avec leurs id, value, type et id_destination.
 *
 *
 *
 * @apiSuccess (Succès : 200) {Object[]} table Table de ressources de type hint
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *          "0" => {
 *              hint : {
 *                  "id"  : 1 ,
 *                  "value"  : "Commune du du Sud-Ouest de France",
 *                  "type"   : "text",
 *                  "id_destination"   : 1
 *              }
 *          },
 *          "1" => {
 *              hint : {
 *                  "id"  : 2 ,
 *                  "value"  : "Basilique Saint-Sernin",
 *                  "type"   :"text",
 *                  "id_destination"   : 1
 *              }
 *          },
 *        
 *     }
 */

 /**
 * @apiGroup Hints
 * @apiName AddHint
 * @apiVersion 0.1.0
 *
 * @api {post} /destinations/:id_dest/hints Crée une ressource de type hint d'une destination désignée
 * @apiPermission admin
 *
 * @apiDescription Crée une ressource de type hint d'une destination désignée.<br/>
 * Retourne cette ressource incluant son id, value, type et id_destination.
 *
 *
 * @apiSuccess (Succès : 200) {Object} hint Ressource de type hint
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *      {
 *          hint : {
 *              "id"  : 3 ,
 *              "value"  : "Université Paul Sabatier",
 *              "type"   : "text",
 *              "id_destination"   : 2
 *          }     
 *     }
 */

/**
 * @apiGroup Hints
 * @apiName UpdateHint
 * @apiVersion 0.1.0
 *
 * @api {put} /destinations/:id_dest/hints/:id Modifie une ressource de type hint d'une destination désignée
 * @apiPermission admin
 *
 * @apiDescription Modifie une ressource de type hint d'une destination désignée.<br/>
 * Retourne cette ressource, incluant son id, value, type et id_destination.
 *
 *
 * @apiSuccess (Succès : 200) {Object} hint Ressource de type hint
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *   {
 *          hint : {
 *              "id"  : 3 ,
 *              "name"  : "L'Université Paul Sabatier",
 *              "type"   : "text",
 *              "id_destination"   : 2
 *          }     
 *     }
 */

 /**
 * @apiGroup Hints
 * @apiName DeleteHint
 * @apiVersion 0.1.0
 *
 * @api {delete} /destinations/:id_dest/hints/:id Supprime une ressource de type hint d'une destination désignée
 * @apiPermission admin
 *
 * @apiDescription Supprime une ressource de type hint d'une destination désignée.<br/>
 *
 *
 * @apiSuccess (Succès : 200) {Object} hint Ressource de type hint
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 Ressource deleted
 *
 *  
 */


$app->group('/destinations', function (){

    $this->get('', ManagementController::class. ':getDestinations')->setName('destinations');
    $this->get('/{id}/hints', ManagementController::class. ':getHints')->setName('hints');
    $this->post('/{id_dest}/hints', ManagementController::class. ':addHint');
    $this->put('/{id_dest}/hints/{id}', ManagementController::class. ':editHint');
    $this->delete('/{id_dest}/hints/{id}', ManagementController::class. ':deleteHint');
    $this->post('', ManagementController::class. ':createDestination')->setName('createDestination');
    $this->put('/{id}', ManagementController::class. ':updateDestination')->setName('updateDestination');

});

/**
 * @apiGroup Levels
 * @apiName GetLevels
 * @apiVersion 0.1.0
 *
 * @api {get} /levels Accès à une table de ressources de type level
 *
 * @apiDescription Accès à une table de ressources de type level.<br/>
 * Retourne cette table, incluant un ensemble de ressources de type level avec leurs id, max_attempts, time et name.
 *
 *
 *
 * @apiSuccess (Succès : 200) {Object[]} table Table de ressources de type level
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *          "0" => {
 *              level : {
 *                  "id"  : 1 ,
 *                  "max_attempts"  : "100",
 *                  "time"   : "1000",
 *                  "name"   : "Easy"
 *                  "type_indication" : "text"
 *              }
 *          },
 *          "1" => {
 *              level : {
 *                  "id"  : 2 ,
 *                  "max_attempts"  : "80",
 *                  "time"   : 800,
 *                  "name"   : 49.Intermediate,
 *                  "type_indication" : "Intermediate"
 *              }
 *          },
 *        
 *     }
 */

/**
 * @apiGroup Levels
 * @apiName UpdateLevel
 * @apiVersion 0.1.0
 *
 * @api {put} /levels/:id Modifie une ressources de type level
 * @apiPermission admin
 *
 * @apiDescription Modifie une ressources de type place.<br/>
 * Retourne cette ressources, incluant son id, name, lng, lat, type_indication et indication.
 *
 *
 * @apiSuccess (Succès : 200) {Object} place Ressource de type level
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *      {
 *          level : {
 *              "id"  : 1 ,
 *              "max_attempts"  : "100",
 *              "time"   : "1000",
 *              "name"   : "Easy"
 *              "type_indication" : "text"
 *          }     
 *     }
 */

$app->group('/levels', function (){

    $this->put('/{id}', ManagementController::class. ':updateLevel')->setName('updateLevel');

    $this->get('', UserController::class. ':getLevels')->setName('levels');

});

/**
 * @apiGroup Games
 * @apiName AddGame
 * @apiVersion 0.1.0
 *
 * @api {post} /game/play Crée une ressource de type game
 *
 * @apiDescription Crée une ressource de type game.<br/>
 * Retourne cette ressource incluant son id, pseudo, token, score, state, duration, id_level, id_destination.
 *
 *
 * @apiSuccess (Succès : 200) {Object} game Ressource de type game
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *      {
 *          game : {
 *              "id"  : 1 ,
 *              "pseudo"    : "Player 1",
 *              "token"     : "y3vt39hpa8n69ocu5wpmspqm4lpu6gmk",
 *              "score"     : NULL,
 *              "state"     : 0,
 *              "duration"  : NULL,
 *              "id_level"  : 1,
 *              "id_destination" : 2
 *          }     
 *     }
 */

/**
 * @apiGroup Games
 * @apiName GetGamesRankings
 * @apiVersion 0.1.0
 *
 * @api {get} /game/ranking Accès à une table de ressources de type game
 *
 * @apiDescription Accès à une table de ressources de type game.<br/>
 * Retourne cette table, incluant un ensemble de ressources de type game avec leurs
 * pseudo, duration, score, state, id_level, id_destination.
 *
 *
 *
 * @apiSuccess (Succès : 200) {Object[]} table Table de ressources de type game
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *          "0" => {
 *              game : {
 *                  "id"  : 1 ,
 *                  "pseudo"    : "Player 1",
 *                  "token"     : "y3vt39hpa8n69ocu5wpmspqm4lpu6gmk",
 *                  "score"     : "8",
 *                  "state"     : 0,
 *                  "duration"  : "60",
 *                  "id_level"  : 1,
 *                  "id_destination" : 2
 *              }   
 *          },
 *          "1" => {
 *              game : {
 *                  "id"  : 2 ,
 *                  "pseudo"    : "Player 1",
 *                  "token"     : "y3vt39hpa8n69ocu5wpmspqm4lpu6gmk",
 *                  "score"     : "6",
 *                  "state"     : 0,
 *                  "duration"  : "103",
 *                  "id_level"  : 1,
 *                  "id_destination" : 2
 *              }   
 *          },
 *        
 *     }
 */

/**
 * @apiGroup Games
 * @apiName UpdateGame
 * @apiVersion 0.1.0
 *
 * @api {put} /games/:id/save Modifie une ressources de type game
 *
 * @apiDescription Modifie une ressource de type game.<br/>
 * Retourne cette ressource, incluant son son id, pseudo, token, score, state, duration, id_level, id_destination.
 *
 *
 * @apiSuccess (Succès : 200) {Object} game Ressource de type game
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *      {
 *          game : {
 *              "id"  : 1 ,
 *              "pseudo"    : "Player 1",
 *              "token"     : "y3vt39hpa8n69ocu5wpmspqm4lpu6gmk",
 *              "score"     : "9",
 *              "state"     : 0,
 *              "duration"  : "120",
 *              "id_level"  : 1,
 *              "id_destination" : 2
 *          }   
 *     }
 */

$app->group('/game', function () {

    $this->put('/{id}/save', GameController::class. ':save')->setName('saveGame');

    $this->get('/ranking', GameController::class. ':ranking')->setName('ranking');
    $this->post('/play', GameController::class. ':playGame')->setName('playgame');

});



