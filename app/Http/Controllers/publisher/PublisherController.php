<?php

namespace App\Http\Controllers\publisher;

use App\Http\Controllers\Controller;
use App\Repositories\PublisherRepository;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    private PublisherRepository $publisherRepository;
    public function __construct(PublisherRepository $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    public function getAllPublisher()
    {
        $publishers = $this->publisherRepository->getAllPublisher();
        if(!is_array($publishers) && !$publishers){
            return redirect()->route('login')->with('token_expired',true);
        }
        return view('publishers.list',compact('publishers'));
    }
    public function getPublisherById($id)
    {
        $publisher = $this->publisherRepository->getPublisherById($id);
        return response()->json(['status'=>200,'body'=>$publisher]);
    }
    public function createPublisher(Request $request)
    {
        $data = $this->publisherRepository->createPublisher($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function updatePublisher(Request $request)
    {
        $data = $this->publisherRepository->updatePublisher($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function changeStatusPublisher(Request $request)
    {
        $data = $this->publisherRepository->changeStatus($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function deletePublisher(Request $request)
    {
        $data = $this->publisherRepository->deletePublisher($request['id']);
        return response()->json(['status'=>200,'message'=>$data]);
    }
}
