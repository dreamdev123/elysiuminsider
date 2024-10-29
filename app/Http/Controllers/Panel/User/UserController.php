<?php

namespace App\Http\Controllers\Panel\User;

use App\InsiderUser;
use App\InsiderUserAccountInformation;
use App\InsiderUserAdditionalInformation;
use App\InsiderUserOnBoarding;
use App\Country;
use App\InsiderMails;
use App\InsiderNews;
use Carbon\Carbon;
use App\InsiderUserScmCashBalance;
use App\Http\Controllers\Controller;
use App\Http\Validators\Panel\User\AccountInformationValidator;
use App\Http\Validators\Panel\User\AdditionalInformationValidator;
use App\Http\Validators\Panel\User\PersonalInformationValidator;
use App\Http\Validators\Panel\User\ProofOfIdentityAndResidenceValidator;
use App\Http\Validators\Panel\User\PersonalInfoValidator;
use App\Http\Validators\Panel\User\AccountInfoValidator;
use App\Http\Validators\Panel\User\LegalInfoValidator;
use Illuminate\Support\Facades\Auth;
use App\InsiderUserScmCashCallback;
use App\Mail\EmailVerification;
use App\Services\FileStorageProofService;
use App\User;
use Exception;
use Hash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Mail;
use Ramsey\Uuid\Uuid;
use View;
use Torann\GeoIP\Facades\GeoIP;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function index(Request $request)
    {
        $stage = $request->route()->getName();
        if (!in_array($stage, InsiderUserOnBoarding::$requiredSatges, true)) {

            if (!$stage) {
                return redirect(route('home'));
            }

            return redirect(route('home'));
        }

        $user = auth()->user();


        // create empty account_information
        $accountInformation = $user->accountInformation;

        if (!$accountInformation) {
            $accountInformation = new InsiderUserAccountInformation();
            $accountInformation->capital_user_id = $user->id;
            $accountInformation->save();
            $user->refresh();
        }

        // create emptu additional_information
        $additionalInformation = $user->additionalInformation;


        if (!$additionalInformation) {
            $additionalInformation = new InsiderUserAdditionalInformation();
            $additionalInformation->capital_user_id = $user->id;
            $additionalInformation->save();
            $user->refresh();
        }

        $array = [
            'countries' => Country::where([
                'active' => true
            ])->get(),
            'affiliate' => User::where(['id' => $user->sponsor_id])->first()->username];

        if($stage == 'proof_of_identity_and_residence')
        {
            $array['proofNationalBase64'] = base64_encode(FileStorageProofService::getUserProofFile($user, 'national_id'));
            $array['proofUtilityBillBase64'] = base64_encode(FileStorageProofService::getUserProofFile($user, 'utility_bill'));
        }

        $array['onboarding'] = false;
        $onboarding = InsiderUserOnBoarding::where('capital_user_id', $user->id)->first();
        if(!$onboarding->personal_information || !$onboarding->account_information || !$onboarding->additional_information || !$onboarding->proof_of_identity_and_residence)
            $array['onboarding'] = true;

        return view('panel.user.' . $stage)->with($array);
    }

    public function rorCalculator(Request $request) {
        return view('panel.ror_calc');
    }

    public function getremote()
    {
        $url = 'https://scandinavianmarkets.com/open-account-elysium-capital/';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);

        $DOM = new \DOMDocument;
        @$DOM->loadHTML( $output);

        $finder = new \DomXPath($DOM);
        $classname="elementor-section";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

        // $nodes = $DOM->getElementsByClassName("elementor-section-wrap");

        foreach ($nodes as $key_node => $node) {
            $attributes = $node->attributes;
            //echo $key_node . '<br/>';
            foreach ($attributes as $key => $attr) {
                if($attr->name == "class")
                {
                    $classname = $attr->value;
              //      echo $classname . '<br/>';
                    $class_array = preg_split('/ /',$classname);
                    if(!in_array('elementor-element-75003e8', $class_array) && !in_array('elementor-element-6d7d28e', $class_array))
                    {
                        if($node->parentNode)
                        {
                            $node->parentNode->removeChild($node);    
                        }
                        
                        break;
                    }
                }
            }
        }
        //exit;

        $node_iframe = $DOM->getElementsByTagName('iframe');
        foreach ($node_iframe as $key => $iframe) {
            $iframe->parentNode->removeChild($iframe);
        }

        $node_header = $DOM->getElementsByTagName('header');
        foreach ($node_header as $key => $node) {
            $node->parentNode->removeChild($node);
        }

        $node_footer = $DOM->getElementsByTagName('footer');
        foreach ($node_footer as $key => $footer) {
            $footer->parentNode->removeChild($footer);
        }

        $node_body = $DOM->getElementsByTagName("body");
        
        

        return $DOM->saveHTML();
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function personalInformation(Request $request)
    {
        $validateData = new PersonalInformationValidator();
        $validator = $validateData->validate($request);

        if ($validator->fails()) {
            return redirect(route('user::personal_information'))
                ->withErrors($validator->errors())
                ->withInput($request->input());
        }

        $user = auth()->user();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->country = $request->get('country_id');
        $user->phone = $request->get('phone');
        $user->street_name = $request->get('street_address');
        $user->city = $request->get('city');
        $user->postal_code = $request->get('postal_code');
        $user->state = $request->get('state');
        $user->birth_date = $request->get('birth_date');
        $user->push();

        $user->onboarding()->update([
            'personal_information' => true
        ]);

        return redirect(route('home'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function accountInformation(Request $request)
    {
        $validateData = new AccountInformationValidator();
        $validator = $validateData->validate($request);

        if ($validator->fails()) {
            return redirect(route('user::account_information'))
                ->withErrors($validator->errors())
                ->withInput($request->input());
        }

        $user = auth()->user();

        $user->accountInformation->update($request->all());

        $user->onboarding()->update([
            'account_information' => true
        ]);

        return redirect(route('home'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function additionalInformation(Request $request)
    {
        $validateData = new AdditionalInformationValidator();
        $validator = $validateData->validate($request);

        if ($validator->fails()) {
            return redirect(route('user::additional_information'))
                ->withErrors($validator->errors())
                ->withInput($request->input());
        }

        $user = auth()->user();

        $user->additionalInformation->update($request->all());

        $user->onboarding()->update([
            'additional_information' => true
        ]);

        return redirect(route('home'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function proofOfIdentityAndResidence(Request $request)
    {
        $validateData = new ProofOfIdentityAndResidenceValidator();
        $validator = $validateData->validate($request);

        if ($validator->fails()) {
            return redirect(route('user::proof_of_identity_and_residence'))
                ->withErrors($validator->errors())
                ->withInput($request->input());
        }

        // national
        FileStorageProofService::putUserProofFile(auth()->user(), $request, 'national_id');

        // utility
        FileStorageProofService::putUserProofFile(auth()->user(), $request, 'utility_bill');

        $user = auth()->user();
        $user->onboarding()->update([
            'proof_of_identity_and_residence' => true
        ]);

        return redirect(route('home'));
    }

    /**
     * @param null $send
     * @return Factory|RedirectResponse|Redirector|\Illuminate\View\View
     * @throws Exception
     */
    public function verifyEmail($send = null)
    {
        $user = auth()->user();

        // do not allow to resend if confirmed
        if ($user->onboarding->verify_email) {
            return redirect(route('home'));
        }

        // resend verification
        if ($send) {

            $uuid4 = Uuid::uuid4();
            $token = $uuid4->toString();

            $user->email_verification_token = $token;
            $user->save();

            Mail::to($user->email)
                ->send(new EmailVerification($user, route('verify_email_token', ['token' => $token])));

            return redirect(route('verify_email'))->with([
                'resend' => true
            ]);

        }

        return view('panel.user.verify_email');
    }

    /**
     * @param $token
     * @return RedirectResponse|Redirector
     */
    public function verifyEmailToken($token)
    {
        $user = auth()->user();

        $user = InsiderUser::where([
            'id' => $user->id,
            'email_verification_token' => $token
        ])->first();


        if ($user) {

            $user->onboarding()->update([
                'verify_email' => true
            ]);
            $user->email_verified_at = now();
            $user->save();

            return redirect(route('home'))->with([
                'emailVerified' => true
            ]);

        }

        return redirect(route('verify_email'));
    }
}
