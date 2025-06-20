<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentsRequest;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentsRequest $request)
    {
        $data=$request->validated();
        comment::create($data);
        return redirect()->back()->with('commentCreateStatus','Your Comment Published Successfully');
    }

}
