<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metas extends Model
{
    use HasFactory;
    protected $table = 'METAS';
    protected $primaryKey = 'MetaID';
    public $incrementing = true;
    public $timestamps = false; 
    protected $keyType = 'int';

    protected $fillable = [
        'MetaID',
        'CreatedAt',
        'MetaDetails',
    ];
}