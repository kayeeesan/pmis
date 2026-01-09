<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\database\Eloquent\SoftDeletes;
use App\Traits\UsesUuid;

use Illuminate\Support\Facades\Cache;

class Department extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'name',
        'code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
