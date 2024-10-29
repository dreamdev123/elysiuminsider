<?php
namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InsiderMarketRisks extends Model
{
    protected $table = 'insider_market_risks';

    protected $fillable = [
      'id',
      'name',
      'code',
      'price',
      'percent',
      'status',
      'order',
      'created_at',
      'updated_at'
    ];
}