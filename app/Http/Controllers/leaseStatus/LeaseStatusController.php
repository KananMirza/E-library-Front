<?php

namespace App\Http\Controllers\leaseStatus;

use App\Http\Controllers\Controller;
use App\Repositories\LeaseStatusRepository;
use Illuminate\Http\Request;

class LeaseStatusController extends Controller
{
    private LeaseStatusRepository $leaseStatusRepository;
    public function __construct(LeaseStatusRepository $leaseStatusRepository){
        $this->leaseStatusRepository = $leaseStatusRepository;
    }
    public function getAllLeaseStatus()
    {
        $leaseStatuses = $this->leaseStatusRepository->getAllLeaseStatus();
        if(!is_array($leaseStatuses) && !$leaseStatuses){
            return redirect()->route('login')->with('token_expired',true);
        }
        return view('lease_statuses.list',compact('leaseStatuses'));
    }
    public function getLeaseStatusById($id)
    {
        $leaseStatus = $this->leaseStatusRepository->getLeaseStatusById($id);
        return response()->json(['status'=>200,'body'=>$leaseStatus]);
    }
    public function createLeaseStatus(Request $request)
    {
        $data = $this->leaseStatusRepository->createLeaseStatus($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function updateLeaseStatus(Request $request)
    {
        $data = $this->leaseStatusRepository->updateLeaseStatus($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function deleteLeaseStatus(Request $request)
    {
        $data = $this->leaseStatusRepository->deleteLeaseStatus($request['id']);
        return response()->json(['status'=>200,'message'=>$data]);
    }
}
