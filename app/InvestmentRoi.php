<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvestmentRoi extends Model
{
	protected $table = 'investment_roi';

  protected $fillable = [
      'client_id',
      'invested_amount',
      'profit',
      'equity',
      'multi_invested_amount',
      'multi_equity',
      'multi_profit',
      'created_at',
      'updated_at'
  ];

    public function investment_client() {

        return $this->belongsTo('App\InvestmentClient', 'client_id');

    }
}