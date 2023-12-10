<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Services\RequestApi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private RequestApi $apiRequest;
    public function __construct(RequestApi $request){
        $this->apiRequest = $request;
    }

    public function index(){
       return view('index');
    }
}
