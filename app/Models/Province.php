<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'province';
    protected $fillable = ['name_fa','name_pa','name_en','country_id','created_by','created_at','updated_by',
        'updated_at'];

    protected $dates = ['deleted_at'];
    
    public function districts()
    {
        return $this->hasMany(District::class);
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
