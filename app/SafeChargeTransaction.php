<?php
namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * Class SafeChargeTransaction
 * @package App\SafeChargeTransaction
 */
class SafeChargeTransaction extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];

   
    protected $table = 'SafeCharge_transactions';
}