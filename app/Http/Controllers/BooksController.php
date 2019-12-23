<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    //
    public function store(Request $request){
        $data = $this->validateRequest($request);
        Book::firstOrCreate($data);
    }

    public function update(Request $request, Book $id){
        $data = $this->validateRequest($request);
        $id->update($data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function validateRequest(Request $request)
    {
        return $request->validate([
            'title' => 'required',
            'author' => 'required',
        ]);
    }
}
