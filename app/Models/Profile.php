<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'profile';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'dot_number',
        'mc_number',
        'ein',
        'scac',
        'facebook',
        'linkedin',
        'address',
        'image',
        'created_by',
        'updated_by'
    ];

    protected $dates = ['deleted_at'];
    protected $casts = [
        'authorities' => 'array',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
