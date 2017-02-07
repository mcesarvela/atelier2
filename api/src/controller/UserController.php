<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 6/02/17
 * Time: 14:24
 */

namespace app\controller;

use app\model\User;
use Interop\Container\ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class UserController extends AbstractController
{

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response|static
     */
    public function register(Request $request, Response $response, $args){
        $data = $request->getParsedBody();
        if(!isset($data['last_name']))  return $this->json_error($response, 400, "Missing param: Last name");
        else if(!isset($data['first_name']))  return $this->json_error($response, 400, "Missing param: First name");
        else if(!isset($data['email']))  return $this->json_error($response, 400, "Missing param: Email");
        else if(!isset($data['username']))  return $this->json_error($response, 400, "Missing param: Username");
        else if(!isset($data['password']))  return $this->json_error($response, 400, "Missing param: Password");
        else{
            $user = new User();
            $user->last_name = filter_var($data['last_name'], FILTER_SANITIZE_STRING);
            $user->first_name = filter_var($data['first_name'], FILTER_SANITIZE_STRING);
            $user->email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
            $user->username = filter_var($data['username'], FILTER_SANITIZE_STRING);
            $pass = filter_var($data['password'], FILTER_SANITIZE_STRING);
            $user->password = password_hash($pass, PASSWORD_DEFAULT);
            if($user->save()){
                return $this->json_success($response, 201, $user->toJson());
            }else{
                return $this->json_error($response, 400);
            }

        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response|static
     */
    public function login(Request $request, Response $response, $args){

    }
}