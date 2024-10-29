<?php
/**
 *  -------------------------------------------------
 *  Hybrid MLM  Copyright (c) 2018 All Rights Reserved
 *  -------------------------------------------------
 *
 * @author Acemero Technologies Pvt Ltd
 * @link https://www.acemero.com
 * @see https://www.hybridmlm.io
 * @version 1.00
 * @api Laravel 5.4
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class SafeChargeHistory
 * @package App\SafeChargeHistory
 */
class SafeChargeHistory extends Model
{

    protected $guarded = [];

    protected $casts = [
        'getParams' => 'array',
        'postParams' => 'array'
    ];

    protected $table = 'SafeCharge_history';


}
