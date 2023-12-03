<?php

namespace App\Http\Controllers\author;

use App\Http\Controllers\Controller;
use App\Repositories\AuthorRepository;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private $authorRepository;
    public function __construct(AuthorRepository $authorRepository){
        $this->authorRepository = $authorRepository;
    }
    public function getAllAuthor(){
        $authors = $this->authorRepository->getAllAuthor();
        if(!is_array($authors) && !$authors){
            return redirect()->route('login')->with('token_expired',true);
        }
        return view('authors.list',compact('authors'));
    }
    public function getAuthorById($id){
        $author = $this->authorRepository->getAuthorById($id);
        return response()->json(['status'=>200,'body'=>$author]);
    }
    public function updateAuthor(Request $request){
        $data = $this->authorRepository->updateAuthor($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function createAuthor(Request $request){
        $data = $this->authorRepository->createAuthor($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function changeStatusAuthor(Request $request){
        $data = $this->authorRepository->changeStatus($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function deleteAuthor(Request $request){
        $data = $this->authorRepository->deleteAuthor($request['id']);
        return response()->json(['status'=>200,'message'=>$data]);
    }
}
