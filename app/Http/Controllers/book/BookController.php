<?php

namespace App\Http\Controllers\book;

use App\Http\Controllers\Controller;
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\PublisherRepository;
use App\Repositories\ShelfRepository;
use App\Traits\OperationTrait;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use OperationTrait;
    private BookRepository $bookRepository;
    private ShelfRepository $shelfRepository;
    private CategoryRepository $categoryRepository;
    private AuthorRepository $authorRepository;
    private PublisherRepository $publisherRepository;
    public function __construct(BookRepository $bookRepository,ShelfRepository $shelfRepository,CategoryRepository $categoryRepository
    ,AuthorRepository $authorRepository,PublisherRepository $publisherRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;
        $this->shelfRepository = $shelfRepository;
        $this->authorRepository = $authorRepository;
        $this->publisherRepository = $publisherRepository;
    }
    public function getAllBook()
    {
        $books = $this->bookRepository->getAllBook();
        if(!is_array($books) && !$books){
            return redirect()->route('login')->with('token_expired',true);
        }
        return view('books.list',compact('books'));
    }

    public function createBookPage()
    {
        $shelves = $this->selectActive($this->shelfRepository->getAllShelf());
        $categories = $this->selectActive($this->categoryRepository->getAllCategory());
        $authors = $this->selectActive($this->authorRepository->getAllAuthor());
        $publishers = $this->selectActive($this->publisherRepository->getAllPublisher());
        return view('books.add',compact('shelves','categories','authors','publishers'));
    }
    public function createBook(Request $request)
    {
        $data = $this->bookRepository->createBook($request);
        if(!$data){
            return redirect()->back()->with('error',true);
        }
        return redirect()->route('getAllBook')->with('success',$data);
    }

    public function changeStatusBook(Request $request)
    {
        $data = $this->bookRepository->changeStatus($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function deleteBook(Request $request)
    {
        $data = $this->bookRepository->deleteBook($request['id']);
        return response()->json(['status'=>200,'message'=>$data]);
    }
}
