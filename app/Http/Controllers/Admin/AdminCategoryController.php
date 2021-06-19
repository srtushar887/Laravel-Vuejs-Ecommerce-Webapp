<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\main_category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{


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



}
