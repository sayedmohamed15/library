<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{
    //
    public function store(Request $request){
        Author::firstOrCreate($this->validateRequest($request));

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function validateRequest(Request $request)
    {
        return $request->validate([
            'name' => 'required',
            'dob' => 'required',
        ]);
    }
}
