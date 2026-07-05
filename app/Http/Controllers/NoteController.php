<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, String $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $note = Note::create([
            'user_id' => Auth::id(),
            'folder_id' => $id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if ($note) {
            return response()->json([
                'status' => true,
                'message' => 'Note create successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Note not save please try again.'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notes = Note::where('id', $id)->get();

        if($notes){
            return response()->json([
                'status' => true,
                'data' => $notes,
                'message' => 'data found.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data_not_found.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $notes = Note::find($id);

        if($notes){
            return response()->json([
                'status' => true,
                'data' => $notes,
                'message' => 'data found.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data_not_found.'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateNote = Note::where('id', $id)->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if($updateNote){
            return response()->json([
                'status' => true,
                'message' => 'update note successfully.'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Note not update please try again.'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteNote = Note::where('id', $id)->delete();

        if($deleteNote){
            return response()->json([
                'status' => true,
                'message' => 'Delete note successfully.'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Note not delete please try again.'
            ], 200);
        }
    }
}
