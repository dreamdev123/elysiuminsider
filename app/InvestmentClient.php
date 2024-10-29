<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvestmentClient extends Model
{
	protected $table = 'investment_clients';

	  protected $fillable = [
	  	'capital_user_id',
	      'sponsor_id',
	      'name',
	      'email',
	      'reg_date',
	      'created_at',
	      'updated_at'
	  ];

    public function investment_roi() {

        return $this->hasOne('App\InvestmentRoi', 'client_id', 'id');

    }
}