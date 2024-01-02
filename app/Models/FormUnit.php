<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormUnit extends Model
{
    use HasFactory;

    protected $connection = 'website';
    protected $guarded=['id'];

    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
    }
    public function formRequests()
    {
        return $this->hasMany(FormRequests::class, 'unit_id');
    }
}
