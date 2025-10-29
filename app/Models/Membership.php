<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'first_name','last_name','email','phone','gender','date_of_birth',
        'address','country','occupation','organization_name',
        'membership_type','reason_for_joining','status'
    ];
}
