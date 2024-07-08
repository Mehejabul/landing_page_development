<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Models\Settings;
use Illuminate\Support\Facades\File;
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $settings = Settings::get()->first();
        // dd($settings);
        return view('server.settings.edit',compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validator::make($request->all(), [
        //     'title' => 'required',
        //     'price' =>'required',
        // ])->validate();

        $settings = Settings::findorFail($id);
        $settings->company_name = $request->company_name;
        $settings->page_title = $request->page_title;
        $settings->title = $request->title;
        // $settings->sub_title = $request->sub_title;
        // $settings->description = $request->description;
        $settings->call_to_action = $request->call_to_action;
        $settings->phone = $request->phone;
        // $settings->whats_app = $request->whats_app;
        // $settings->messenger = $request->messenger;
        $settings->old_price = $request->old_price;
        $settings->new_price = $request->new_price;
        $settings->order_title = $request->order_title;
        $settings->order_sub_title = $request->order_sub_title;
        $settings->order_sub_sub_title = $request->order_sub_sub_title;
        $settings->order_message = $request->order_message;
        $settings->free = $request->free;
        $settings->inside_dhaka = $request->inside_dhaka;
        $settings->outside_dhaka = $request->outside_dhaka;

        if($request->hasFile('logo')){
            $image_exists = 'frontend/images/settings/'.$settings->logo;
            if(File::exists($image_exists))
            {
                File::delete($image_exists);
            }
            $image_temp = $request->file('logo');
            if($image_temp->isValid()){
                //Get Image Extension
                $extension = $image_temp->getClientOriginalExtension();
                //Generate New Image Name
                $imageName = time().'.'.$extension;
                $imagePath = 'frontend/images/settings';
                $image_temp->move(public_path($imagePath),$imageName);
                $settings->logo = $imageName;
            }
        }
        if($request->hasFile('favicon')){
            $image_exists = 'frontend/images/settings/'.$settings->favicon;
            if(File::exists($image_exists))
            {
                File::delete($image_exists);
            }
            $image_temp = $request->file('favicon');
            if($image_temp->isValid()){
                //Get Image Extension
                $extension = $image_temp->getClientOriginalExtension();
                //Generate New Image Name
                $imageName = time().'.'.$extension;
                $imagePath = 'frontend/images/settings';
                $image_temp->move(public_path($imagePath),$imageName);
                $settings->favicon = $imageName;
            }
        }
        if($request->hasFile('size_guide')){
            $image_exists = 'frontend/images/settings/'.$settings->size_guide;
            if(File::exists($image_exists))
            {
                File::delete($image_exists);
            }
            $image_temp = $request->file('size_guide');
            if($image_temp->isValid()){
                //Get Image Extension
                $extension = $image_temp->getClientOriginalExtension();
                //Generate New Image Name
                $imageName = time().'.'.$extension;
                $imagePath = 'frontend/images/settings';
                $image_temp->move(public_path($imagePath),$imageName);
                $settings->size_guide = $imageName;
            }
        }
//         if($request->hasFile('size_guide')){
//             $image_temp = $request->file('size_guide');
//             if($image_temp->isValid()){
//                 //Get Image Extension
//                 $extension = $image_temp->getClientOriginalExtension();
//                 //Generate New Image Name
//                 $imageName = time().'.'.$extension;
// //                $imagePath = 'frontend/images/settings/settings_sizeguide/'.$imageName;
// //                Image::make($image_temp)->resize(2389,3117)->save($imagePath);
//                 $imagePath = 'frontend/images/settings/settings_sizeguide';
//                 $image_temp->move(public_path($imagePath),$imageName);
//                 $settings->size_guide = $imageName;
//             }
//         }
        $settings->update();

        // if($request->hasFile("multiImage"))
        // {
        //     $files = $request->file("multiImage");
        //     foreach ($files as $file) {
        //         $imageName = time().'_'.$file->getClientOriginalName();
        //         $settingsImg['settings_id'] = $settings->id;
        //         $settingsImg['image'] = $imageName;
        //         $imagePath = 'frontend/images/settings/multiImage';
        //         $file->move(public_path($imagePath),$imageName);
        //         MultiImages/settings::create($settingsImg);
        //     }
        // }
        return redirect(route('settings.edit',1))->with('success','Settings Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
