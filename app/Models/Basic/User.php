<?php

namespace App\Models\Basic;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $connection = 'account_book';
    public $timestamps = false;
    
    const TABLE = 't101_user';
    protected $table = self::TABLE;
    protected $primaryKey = 'id';
    
}
