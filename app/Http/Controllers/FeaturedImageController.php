<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use App\Models\FeaturedImage;
use Illuminate\Http\Request;

class FeaturedImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = FeaturedImage::get()->all();
        return view('server.featured_image.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('server.featured_image.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $banner = new FeaturedImage();
        // $banner->text = $request->text;
        // $banner->description = $request->description;

        //dd($request->file('brand_image'));
        //dd($request->hasFile('brand_image'));
        if($request->hasFile('image')){
            $image_temp = $request->file('image');
            if($image_temp->isValid()){
                //Get Image Extension
                $extension = $image_temp->getClientOriginalExtension();
                //Generate New Image Name
                $imageName = time().'.'.$extension;
//                $imagePath = 'images/banner/'.$imageName;
//                Image::make($image_temp)->resize(1920,700)->save($imagePath);
                $imagePath = 'frontend/images/featured_images';
                $image_temp->move(public_path($imagePath),$imageName);
                $banner->image = $imageName;
            }
        }


        $banner->save();
        return redirect(route('featured-images.index'))->with('success','New Featured Image Save Successfully!');

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
        $banner = FeaturedImage::where('id',$id)->get()->first();
        return view('server.featured_image.edit')->with(compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = FeaturedImage::findorFail($id);
        // $banner->first_text = $request->first_text;
        // $banner->second_text = $request->second_text;

        if($request->hasFile('image')){
            $exists = 'frontend/images/featured_images/'.$banner->image;
            if(File::exists($exists))
            {
                File::delete($exists);
            }
            $image_temp = $request->file('image');
            if($image_temp->isValid()){
                //Get Image Extension
                $extension = $image_temp->getClientOriginalExtension();
                //Generate New Image Name
                $imageName = time().'.'.$extension;
//                $imagePath = 'images/banner/'.$imageName;
//                Image::make($image_temp)->resize(1920,700)->save($imagePath);
                $imagePath = 'frontend/images/featured_images';
                $image_temp->move(public_path($imagePath),$imageName);
                $banner->image = $imageName;
            }
        }

        $banner->update();

        return redirect(route('featured-images.index'))->with('success','Image Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function updateFeaturedImageStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if ($data['status']== 'Active') {
                $status = 'Inactive';
            }
            else{
                $status = 'Active';
            }
            FeaturedImage::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'banner_id'=> $data['banner_id']]);
        }
    }
}
