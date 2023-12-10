<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryRepository $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategory()
    {
        $categories = $this->categoryRepository->getAllCategory();
        if(!is_array($categories) && !$categories){
            return redirect()->route('login')->with('token_expired',true);
        }
        return view('categories.list',compact('categories'));
    }
    public function getCategoryById($id)
    {
        $category = $this->categoryRepository->getCategoryById($id);
        return response()->json(['status'=>200,'body'=>$category]);
    }
    public function createCategory(Request $request)
    {
        $data = $this->categoryRepository->createCategory($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function updateCategory(Request $request)
    {
        $data = $this->categoryRepository->updateCategory($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function changeStatusCategory(Request $request)
    {
        $data = $this->categoryRepository->changeStatus($request);
        return response()->json(['status'=>200,'message'=>$data]);
    }
    public function deleteCategory(Request $request)
    {
        $data = $this->categoryRepository->deleteCategory($request['id']);
        return response()->json(['status'=>200,'message'=>$data]);
    }
}
