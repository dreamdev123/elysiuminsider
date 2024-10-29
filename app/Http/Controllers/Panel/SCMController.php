<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Services\FileStorageProofService;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Log;
use Illuminate\Http\Request;
use RuntimeException;

class SCMController extends Controller
{
    public function connect()
    {
        $user = auth()->user();

        if ('not_connected' !== $user->scm_status) {
            return redirect(route('home'));
        }

//     We have done some changes to that endpoint to make it easier for third party apps to use.
//
//    If you miss off the email you will get a proper error message.
//    We now send back the application key and status
//
//      If the application is a new one you will receive back
//
//{
//    "appKey": "f2109cdf05134cb4b1d8ece041a7cef4",
//    "status": "added"
//}
//
//If you resend an application for the same email you will get back
//{
//    "appKey": "f2109cdf05134cb4b1d8ece041a7cef4",
//    "status": "open"
//}
//
//Open means that they are working on it
//
//Other status values are:
//rejected  - SCM already reviewed the app and declined it
//accepted – SCM reviewed the app and opened an account
//


        $userData = [
            'ibkey' => config('quum.api.ibkey'),
//            'appkey' => '', // we can set but we're getting that filed from API (looks like md5)
            'firstname' => $user->first_name,
            'lastname' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'street' => $user->street_address,
            'city' => $user->city,
            'zip' => $user->postal_code,
            'state' => $user->state,
            'country' => $user->country->name,
            'dob' => $user->birth_date,
            'accountType' => $user->accountInformation->account_type,
            'currencyType' => $user->accountInformation->currency,
            'platformMT4' => $user->accountInformation->platform, // TODO ??? must be Y value ???
            'clientType' => $user->accountInformation->client,
            'purpose' => $user->accountInformation->purpose,
            'avarageVolume' => $user->accountInformation->avarge_trading_volume,
            'leverage' => $user->accountInformation->leverage,
            'experience' => $user->accountInformation->experience_years,
            'frequency' => $user->accountInformation->trading_frequency,
            'grossIncome' => $user->additionalInformation->estimate_annual_gross_income,
            'netWorth' => $user->additionalInformation->net_worth,
            'incomeSource' => $user->additionalInformation->income_source,
            'education' => $user->additionalInformation->education,
            'language' => $user->additionalInformation->language,
            'publicPositionYesNo' => $user->additionalInformation->public_position_held,
            'publicPosition' => $user->additionalInformation->public_position_details,
            'proofOfIdentity' => base64_encode(FileStorageProofService::getUserProofFile($user, 'national_id')),
            'proofOfResidence' => base64_encode(FileStorageProofService::getUserProofFile($user, 'utility_bill'))
        ];

        // dd($userData);

        $options = [
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ];

        try {
            $client = new Client($options);
            $response = $client->post(config('quum.api.url') . 'addapplication', [
                'form_params' => $userData,
            ]);

            $apiData = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);

            // save2user
            $user->scm_status = $apiData['status'];
            $user->scm_app_key = $apiData['appKey'];
            $user->save();

        } catch (RuntimeException $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_THROW_ON_ERROR, 512));
        }

        return redirect(route('home'));
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function getScmCashCallbacks(): JsonResponse
    {
        $user = auth()->user();

        return datatables()->of($user->scmCashCallbacks())->toJson();

    }

    public function getScmCashBalances(): JsonResponse
    {
        $user = auth()->user();

        return datatables()->of($user->scmCashBalance())->toJson();

    }
}
