<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function list(){
        // paginate pya chin yin (get) nay yar mhr pya
        $categories = Category::orderBy('id','desc')->paginate(5);
        return view('admin.category.list',compact('categories'));
    }

    public function create(Request $request){
        $this->checkValidation($request);
        Category::create([
            //'database name' => $request->'form name'
            'name' => $request->categoryName,
        ]);

        Alert::success('Success', 'Category created successfully');
        return back();
    }

    

    //route to update page
    public function updatePage($id){
        // $category = Category::where('id',$id)->first();
        // apaw ka pone san ka where nae shar p ya tae array htae ka first ko pyan choice lite tr
        // out ka pone san ka find nae a khr tae shr tr
        $category = Category::find($id);
        return view('admin.category.update',compact('category'));
    }
 
    // update category
    public function update($id, Request $request){
        $this->checkValidation($request);
        Category::where('id',$id)->update([
            'name' => $request->categoryName,
            'created_at' => Carbon::now(),
        ]);
        Alert::success('Success', 'Category updated successfully');
        return to_route('categoryList');
    }

    // delete category
    public function delete($id){
        Category::find($id)->delete();
        Alert::success('Delete', 'Category deleted successfully');
        return back();
    }


    // check category validation
    private function checkValidation($request){
        $request->validate([
            'categoryName' => 'required',
        ],[
            'categoryName.required' => 'Need to enter category name',
        ]);
    }
}
 