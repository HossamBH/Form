<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Gender;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $content = Content::where(function($q)use($request){
            if($request->input('name')){
               $q->where('name','like','%'.$request->name.'%');
            }
            
            if($request->input('gender_id')){
               $q->where('gender_id',$request->gender_id);
            }

        })->latest()->paginate(20);
        return view('content.index', compact('content'));
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        $gender = Gender::all()->pluck('name', 'id')->toArray();
    
        return view('content.edit', compact('content', 'gender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $rules = [
            'name' => 'required',
            'age' => 'required',
            'image' => 'required',
            'gender_id' => 'required'
        ];

        $message = [
            'name.required' => 'Name is required',
            'age.required' => 'Age is required',
            'image.required' => 'Image is required',
            'gender_id.required' => 'Gender is required'
        ];
        $this->validate($request,$rules,$message);
        $content= Content::findOrFail($id);
        $content->update($request->except('image'));

        if ( $request->hasFile('image')  ) {
           $image = $request->image;
           $image_new_name = time() . $image->getClientOriginalName();
           $image->move('uploads/content', $image_new_name);
           $content->image = 'uploads/content/'.$image_new_name;
           $content->save();
        }
        flash()->success('Success');
       return redirect(route('content.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();
        flash()->success('Deleted');
        return response()->json([
            'id' => $content->id
        ]);
    }

    public function remove($id){

        $record = Content::findOrFail($id);
        $record->delete();
        return response()->json([
            'id' => $record->id
        ]);

    }
}
