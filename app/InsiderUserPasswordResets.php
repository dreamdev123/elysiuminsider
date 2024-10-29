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
 * App\InsiderUserPasswordResets
 *
 * @property int $id
 * @property int $insider_user_id
 * @property string $token
 * @property string|null $generated_ip
 * @property string|null $used_ip
 * @property string|null $used_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\InsiderUser $insiderUser
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordResets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordResets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordResets query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordResets whereInsiderUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordResets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordResets whereGeneratedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordResets whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordResets whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordResets whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordResets whereUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InsiderUserPasswordResets whereUsedIp($value)
 * @mixin \Eloquent
 */
class InsiderUserPasswordResets extends Authenticatable
{
    use Notifiable;

    protected $table = 'insider_user_password_resets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'used_ip', 'used_at'
    ];

    /**
     * @return BelongsTo
     */
    public function insiderUser(): BelongsTo
    {
        return $this->belongsTo(InsiderUser::class);
    }
}
