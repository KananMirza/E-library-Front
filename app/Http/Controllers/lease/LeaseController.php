<?php

namespace App\Http\Controllers\lease;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use App\Repositories\LeaseRepository;
use App\Repositories\LeaseStatusRepository;
use App\Repositories\UserRepository;
use App\Traits\OperationTrait;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    use OperationTrait;
    private LeaseRepository $leaseRepository;
    private UserRepository $userRepository;
    private BookRepository $bookRepository;
    private LeaseStatusRepository $leaseStatusRepository;
    public function __construct(LeaseRepository $leaseRepository,UserRepository $userRepository,BookRepository $bookRepository,LeaseStatusRepository $leaseStatusRepository){
        $this->leaseRepository = $leaseRepository;
        $this->userRepository =$userRepository;
        $this->bookRepository =$bookRepository;
        $this->leaseStatusRepository =$leaseStatusRepository;
    }
    public function getAllLease()
    {
        $leases = $this->leaseRepository->getAllLease();

        if(!is_array($leases) && !$leases){
            return redirect()->route('login')->with('token_expired',true);
        }
        $books = $this->selectActive($this->bookRepository->getAllBook());
        $users = $this->selectActive($this->userRepository->getAllUser());
        $statuses = $this->leaseStatusRepository->getAllLeaseStatus();
        return view('leases.list',compact('leases','books','users','statuses'));
    }
    public function createLease(Request $request)
    {
        $data = $this->leaseRepository->createLease($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function getLeaseById($id)
    {
        $lease = $this->leaseRepository->getLeaseById($id);
        return response()->json(['status'=>200,'body'=>$lease]);
    }
    public function updateLease(Request $request)
    {
        $data = $this->leaseRepository->updateLease($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
}
