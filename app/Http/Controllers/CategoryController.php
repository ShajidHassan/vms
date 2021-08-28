<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    public function checkPermission(){
        $permissionId = intval(Session::get('admin_id'));
        if($permissionId <= 0){
            return redirect()->back()->with('message_error','You must be login first');
        }

        $marChantExists = DB::table("admins")
            ->where("deleted_at","=", null)
            ->where("id", "=",$permissionId)->first();

        if($marChantExists === null){
            return redirect()->back()->with('message_error','You must be signup first');
        }
    }

    //Category field er data DB te store 
    public function addCategory(Request $request){
        $this->checkPermission();
    	if($request->isMethod('post')) {
            $data= $request->all();
            $category = new Category;
            $category->name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            // $category->description = $data['description'];
            $category->url = $data['url'];
            $category->save();
            return redirect()->back()->with('message','Category Added Succesfully');
    	}else{
            $levels = Category::where(['parent_id'=>0])->get();
            return view('backend.categories.add-category')->with(compact("levels"));
        }
    }

    // Category field er Stored data update 
    public function editCategory(Request $request, $id = null){
        $this->checkPermission();
        if($request->isMethod('post')){
            $data = $request->all();
            Category::where(['id'=>$id])
                ->update(['name'=>$data['category_name'],'url'=>$data['url']]);
            return redirect()->back()->with('message','Category Updated Succesfully');
        }else{
            $categoryDetails = Category::where(['id'=>$id])->first();
            $levels = Category::where(['parent_id'=>0])->get();
            return view('backend.categories.edit-category')->with(compact('categoryDetails','levels'));
        }
    }

    public function deleteCategory(Request $request){
        $this->checkPermission();
         if($request->isMethod("POST")) {
             $id = trim(strip_tags($request->input("c_id")));
             if (!empty($id)) {
                 Category::where(['id' => $id])->delete();
                 return redirect()->back()->with('message', 'Category deleted Succesfully');
             }
         }else{
             return redirect()->back()->with('message_error','Request Method invalid');
         }

     }

    public function viewcategories()
    {
        $categories = Category::all();
        return view('backend.categories.view-categories')->with(compact('categories'));
    }


}