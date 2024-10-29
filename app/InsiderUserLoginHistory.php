<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 * App\InsiderUserLoginHistory
 *
 * @property int $id
 * @property int|null $insider_user_id
 * @property string|null $ip
 * @property string|null $email
 * @property string $action
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\InsiderUser|null $insiderUser
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserLoginHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserLoginHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserLoginHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserLoginHistory whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserLoginHistory whereInsiderUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserLoginHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserLoginHistory whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserLoginHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserLoginHistory whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserLoginHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InsiderUserLoginHistory extends Authenticatable
{
    use Notifiable;

    protected $table = 'insider_user_login_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'insider_user_id', 'ip', 'action'
    ];

    /**
     * @return BelongsTo
     */
    public function InsiderUser(): BelongsTo
    {
        return $this->belongsTo(InsiderUser::class);
    }
}
