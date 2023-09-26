<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectoriesBackup extends Model
{
    use HasFactory;
    protected $table = "TDirectoriesBackup";
    protected $primaryKey = "DirectoryId";
    protected $fillable = [
        "DirectoryName",
        "ParentFId", 
    ];
}
