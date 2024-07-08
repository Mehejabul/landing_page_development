<?php

namespace App\Http\Controllers;
use App\Models\InfoContent;
use App\Models\InfoDetails;
use Illuminate\Http\Request;

class InfoDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = InfoDetails::get();
        return view('server.info_details.index',compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $content_title = InfoContent::where('status','Active')->get()->all();
        return view('server.info_details.create',compact('content_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $content= new InfoDetails();
        $content->content = $request->content;
        $content->info_content_id = $request->info_content_id;
        $content->save();
        return redirect()->route('content-details.index')->with('success','Content Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contents = InfoDetails::where('info_content_id',$id)->get()->all();
        return view('server.info_details.show',compact('contents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $content = InfoDetails::findorFail($id);
        return view('server.info_details.edit',compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $content= InfoDetails::findorFail($id);
        $content->content = $request->content;
        $content->info_content_id = $request->info_content_id;
        $content->update();
        return redirect()->route('content-details.index')->with('success','Content Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function updateContentDetailsStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if ($data['status']== 'Active') {
                $status = 'Inactive';
            }
            else{
                $status = 'Active';
            }
            InfoDetails::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'banner_id'=> $data['banner_id']]);
        }
    }
}
