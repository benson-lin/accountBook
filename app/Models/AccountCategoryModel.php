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
    
    /**
     * 根据中文获取主键
     */
    public static function getIdByName($name) {
        $model = AccountCategoryModel::where('name', $name)->first();
        return $model['id'];
    }
    
    public static function getAccountById($id) {
    	$account = AccountCategoryModel::find($id);
    	return $account;
    }
    
}
