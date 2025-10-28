<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Village extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'village';
    protected $fillable = [
        'id',
        'name_fa',
        'name_pa',
        'name_en',
        'province_id',
        'district_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    protected $dates = ['deleted_at'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
