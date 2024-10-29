<?php
namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InsiderMails extends Model
{
    protected $table = 'insider_mails';

    protected $fillable = [
      'user_id',
      'subject',
      'content',
      'created_at',
      'updated_at'
    ];
}