<?php
namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InsiderNews extends Model
{
    protected $table = 'insider_news';

    protected $fillable = [
      'user_id',
      'insider_mail_id',
      'status',
      'created_at',
      'updated_at'
    ];

    public function insider_mail() {

        return $this->belongsTo('App\InsiderMails', 'insider_mail_id');

    }
}