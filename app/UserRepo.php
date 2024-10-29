<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserRepo extends Model
{
    protected $table = 'user_repo';

    protected $fillable = [
      'user_id',
      'sponsor_id',
      'parent_id',
      'LHS',
      'RHS',
      'SLHS',
      'SRHS',
      'position',
      'user_level',
      'sp_user_level',
      'status_id',
      'package_id',
      'deleted_at',
      'created_at',
      'updated_at',
      'expiry_date',
      'default_binary_position'
  ];
}
