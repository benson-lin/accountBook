<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetPasswordExpiration extends Model
{
    protected $connection = 'account_book';
    public $timestamps = false;
    
    const TABLE = 't103_reset_password_expiration';
    protected $table = self::TABLE;
    protected $primaryKey = 'id';
    
}
