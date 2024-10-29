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
 * App\InsiderUserPasswordChangesHistory
 *
 * @property int $id
 * @property int $insider_user_id
 * @property string|null $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\InsiderUser $insiderUser
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordChangesHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordChangesHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordChangesHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordChangesHistory whereInsiderUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordChangesHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordChangesHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordChangesHistory whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordChangesHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InsiderUserPasswordChangesHistory extends Authenticatable
{
    use Notifiable;

    protected $table = 'insider_user_password_changes_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'insider_user_id', 'ip'
    ];

    /**
     * @return BelongsTo
     */
    public function insiderUser(): BelongsTo
    {
        return $this->belongsTo(InsiderUser::class);
    }
}
