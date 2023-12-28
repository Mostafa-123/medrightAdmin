<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormFields extends Model
{
    use HasFactory,SoftDeletes;
    protected $casts = [
        'files_type' => 'array',
    ];
    protected $connection = 'website';
    protected $guarded=['id'];

    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
    }
    public function formRequests()
    {
        return $this->belongsTo(FormRequests::class, 'form_id');
    }
}
