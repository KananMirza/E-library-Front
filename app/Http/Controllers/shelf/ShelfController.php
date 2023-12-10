<?php

namespace App\Http\Controllers\shelf;

use App\Http\Controllers\Controller;
use App\Repositories\ShelfRepository;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    private ShelfRepository $shelfRepository;
    public function __construct(ShelfRepository $shelfRepository){
        $this->shelfRepository = $shelfRepository;
    }
    public function getAllShelf()
    {
        $shelves = $this->shelfRepository->getAllShelf();
        if(!is_array($shelves) && !$shelves){
            return redirect()->route('login')->with('token_expired',true);
        }
        return view('shelves.list',compact('shelves'));
    }
    public function getShelfById($id)
    {
        $shelf = $this->shelfRepository->getShelfById($id);
        return response()->json(['status'=>200,'body'=>$shelf]);
    }
    public function createShelf(Request $request)
    {
        $data = $this->shelfRepository->createShelf($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function updateShelf(Request $request)
    {
        $data = $this->shelfRepository->updateShelf($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function changeStatusShelf(Request $request)
    {
        $data = $this->shelfRepository->changeStatus($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function deleteShelf(Request $request)
    {
        $data = $this->shelfRepository->deleteShelf($request['id']);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    //
}
