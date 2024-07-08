<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Image;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Validator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get()->all();
        return view('server.product.index')->with(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('server.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // $rules = [
        //     'title' => 'required',
        //     'price' =>'required',
        // ];
        // $this->validate($request,$rules);
        Validator::make($request->all(), [
            'title' => 'required',
            'price' =>'required',
        ])->validate();
        $product = new Product();
        $product->price = $request->price;
        $product->name = $request->title;

        if($request->hasFile('image')){
            $image_temp = $request->file('image');
            if($image_temp->isValid()){
                //Get Image Extension
                $extension = $image_temp->getClientOriginalExtension();
                //Generate New Image Name
                $imageName = time().'.'.$extension;
//                $imagePath = 'frontend/images/product_image/'.$imageName;
//                Image::make($image_temp)->resize(1040,1300)->save($imagePath);
                $imagePath = 'frontend/images';
                $image_temp->move(public_path($imagePath),$imageName);
                $product->image = $imageName;
            }
        }


        $product->save();
        $last = $product->id;

        // if($request->hasFile("multiImage"))
        // {
        //     $files = $request->file("multiImage");
        //     foreach ($files as $file) {
        //         $imageName = time().'_'.$file->getClientOriginalName();
        //         $productImg['product_id'] = $product->id;
        //         $productImg['image'] = $imageName;
        //         $imagePath = 'frontend/images/multiImage';
        //         $file->move(public_path($imagePath),$imageName);
        //         MultiImages::create($productImg);
        //     }
        // }


        // if($last)
        // {
        //     $product_stock = new Stock();
        //     if($request->stock)
        //     {
        //         $product_stock->quantity = $request->stock;
        //     }
        //     $product_stock->product_id = $last;
        //     $product_stock->alert_stock = $request->alert_stock;;
        //     $product_stock->save();
        // }
        return redirect(route('product.index'))->with('success','Product Create Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findorFail($id);
        
        return view('server.product.edit')->with(compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Validator::make($request->all(), [
            'title' => 'required',
            'price' =>'required',
        ])->validate();

        $product = Product::findorFail($id);
        $product->price = $request->price;
        $product->name = $request->title;

        if($request->hasFile('image')){
            $image_exists = 'frontend/images/'.$product->image;
            if(File::exists($image_exists))
            {
                File::delete($image_exists);
            }
            $image_temp = $request->file('image');
            if($image_temp->isValid()){
                //Get Image Extension
                $extension = $image_temp->getClientOriginalExtension();
                //Generate New Image Name
                $imageName = time().'.'.$extension;
//                $imagePath = 'frontend/images/product_image/'.$imageName;
//                Image::make($image_temp)->resize(1040,1300)->save($imagePath);
                $imagePath = 'frontend/images';
                $image_temp->move(public_path($imagePath),$imageName);
                $product->image = $imageName;
            }
        }
//         if($request->hasFile('size_guide')){
//             $image_temp = $request->file('size_guide');
//             if($image_temp->isValid()){
//                 //Get Image Extension
//                 $extension = $image_temp->getClientOriginalExtension();
//                 //Generate New Image Name
//                 $imageName = time().'.'.$extension;
// //                $imagePath = 'frontend/images/product_sizeguide/'.$imageName;
// //                Image::make($image_temp)->resize(2389,3117)->save($imagePath);
//                 $imagePath = 'frontend/images/product_sizeguide';
//                 $image_temp->move(public_path($imagePath),$imageName);
//                 $product->size_guide = $imageName;
//             }
//         }
        $product->update();

        // if($request->hasFile("multiImage"))
        // {
        //     $files = $request->file("multiImage");
        //     foreach ($files as $file) {
        //         $imageName = time().'_'.$file->getClientOriginalName();
        //         $productImg['product_id'] = $product->id;
        //         $productImg['image'] = $imageName;
        //         $imagePath = 'frontend/images/multiImage';
        //         $file->move(public_path($imagePath),$imageName);
        //         MultiImages::create($productImg);
        //     }
        // }
        return redirect(route('product.index'))->with('success','Product Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findorFail($id);
        $image_exists = 'frontend/images/'.$product->image;
        // $size_guideexists = 'frontend/images/product_sizeguide/'.$product->size_guide;
        // $multiImage =
        if(File::exists($image_exists))
        {
            File::delete($image_exists);
        }
        // if(File::exists($size_guideexists))
        // {
        //     File::delete($size_guideexists);
        // }
        // $images = MultiImages::where('product_id',$product->id)->get();
        // foreach ($images as $image) {
        //     $multi_exists = 'frontend/images/multiImage/'.$image->image;
        //     if(File::exists($multi_exists))
        //     {
        //         File::delete($multi_exists);
        //     }
        //     $image->delete();
        // }
        $product->delete();
        // Stock::where('product_id',$id)->delete();
        // $variations = ProductVariationDetails::where('product_id',$id)->get()->all();
        // foreach ($variations as $variation) {
        //     $variation->delete();
        // }
        return redirect(route('product.index'))->with('success','Product Delete Successfully!');
    }

    public function updateProductStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if ($data['status']== 'Active') {
                $status = 'Inactive';
            }
            else{
                $status = 'Active';
            }
            Product::where('id',$data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'product_id'=> $data['product_id']]);
        }
    }

    public function multiImageDelete($id)
    {
//        $images = MultiImages::findorFail($id)->first();
//        $multi_exists = 'frontend/images/multiImage/'.$images->image;
//        if(File::exists($multi_exists))
//        {
//            File::delete($multi_exists);
//        }
//        $images->delete();
//
        $checkProductImage = MultiImages::findOrFail($id);

//        dd($checkProductImage);
        if (!is_null($checkProductImage)) {
            $checkProductImage->delete();
        }
        return redirect()->back()->with('success','Image Delete Successfully!!');
    }
}
