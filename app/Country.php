<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Country
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $phonecode
 * @property string $phonemask
 * @property int $active
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country wherePhonecode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country wherePhonemask($value)
 * @mixin \Eloquent
 */
class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $table = 'countries';
}
