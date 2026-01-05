<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    protected $connection = 'mysql_old';

    protected $table = 'item';

    public $timestamps = false;

    protected $fillable = [
        'propertyno',
        'item',
        'unit',
        'descrip',
        'classid',
        'yrlife',
        'reorderpt',
        'reorderqty',
        'edate',
        'itemtypeid',
        'status',
        'criticalqty',
        'allow',
        'propertycard'
    ];
}
