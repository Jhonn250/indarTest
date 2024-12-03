<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'STATUS';
    protected $primaryKey = 'StatusID';
    public $incrementing = true;
    public $timestamps = false; 
    protected $keyType = 'int';

    protected $fillable = [
        'StatusID',
        'StatusDetails',
    ];
}