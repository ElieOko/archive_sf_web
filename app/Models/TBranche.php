<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TBranche extends Model
{
    use HasFactory;
    protected $table = "TBranches";

    protected $primaryKey = "BranchId";

    public $timestamps = false;
    protected $fillable = [
        'BranchName',
    ];
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
