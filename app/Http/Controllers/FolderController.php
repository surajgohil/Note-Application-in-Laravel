<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $id)
    {
        session()->put('folder_id', $id);
        // $notes = Note::where('id', $id)->get();

        // if($notes){
        //     return response()->json([
        //         'status' => true,
        //         'data' => $notes,
        //         'message' => 'Data found'
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'data_not_found'
        //     ]);
        // }

        return view('folder');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $userCreated = Folder::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'data add successfully.'
        ]);
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
        $foldersWithNotes = Folder::with('folderWithNotes')->where('user_id', $id)->orderBy('id', 'desc')->get();

        if($foldersWithNotes){
            return response()->json([
                'status' => true,
                'data' => $foldersWithNotes,
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
        $folderData = Folder::where([
            'id' => $id,
            'user_id' => Auth::id()
        ])->first();

        if($folderData){
            return response()->json([
                'status' => true,
                'data' => $folderData,
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
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $updateFolder = Folder::where([
            'id' => $id,
            'user_id' => Auth::id()
        ])->update([
            'name' => $request->name
        ]);

        if($updateFolder){
            return response()->json([
                'status' => true,
                'message' => 'Update data successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Folder name not update please try again.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteFolder = Folder::where([
            'id' => $id,
            'user_id' => Auth::id()
        ])->delete();

        if($deleteFolder){
            return response()->json([
                'status' => true,
                'message' => 'Delete data successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Folder name not Delete please try again.'
            ]);
        }
    }
}
