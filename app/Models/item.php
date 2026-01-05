<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

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
