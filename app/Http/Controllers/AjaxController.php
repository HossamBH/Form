<?php

namespace App\Http\Controllers;
use App\Content;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function create()
    {
    	return view('ajaxContent.create');
    }

    public function store(Request $request)
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

        $content = Content::create($request->all());
        if ( $request->hasFile('image')  ) {
           $image = $request->image;
           $image_new_name = time() . $image->getClientOriginalName();
           $image->move('uploads/content', $image_new_name);
           $content->image = 'uploads/content/'.$image_new_name;
           $content->save();
        }
        flash()->success('Success');
    }
}
