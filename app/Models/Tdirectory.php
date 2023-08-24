<?php

namespace App\Models;

use App\Models\Tinvoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tdirectory extends Model
{
    use HasFactory;
    
    protected $primaryKey = "DirectoryId";

    protected $fillable = [
        'DirectoryName',
        'parentId'
    ];

    public $timestamps = false;
    
    public function tinvoice(): HasMany
    {
        return $this->hasMany(Tinvoice::class);
    }
}
