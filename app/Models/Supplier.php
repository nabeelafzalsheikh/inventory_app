<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contact_person_name',
        'address',
        'phone',
    ];
}