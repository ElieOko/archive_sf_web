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
    protected $primaryKey = 'UserId'; 
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
        'BranchScope',
        'ClientName',
        'ClientPhoneNumber'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $appends = ['token']; 
 
    protected $hidden = [ 
        'UserPass', 'RememberToken', 'APIToken' 
    ]; 
 
    public function getTokenAttribute() { 
        return $this->attributes['token'] = $this->APIToken ? 1 : 0; 
    } 
 
    public function getAuthPassword() 
    { 
        return $this->UserPass; 
    } 
 
    public function getRememberToken() 
    { 
        return $this->RememberToken; 
    } 
 
    public function setRememberToken($value) 
    { 
        $this->RememberToken = $value; 
    } 
 
    public function getRememberTokenName() 
    { 
        return 'RememberToken'; 
    } 
    public function isAdmin() 
    { 
        return $this->Admin == 1; 
    } 
 
    public function hasWebAccess() 
    { 
        return $this->WebAccess == 1; 
    } 
 
    public function isScopedToBranch() 
    { 
        return $this->BranchScope == 1; 
    } 

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
 

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
