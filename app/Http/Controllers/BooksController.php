<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    //
    public function store(Request $request){
        $data = $this->validateRequest($request);
        $book=Book::firstOrCreate($data);
        return redirect($book->path());
    }

    public function update(Request $request, Book $id){
        $data = $this->validateRequest($request);
        $id->update($data);
        return redirect($id->path());

    }
    public function delete( Book $id){
        $id->delete();
        return redirect('/books');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function validateRequest(Request $request)
    {
        return $request->validate([
            'title' => 'required',
            'author_id' => 'required',
        ]);
    }
}
