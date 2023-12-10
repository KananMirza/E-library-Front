<?php

namespace App\Http\Controllers\penaltyType;

use App\Http\Controllers\Controller;
use App\Repositories\PenaltyTypeRepository;
use Illuminate\Http\Request;

class PenaltyTypeController extends Controller
{
    private PenaltyTypeRepository $penaltyTypeRepository;
    public function __construct(PenaltyTypeRepository $penaltyTypeRepository){
        $this->penaltyTypeRepository = $penaltyTypeRepository;
    }
    public function getAllPenaltyType()
    {
        $penaltyTypes = $this->penaltyTypeRepository->getAllPenaltyType();
        if(!is_array($penaltyTypes) && !$penaltyTypes){
            return redirect()->route('login')->with('token_expired',true);
        }
        return view('penalty_type.list',compact('penaltyTypes'));
    }
    public function getPenaltyTypeById($id)
    {
        $penaltyType = $this->penaltyTypeRepository->getPenaltyTypeById($id);
        return response()->json(['status'=>200,'body'=>$penaltyType]);
    }
    public function createPenaltyType(Request $request)
    {
        $data = $this->penaltyTypeRepository->createPenaltyType($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function updatePenaltyType(Request $request)
    {
        $data = $this->penaltyTypeRepository->updatePenaltyType($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function deletePenaltyType(Request $request)
    {
        $data = $this->penaltyTypeRepository->deletePenaltyType($request['id']);
        return response()->json(['status'=>200,'message'=>$data]);
    }
}
