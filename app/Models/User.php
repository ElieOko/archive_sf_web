<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\TBranche;
use App\Models\Tinvoice;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "TUsers";
    public $timestamps = false;
    protected $rememberTokenName = 'RememberToken';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'UserName',
        'UserPass',
        'DbUser',
        'DbPass',
        'BranchFId',
        'Admin',
        'SerialNumber',
        'SMSToken',
        'SMSTokenExpiry',
        'Phone',
        'WebAccess',
        'DbUser',
        'DbPass',
        'ClientName',
        'ClientPhoneNumber'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'UserPass',
        'RememberToken',
    ];

    /**
    * The primary key associated with the table.
    **/
    protected $primaryKey = "UserId";
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'UserPass' => 'hashed',
    ];

     public function branch()
    {
        return $this->belongsTo(TBranche::class,'BranchFId','BranchId');
    }
    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tinvoice(): HasMany
    {
        return $this->hasMany(Tinvoice::class);
    }
}
