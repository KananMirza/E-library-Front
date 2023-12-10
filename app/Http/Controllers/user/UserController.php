<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getAllUser()
    {
        $users = $this->userRepository->getAllUser();
        if(!is_array($users) && !$users){
            return redirect()->route('login')->with('token_expired',true);
        }
        return view('users.list',compact('users'));
    }
    public function getUserById($userId)
    {
        $user = $this->userRepository->getUserById($userId);
        return response()->json(['status'=>200,'body'=>$user]);
    }
    public function changeStatusUser(Request $request)
    {
        $data = $this->userRepository->changeStatus($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
}
