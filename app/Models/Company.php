<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    //

    use HasFactory, SoftDeletes;
    protected $table = 'companies';

    protected $fillable = [
        'company_number',
        'name',
        'address',
        'dot_number',
        'mc_number',
        'authorities',
        'email',
        'ein',
        'scac',
        'phone',
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

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function loads()
    {
        return $this->hasMany(Load::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function documents()
    {
        return $this->hasMany(CompanyDocument::class);
    }
}
