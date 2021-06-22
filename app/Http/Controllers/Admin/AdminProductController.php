<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\main_category;
use App\Models\product;
use App\Models\sub_category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdminProductController extends Controller
{

    public function get_all_products()
    {
        $all_products = product::with('main_cat')->with('sub_cat')->orderBy('id','desc')->paginate(15);
        return response($all_products,200);
    }


    public function save_product(Request $request)
    {
        $this->validate($request,[
           'product_name'=>'required',
           'new_price'=>'required',
           'main_cat_id'=>'required',
           'sub_cat_id'=>'required',
           'main_image'=>'required',
        ]);

        $product = new product();
        if ($request->main_image) {
            $name = time().uniqid().'.' . explode('/', explode(':', substr($request->main_image, 0, strpos($request->main_image, ';')))[1])[1];
            $directory = 'assets/admin/images/product/';
            $imgUrl  = $directory.$name;
            $path = '/assets/admin/images/product/'.$name;
            Image::make($request->main_image)->save($imgUrl);
            $product->main_image = $path;
        }


        if ($request->image_one) {
            $name = time().uniqid().'.' . explode('/', explode(':', substr($request->image_one, 0, strpos($request->image_one, ';')))[1])[1];
            $directory = 'assets/admin/images/product/';
            $imgUrl2  = $directory.$name;
            $path2 = '/assets/admin/images/product/'.$name;
            Image::make($request->image_one)->save($imgUrl2);
            $product->image_one = $path2;
        }


        if ($request->image_one) {
            $name = time().uniqid().'.' . explode('/', explode(':', substr($request->image_one, 0, strpos($request->image_one, ';')))[1])[1];
            $directory = 'assets/admin/images/product/';
            $imgUrl2  = $directory.$name;
            $path3 = '/assets/admin/images/product/'.$name;
            Image::make($request->image_one)->save($imgUrl2);
            $product->image_one = $path3;
        }

        $product->product_name = $request->product_name;
        $product->old_price = $request->old_price;
        $product->new_price = $request->new_price;
        $product->main_cat_id = $request->main_cat_id;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->sort_description = $request->sort_description;
        $product->long_description = $request->long_description;
        $product->save();


    }


    public function product_details($id)
    {
        $product_details = product::where('id',$id)->first();
        return response($product_details,200);
    }



    public function product_update(Request $request,$id)
    {
        $this->validate($request,[
            'product_name'=>'required',
            'new_price'=>'required',
            'main_cat_id'=>'required',
            'sub_cat_id'=>'required',
            'main_image'=>'required',
        ]);

        $product = product::where('id',$id)->first();
//        if ($request->main_image) {
//            $name = time().uniqid().'.' . explode('/', explode(':', substr($request->main_image, 0, strpos($request->main_image, ';')))[1])[1];
//            $directory = 'assets/admin/images/product/';
//            $imgUrl  = $directory.$name;
//            $path = '/assets/admin/images/product/'.$name;
//            Image::make($request->main_image)->save($imgUrl);
//            $product->main_image = $path;
//        }
//
//
//        if ($request->image_one) {
//            $name = time().uniqid().'.' . explode('/', explode(':', substr($request->image_one, 0, strpos($request->image_one, ';')))[1])[1];
//            $directory = 'assets/admin/images/product/';
//            $imgUrl2  = $directory.$name;
//            $path2 = '/assets/admin/images/product/'.$name;
//            Image::make($request->image_one)->save($imgUrl2);
//            $product->image_one = $path2;
//        }
//
//
//        if ($request->image_one) {
//            $name = time().uniqid().'.' . explode('/', explode(':', substr($request->image_one, 0, strpos($request->image_one, ';')))[1])[1];
//            $directory = 'assets/admin/images/product/';
//            $imgUrl2  = $directory.$name;
//            $path3 = '/assets/admin/images/product/'.$name;
//            Image::make($request->image_one)->save($imgUrl2);
//            $product->image_one = $path3;
//        }

        $product->product_name = $request->product_name;
        $product->old_price = $request->old_price;
        $product->new_price = $request->new_price;
        $product->main_cat_id = $request->main_cat_id;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->sort_description = $request->sort_description;
        $product->long_description = $request->long_description;
        $product->save();


        return response($product,200);

    }


    public function product_delete($id)
    {
        $product_delete = product::where('id',$id)->first();
        $product_delete->delete();
    }






    public function get_product_all_category()
    {
        $all_cats = main_category::all();
        return response($all_cats,200);
    }

    public function get_product_all_sub_category()
    {
        $all_sub_cats = sub_category::all();
        return response($all_sub_cats,200);
    }







}
