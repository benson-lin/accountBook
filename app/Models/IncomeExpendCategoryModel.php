<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeExpendCategoryModel extends Model
{
    protected $connection = 'account_book';
    public $timestamps = false;
    
    const TABLE = 't202_income_expend_category';
    protected $table = self::TABLE;
    protected $primaryKey = 'id';
    
    /**
     * 根据中文获取主键
     */
    public static function getIdByName($name) {
        $model = IncomeExpendCategoryModel::where('name', $name)->first();
        return $model['id'];
    }
    
}
