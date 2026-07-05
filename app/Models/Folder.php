<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Note;

class Folder extends Model
{
    protected $fillable = [
        'user_id',
        'name'
    ];

    protected $casts = [];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function folderWithNotes()
    {
        return $this->hasMany(Note::class, 'folder_id', 'id')->where('folder_id', session('folder_id'))->orderBy('id', 'desc');
    }
}
