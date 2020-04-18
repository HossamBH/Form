<?php

namespace App\Http\Controllers\Api;

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
        $contents = Content::paginate(10);

        return responsejson(1, 'success', $contents);
    }

    public function showOne(Request $request)
    {
        $content = Content::find($request->id);

        return responsejson(1, 'success', $content);
    }
}