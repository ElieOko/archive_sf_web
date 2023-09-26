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
        "ParentFId",
        "Available",
        "ForClient"
    ];

    public $timestamps = false;

    protected $casts = [
        'ForClient' => 'boolean',
    ];
    
    public function tinvoice(): HasMany
    {
        return $this->hasMany(Tinvoice::class);
    }
}
