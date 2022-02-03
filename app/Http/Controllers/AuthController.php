<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function store(Request $request)
    {
        $ip = $request->ip();
        $type = "input";
        $this->createLog("Http request post new user", $request, $ip, $type);
        return $this -> createUser(
            $request->input('name'),
            $request->input('email'),
            $request->input('password'),
            $ip
        );
    }

    private function createUser($name, $email, $password, $ip)
    {
        $user = User::Create([
            'name' => $name,
            'email' => $email,
            'password' => md5($password),
        ]);
        $user->save();
        $this->createLog("User saved ", $user, $ip, "output");
        return response()->json([
            'response' => true,

        ], 201);
    }


    public function authenticate(Request $request) {
        $ip = $request->ip();
        $type = "input";
        $this->createLog("Http request post new login", $request, $ip, $type);
        return $this -> login(
            
            $request->input('email'),
            $request->input('password'),
            $ip
        );
    }


    private function login($email,$password,$ip) {
        $user = User::where('email', $email)->where('password', md5($password))->get()->take(1);

        if (count($user)>0) {
            $login_at  = date("YmdHis");
            $random = rand(200, 500);
            $token = sha1($email.$login_at.$random);
            $expire_at = date("YmdHis",strtotime($login_at."+ 1 hours")); 
            $user[0]->login_at = $login_at;
            $user[0]->random = $random;
            $user[0]->token= $token;
            $user[0]->expire_at=$expire_at;

            $user[0]->save();
            $this->createLog("User Logged ", $user[0], $ip, "output");
            return response()->json([
                'response' => true,

                'data' => [
                    'token' => $user[0]->token,
                    'expire_at' => $user[0]->expire_at,
                    
                    
                    

                ],

            ], 200);
        } else {
            $this->createLog("invalid Credentials " , "Email->". $email . " Password->". $password, $ip, "output");
            return response()->json([
                'response' => false,

            ], 404);
        }
    }



    private function createLog($action, $params, $ip, $type)
    {
        $isProd = env("IS_PROD");
        if (!$isProd) {
            $log = new Logs;
            $log->action = $action;
            $log->ip = $ip;
            $log->type = $type;
            $log->params = $params;
            $log->save();
        } else {
            if ($type === "input") {
                $log = new Logs;
                $log->action = $action;
                $log->ip = $ip;
                $log->type = $type;
                $log->params = $params;
                $log->save();
            }
        }

    }
}
