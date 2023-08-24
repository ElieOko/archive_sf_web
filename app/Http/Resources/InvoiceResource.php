<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'InvoiceId'=>$this->InvoiceId,
            'InvoiceCode'=>$this->InvoiceCode,
            'InvoiceDesc'=>$this->InvoiceDesc,
            'InvoiceBarCode'=>$this->InvoiceBarCode,
            'InvoiceDate'=>$this->InvoiceDate,
            'InvoicePath'=>$this->InvoicePath,
            'AndroidVersion'=>$this->AndroidVersion,
            'InvoiceUniqueId'=>$this->InvoiceUniqueId,
            'ClientName'=>$this->ClientName,
            'ClientPhone'=>$this->ClientPhone,
            'ExpiredDate'=>$this->ExpiredDate
        ];
    }
}
