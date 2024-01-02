<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasFactory,SoftDeletes;
    protected $connection = 'website';
    protected $guarded=['id'];

    public function fields()
    {
        return $this->hasMany(FormFields::class, 'form_id');
    }

    public function formRequests()
    {
        return $this->hasMany(FormRequests::class, 'form_id');
    }
    public function units()
    {
        return $this->hasMany(FormUnit::class, 'form_id');
    }

}
