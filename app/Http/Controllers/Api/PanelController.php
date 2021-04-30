<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PanelService;
use Nowakowskir\JWT\JWT;
use Nowakowskir\JWT\TokenDecoded;
use Nowakowskir\JWT\TokenEncoded;
use Illuminate\Support\Facades\Cookie;

class PanelController extends Controller
{
    public function post_login(Request $request, PanelService $panelservice)
    {
        $login = $panelservice->handle($request->all());
        if ($login[0]['result'] == 'success') {
            return response([
                'message' => 'Success Login!',
                'token' => $login[0]['token'],
            ], 200)->cookie('jwt', $login[0]['token'], 60);
        } else {
            return response(
                $login,
                500
            );
        }
    }

    public function login(PanelService $panelservice, Request $request)
    {
        $jwt = $request->cookie('jwt');

        if ($jwt !== null) {
            $tokenDecoded = new TokenDecoded;
            $verifierTokenEncoded = new TokenEncoded($jwt);
            $verifierHeader = $verifierTokenEncoded->decode()->getHeader();
            $exception = false;
    
            $validate = $verifierTokenEncoded->validate($panelservice->privateKey(), $verifierHeader['alg']);
            $tokenEncoded = $tokenDecoded->encode($panelservice->privateKey(), JWT::ALGORITHM_HS256);
            $payload = $tokenEncoded->decode()->getPayload();
    
            dd($jwt);
    
            if ($validate == true) {
                return response([
                    'message' => 'Token valid'
                ], 200);
            } else {
                return response([
                    'message' => 'Token Tidak Valid!'
                ], 500);
            }
        } else {
            return response([
                'message' => 'JWT Sudah Expired!'
            ], 500);
        }
    }

    public function register()
    {
        //
    }

    public function post_register()
    {
        //
    }

    public function logout(Request $request)
    {
        if ($request->logout == 'logout') {
            // Cookie::queue(Cookie::forget('jwt'));
            return response([
                'message' => 'Logout Success!'
            ], 200)->cookie('jwt', '', 0);
        } else {
            return response([
                'message' => 'Logout Fail!'
            ], 500);
        }
    }
}
