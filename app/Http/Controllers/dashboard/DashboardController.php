<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\AuthorRepository;
use App\Repositories\LeaseRepository;
use App\Repositories\UserRepository;
use App\Services\RequestApi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private UserRepository $userRepository;
    private AuthorRepository $authorRepository;
    private LeaseRepository $leaseRepository;

    public function __construct(UserRepository $userRepository,AuthorRepository $authorRepository,LeaseRepository $leaseRepository)
    {
        $this->userRepository = $userRepository;
        $this->authorRepository = $authorRepository;
        $this->leaseRepository = $leaseRepository;
    }

    public function index(){
        $users = $this->userRepository->getAllUser();
        if(!is_array($users) && !$users){
            return redirect()->route('login')->with('token_expired',true);
        }
        $authors = $this->authorRepository->getAllAuthor();
        if(!is_array($authors) && !$authors){
            return redirect()->route('login')->with('token_expired',true);
        }
        $leases = $this->leaseRepository->getAllLease();
        if(!is_array($leases) && !$leases){
            return redirect()->route('login')->with('token_expired',true);
        }
       return view('index',compact("users","authors","leases"));
    }
}
