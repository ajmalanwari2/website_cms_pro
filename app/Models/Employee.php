<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'employees';

    protected $fillable = [
        'name',
        'father_name',
        'last_name',
        'id_number',
        'designation',
        'phone',
        'email',
        'image',
        'salary',
        'account_user_id',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'account_user_id');
    }
}
