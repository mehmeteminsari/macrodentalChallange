<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'birthday',
    ];

    public function getform()
    {
        return $this->hasOne(Form::class, 'city_id', 'id');
    }

    // public function setTransactionDateAttribute($value)
    // {
    //     $this->attributes['birthday'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    // }
    // public function getTransactionDateAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d/m/Y');
    // }
}
