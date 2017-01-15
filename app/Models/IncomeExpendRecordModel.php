<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeExpendRecordModel extends Model
{
    protected $connection = 'account_book';
    public $timestamps = false;
    
    const TABLE = 't301_income_expend_record';
    protected $table = self::TABLE;
    protected $primaryKey = 'id';
    
    
    /**
     * 获取关联账户信息
     */
    public function account() {
        return $this->belongsTo('App\Models\AccountCategoryModel', 'account_id', 'id');
    }
    
    /**
     * 获取关联收支信息
     */
    public function incomeExpend() {
        return $this->belongsTo('App\Models\IncomeExpendCategoryModel', 'income_expend_category_id', 'id');
    }
}
