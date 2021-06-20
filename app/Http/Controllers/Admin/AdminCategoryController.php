<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\main_category;
use App\Models\sub_category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{

    //main category
    public function get_category()
    {
        $all_cats = main_category::orderBy('id','desc')->paginate(15);
        return response($all_cats,200);
    }

    public function save_category(Request $request)
    {
        $this->validate($request,[
            'category_name'=>'required'
        ]);

        $new_cat = new main_category();
        $new_cat->category_name = $request->category_name;
        $new_cat->category_slug = Str::slug($request->category_name);
        $new_cat->save();

        return response('Category Created',200);



    }

    public function update_category(Request $request,$id){
        $this->validate($request,[
            'category_name'=>'required'
        ]);

        $new_cat = main_category::where('id',$id)->first();
        $new_cat->category_name = $request->category_name;
        $new_cat->category_slug = Str::slug($request->category_name);
        $new_cat->save();

        return response('Category Created',200);
    }


    public function delete_category($id)
    {
        $delete_cat = main_category::where('id',$id)->first();
        if ($delete_cat) {
            $delete_cat->delete();
        }

        return response('category deleted',200);

    }



    public function get_all_category()
    {
        $all_cats = main_category::orderBy('id','desc')->get();
        return response($all_cats,200);
    }





    //sub category
    public function get_all_sub_category()
    {
        $all_sub_category = sub_category::with('main_cat')->orderBy('id','desc')->paginate(15);
        return response($all_sub_category,200);
    }


    public function save_sub_category(Request $request)
    {
        $this->validate($request,[
           'main_category_id'=>'required',
           'category_name'=>'required',
        ],[
            'main_category_id.required' =>'Please select main category',
            'category_name.required' =>'Please enter sub category name',
        ]);


        $sub_cat = new sub_category();
        $sub_cat->main_category_id = $request->main_category_id;
        $sub_cat->category_name = $request->category_name;
        $sub_cat->category_slug = Str::slug($request->category_name);
        $sub_cat->save();

        return response('Sub Category Created',200);

    }


    public function update_sub_category(Request $request,$id){
        $this->validate($request,[
            'main_category_id'=>'required',
            'category_name'=>'required',
        ],[
            'main_category_id.required' =>'Please select main category',
            'category_name.required' =>'Please enter sub category name',
        ]);


        $sub_cat = sub_category::where('id',$id)->first();
        $sub_cat->main_category_id = $request->main_category_id;
        $sub_cat->category_name = $request->category_name;
        $sub_cat->category_slug = Str::slug($request->category_name);
        $sub_cat->save();

        return response('Sub Category Created',200);
    }


    public function delete_sub_category($id)
    {
        $delete_sub_cat = sub_category::where('id',$id)->first();
        if ($delete_sub_cat) {
            $delete_sub_cat->delete();
        }

        return response('sub category deleted',200);
    }











}
