<?php

namespace App\Http\Controllers\OOP;

use App\Models\OOP\Books;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index($from) {
        //check user status
        if ($from != 'admin') {
            $from = 'user';
        }
        //get allowed books
        switch ($from) {
            case 'admin':
                $books = Books::whereIn('status', [0, 1, 2])->get();
                break;
            case 'user':
                $books = Books::where('status', 1)->get();
                break;
        }
        return view('books.index', compact('from', 'books'));
    }

    public function show($from, $id) {
        //check user status
        if ($from != 'admin') {
            $from = 'user';
        }
        //get book
        $book = Books::findOrFail($id);

        //redirect if book not allowed
        if ((($from == 'user') && ($book->status != 1)) || ($book->status == 3)) {
            return redirect()->route('books.list', ['from' => $from]);
        }
        return view('books.show', compact('from', 'book'));
    }

    public function store($from, Request $request) {
        $this->validate($request, [
            'title' => 'required|string|min:2',
        ]);
        //check user status
        if ($from != 'admin') {
            $from = 'user';
            $status = 0;
        } else {
            $status = 1;
        }
        //add new book
        $book = new Books();
        $book->title = $request->title;
        $book->status = $status;
        $book->save();

        return back();
    }

    public function changeStatus($id, Request $request) {
        $book = Books::findOrFail($id);
        $book->status = $request->status;
        $book->save();

        return redirect()->route('books.list', ['from' => 'admin']);
    }
}
