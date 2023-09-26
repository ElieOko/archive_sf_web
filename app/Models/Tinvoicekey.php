<?php

namespace App\Models;

use App\Models\Tinvoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tinvoicekey extends Model
{
    use HasFactory;
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';

    protected $primaryKey = "InvoicekeyId";
    protected $table = "TInvoiceKeys";
    protected $fillable = [
        'Invoicekey',
        'DirectoryFId',
    ];

    public $timestamps = false;

    public function tinvoice(): HasMany
    {
        return $this->hasMany(Tinvoice::class);
    }
}
