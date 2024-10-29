<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserMeta extends Model
{
    protected $table = 'user_meta';

    protected $fillable = [
      'user_id',
      'firstname',
      'lastname',
      'dob',
      'address',
      'country_id',
      'state_id',
      'city_id',
      'gender',
      'type_of_document',
      'passport_no',
      'nationality',
      'place_of_birth',
      'date_of_passport_issuance',
      'country_of_passport_issuance',
      'passport_expirition_date',
      'street_name',
      'house_no',
      'postcode',
      'address_country',
      'city',
      'additional_info',
      'bank_name',
      'acc_number',
      'pin',
      'profile_pic',
      'about_me',
      'facebook',
      'twitter',
      'linked_in',
      'google_plus',
      'created_at',
      'updated_at'
  ];
}
