<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfoContent;
class InfoContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = InfoContent::get()->all();
        return view('server.info_content.index',compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('server.info_content.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $content= new InfoContent();
        $content->title = $request->title;
        $content->save();
        return redirect()->route('content.index')->with('success','Content Title Successfully Created');
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
        $content = InfoContent::findorFail($id);
        return view('server.info_content.edit',compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $content= InfoContent::findorFail($id);
        $content->title = $request->title;
        $content->update();
        return redirect()->route('content.index')->with('success','Content Title Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function updateContentStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if ($data['status']== 'Active') {
                $status = 'Inactive';
            }
            else{
                $status = 'Active';
            }
            InfoContent::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'banner_id'=> $data['banner_id']]);
        }
    }
}
