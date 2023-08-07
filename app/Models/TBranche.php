<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBranche extends Model
{
    use HasFactory;
    protected $table = "TBranches";

    protected $primaryKey = "BranchId";

    public $timestamps = false;
    protected $fillable = [
        'BranchName',
    ];
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';
}
