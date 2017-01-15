<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountCategoryModel extends Model
{
    protected $connection = 'account_book';
    public $timestamps = false;
    
    const TABLE = 't201_account_category';
    protected $table = self::TABLE;
    protected $primaryKey = 'id';
    
}
