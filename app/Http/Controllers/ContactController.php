<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;
class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
    $data=$request->validated();
    Contact::create($data);
        return redirect()->back()->with('status-message','Your Message Sent Successfully');
    }
}
