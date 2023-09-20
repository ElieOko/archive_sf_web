<?php

namespace App\Models;

use App\Models\Tpicture;
use App\Models\TBranche;
use App\Models\Tinvoicekey;
use App\Models\Tdirectory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    /**
     * Get the user that owns the Tinvoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'UserFId','UserId');
    }
    public function directory()
    {
        return $this->belongsTo(Tdirectory::class, 'DirectoryFId','DirectoryId');
    }
    public function invoicekey()
    {
        return $this->belongsTo(Tinvoicekey::class, 'InvoiceKeyFId','InvoicekeyId');
    }
    public function branch()
    {
        return $this->belongsTo(TBranche::class, 'BranchFId' , 'BranchId');
    }
    public function pictures()
    {
        return $this->hasMany(Tpicture::class,"InvoiceFId");
    }
    /**
     * Get all of the comments for the Tinvoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function comments(): HasMany
    // {
    //     return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    // }
    public function scopeFilters(
        Builder $query,
        ?string $sortBy,
        ?string $direction,
    ): void {
        $query->when(
            value: $sortBy,
            callback: static function (Builder $query, $sortBy) use ($direction): void {
                match($sortBy) {
                    'title' => $query->orderBy('title', $direction ?? 'DESC'),
                    'status' => $query->orderByStatus($direction),
                    'analysis' => $query->orderByLikesAndCommentsCount($direction),
                    default => throw new RuntimeException('SortBy parameter in missing.'),
                };
            }
        );
    }
}
