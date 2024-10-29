<?php

namespace App\Services\SCMCallbackService;

use App\InsiderUser;
use App\InsiderUserScmCashCallback;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RuntimeException;

class SCMCallbackService
{
    public const appKey = 'appkey';

    public static function dispatchMessage(array $message): void
    {
        switch ($message['MessageType']) {
            case 'application':
                (new self)->processApplicationMessage($message);
                break;
            case 'newaccount':
                (new self)->processNewAccountMessage($message);
                break;
            case 'trade':
                (new self)->processTradeMessage($message);
                break;
            case 'cash':
                (new self)->processCashMessage($message);
                break;
            default:
                // move to failed_jobs
                throw new RuntimeException('Unhandled MessageType');
        }
    }

    /**
     * @param string $appKey
     * @return Builder|Model
     */
    private function getUserByAppKey(string $appKey = null)
    {
        if (null === $appKey) {
            throw new RuntimeException('appkey is null !');
        }

        try {
            $user = InsiderUser::where([
                'scm_app_key' => $appKey
            ])->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new RuntimeException('No user found for appkey: ' . $appKey);
        }

        return $user;
    }

    /**
     * @param array $message
     */
    private function processNewAccountMessage(array $message): void
    {
        $user = $this->getUserByAppKey($message[self::appKey]);

        $user->scm_login = $message['login'];
        $user->save();
    }

    /**
     * @param array $message
     */
    private function processApplicationMessage(array $message): void
    {
        $scmStatusesMap = [
            'Rejected' => 'rejected',
            'Received' => 'not_connected',
            'Open' => 'open',
            'Accepted' => 'accepted'
        ];

        $user = $this->getUserByAppKey($message[self::appKey]);

        $user->scm_status = $scmStatusesMap[$message['appstatus']];
        $user->save();
    }

    /**
     * @param array $message
     */
    private function processCashMessage(array $message): void
    {
        $user = $this->getUserByAppKey($message[self::appKey]);

        if (!$user->scm_login) {
            $user->scm_login = $message['login'];
            $user->save();
        }

        // add cash items
        $cash = new InsiderUserScmCashCallback();
        $cash->message_id = $message['id'];
        $cash->ticket_id = $message['ticket'];
        $cash->group = $message['group'];
        $cash->currency = $message['currency'];
        $cash->amount = $message['amount'];
        $cash->deposit = $message['amount'] > 0 ? $message['amount'] : null;
        $cash->withdrawal = $message['amount'] < 0 ? $message['amount'] : null;
        $cash->comment = $message['comment'];
        $cash->time = $message['time'];

        $user->scmCashCallbacks()->save($cash);
    }

    /**
     * @param array $message
     */
    private function processTradeMessage(array $message): void
    {
//        $user = $this->getUserByAppKey($message[self::appKey]);

        // TODO: maybe is worth to check if scm_login null -> update from that message?

//        print_r($message);

        /*
         * Array
        (
            [MessageType] => trade
            [id] => 493
            [appkey] => 6bfd8973f2654541b49aebc545997055
            [ticket] => 51916789
            [login] => 1950794
            [symbol] => XAUUSD.swd
            [side] => Buy
            [quantity] => 1.000000
            [price] => 1555.920000
            [profit] => 0
            [type] => O
            [comment] =>
            [opentime] => 2020-01-15 16:03:32.0000000
            [openprice] => 1555.920000
            [sl] => 0.000000
            [tp] => 0.000000
            [closetime] => 1970-01-01 00:00:00.0000000
            [closeprice] => 1555.780000
            [reason] => TR_REASON_CLIENT
            [contractsize] => 100.000000
            [realquantity] => 100.000000
            [usdquantity] => 155556.000000
            [group] => demoSCM_PRM-usd
            [state] => TS_OPEN_NORMAL
        )*/

        /*
         * Array
        (
            [MessageType] => trade
            [id] => 487
            [appkey] => 6bfd8973f2654541b49aebc545997055
            [ticket] => 51916775
            [login] => 1950794
            [symbol] => XAUUSD.swd
            [side] => Buy
            [quantity] => 1.000000
            [price] => 1556.360000
            [profit] => 0
            [type] => O
            [comment] =>
            [opentime] => 2020-01-15 16:02:13.0000000
            [openprice] => 1556.360000
            [sl] => 0.000000
            [tp] => 0.000000
            [closetime] => 1970-01-01 00:00:00.0000000
            [closeprice] => 1556.210000
            [reason] => TR_REASON_CLIENT
            [contractsize] => 100.000000
            [realquantity] => 100.000000
            [usdquantity] => 155609.000000
            [group] => demoSCM_PRM-usd
            [state] => TS_OPEN_NORMAL
        )*/


    }
}
