<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tdirectory extends Model
{
    use HasFactory;
    
    protected $primaryKey = "DirectoryId";

    protected $fillable = [
        'DirectoryName',
        'parentId'
    ];

    public $timestamps = false;
}
