<?php

namespace App\Models;

use App\Models\Tinvoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tpicture extends Model
{
    use HasFactory;

    protected $table = "TPictures";
    protected $primaryKey = "PictureId";
    public $timestamps = false;
    protected $fillable = [
        'InvoiceFId',
        'PictureName',
        'PicturePath',
        'PublicUrl',
        'PictureOriginalName'
    ];
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public function invoice()
    {
        return $this->belongsTo(Tinvoice::class, 'InvoiceFId','InvoiceId');
    }
}
