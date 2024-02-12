<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BookResource::collection(Book::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $b = Book::create($inputs);
        return response()->json([
            'message' => 'Book creado con exito',
            'data' => new BookResource($b)
        ]);;
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $b = Book::find($book->id);
        if (isset($b)) {
            $b->title = $request->title;
            $b->description = $request->description;
            if ($b->save()) {
                return response()->json([
                    'message' => 'Book actualizado con exito',
                    'data' => $b
                ]);
            }
        } else {
            return response()->json([
                'message' => 'No existe el book'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->delete()) {
            return response()->json([
                'messages' => 'success'
            ], 204);
        } else {
            return response()->json([
                'messages' => 'Not Found'
            ], 404);
        }
    }
}