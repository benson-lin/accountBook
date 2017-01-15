<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $connection = 'account_book';
    public $timestamps = false;
    
    const TABLE = 't101_user';
    protected $table = self::TABLE;
    protected $primaryKey = 'id';
    
}
