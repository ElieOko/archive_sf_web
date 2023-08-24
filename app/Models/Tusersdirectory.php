<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tusersdirectory extends Model
{
    use HasFactory;
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    protected $table = "TUsersDirectories";
    protected $primaryKey = "UserDirectoryId";
    protected $fillable = [
        'UserFId',
        'DirectoryFId'
    ];

    public $timestamps = false;



}
