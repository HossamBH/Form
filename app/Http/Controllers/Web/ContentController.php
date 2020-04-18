<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Content;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('content.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'age' => 'required',
            'image' => 'required',
            'gender' => 'required'
        ];

        $message = [
            'name.required' => 'Name is required',
            'age.required' => 'Age is required',
            'image.required' => 'Image is required',
            'gender.required' => 'Gender is required'
        ];
        $this->validate($request,$rules,$message);

        $content = Content::create($request->all());
        if ( $request->hasFile('image')  ) {
           $image = $request->image;
           $image_new_name = time() . $image->getClientOriginalName();
           $image->move('uploads/content', $image_new_name);
           $content->image = 'uploads/content/'.$image_new_name;
           $content->save();
        }
        flash()->success('Success');
        return redirect(route('content.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
