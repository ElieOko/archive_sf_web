<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tinvoice extends Model
{
    use HasFactory;

    protected $primaryKey = "InvoiceId";

    protected $fillable = [
        'InvoiceId',
        'InvoiceCode',
        'InvoiceDesc',
        'InvoiceBarCode',
        'UserFId',
        'DirectoryFId',
        'BranchFId',
        'InvoiceDate',
        'InvoiceKeyFId',
        'InvoicePath',
        'AndroidVersion',
        'InvoiceUniqueId',
        'ClientName',
        'ClientPhone',
        'ExpiredDate'
    ];
    public $timestamps = false;
}
