<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\Size;
use App\Models\FeaturedImage;
use App\Models\InfoContent;
use App\Models\Banner;
class UserController extends Controller
{
    public function homepage(){
        $banner = Banner::get()->all();
        $contents = InfoContent::with('details')->where('status','Active')->whereHas('details', function($q) {$q->where('status','Active');})->get()->all();
        $featuredImage = FeaturedImage::where('status','Active')->get()->all();
        $products = Product::get()->all();
        $sizes = Size::get()->all();
        //dd($products);
        return view('index')->with(compact('products','sizes','featuredImage','contents'));
    }
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $valodate = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

            if(Auth::guard('web')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                return redirect('dashboard');
                }
            else{
                return redirect()->back()->with('error','Invalid Email or Password');
            }

        }
        return view('server.login');
    }
    public function logout(){
        Auth::logout();
        return redirect('login');
    }
    public function dashboard(){
        return view('server.admin.dashboard');
    }
}
