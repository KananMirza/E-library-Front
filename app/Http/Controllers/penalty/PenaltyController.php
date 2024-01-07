<?php

namespace App\Http\Controllers\penalty;

use App\Http\Controllers\Controller;
use App\Repositories\LeaseRepository;
use App\Repositories\PenaltyRepository;
use App\Repositories\PenaltyTypeRepository;
use App\Traits\OperationTrait;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    use OperationTrait;
    private PenaltyRepository $penaltyRepository;
    private LeaseRepository $leaseRepository;
    private PenaltyTypeRepository $penaltyTypeRepository;
    public function __construct(PenaltyRepository $penaltyRepository,LeaseRepository $leaseRepository,PenaltyTypeRepository $penaltyTypeRepository)
    {
        $this->penaltyRepository = $penaltyRepository;
        $this->leaseRepository = $leaseRepository;
        $this->penaltyTypeRepository = $penaltyTypeRepository;
    }

    public function getAllPenalties(){
        $penalties = $this->penaltyRepository->getAllPenalties();
        $leases = $this->leaseRepository->getAllLease();
        $types = $this->penaltyTypeRepository->getAllPenaltyType();
        if(!is_array($penalties) && !$penalties){
            return redirect()->route('login')->with('token_expired',true);
        }
        return view('penalties.list',compact('penalties','leases','types'));
    }
    public function getPenaltyById($id){
        $author = $this->penaltyRepository->getPenaltyById($id);
        return response()->json(['status'=>200,'body'=>$author]);
    }
    public function updatePenalty(Request $request){
        $data = $this->penaltyRepository->updatePenalty($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function createPenalty(Request $request){
        $data = $this->penaltyRepository->createPenalty($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
}
