<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $table = 'TASKS';
    protected $primaryKey = 'TaskID';
    public $incrementing = true;
    public $timestamps = false; 
    protected $keyType = 'int';

    protected $fillable = [
        'TaskID',
        'Task_MetaID',
        'TaskDetails',
        'CreatedAt',
        'Task_StatusID',
    ];
    public function status()
{
    return $this->belongsTo(Status::class, 'Task_StatusID', 'StatusID');
}
}
