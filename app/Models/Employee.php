<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $connection = 'mysql_old';

    protected $table = 'employee';

    protected $primaryKey = 'IDNumber';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'IDNumber',
        'FirstName',
        'LastName',
        'MiddleName',
        'Address',
        'PhoneNo',
        'Status',
    ];
}
