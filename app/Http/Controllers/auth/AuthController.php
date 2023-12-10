<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Services\RequestApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private RequestApi $apiRequest;
    public function __construct(RequestApi $request){
        $this->apiRequest = $request;
    }

    public function login(){
        return view('login');
    }
    public function logout(){
        Session::flush();
        return redirect()->route('login');
    }
    public function loginPost(Request $request){
        unset($request['_token']);
        $response  = $this->apiRequest->post('/auth/login',$request,false);
        if($response['status'] != 200){
            return redirect()->back()->with('error_pass',true);
        }
        \session()->put('access_token',$response['body']['access_token']);
        \session()->put('refresh_token',$response['body']['refresh_token']);
        return redirect()->route('index');
    }
}
