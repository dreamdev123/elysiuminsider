<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 * App\InsiderUser
 *
 * @property int $id
 * @property string $customer_id
 * @property int $role_id
 * @property int|null $sponsor_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $status
 * @property int|null $country_id
 * @property string|null $phone
 * @property string|null $street_address
 * @property string|null $city
 * @property string|null $postal_code
 * @property string|null $state
 * @property string|null $birth_date
 * @property string|null $remember_token
 * @property string|null $email_verification_token
 * @property string|null $email_verified_at
 * @property string|null $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Country $country
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\InsiderUserLoginHistory[] $loginHistory
 * @property-read int|null $login_history_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\InsiderUserPasswordChangesHistory[] $passwordChangesHistory
 * @property-read int|null $password_changes_history_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereEmailVerificationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereStreetAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUser whereUserId($value)
 * @mixin \Eloquent
 */
class InsiderUser extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * User ole description]
     * @return HasOne eloquent relation
     */
    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    /**
     * @return HasMany
     */
    public function passwordChangesHistory(): HasMany
    {
        return $this->hasMany(InsiderUserPasswordChangesHistory::class);
    }

    /**
     * @return HasMany
     */
    public function loginHistory(): HasMany
    {
        return $this->hasMany(InsiderUserLoginHistory::class);
    }

}
