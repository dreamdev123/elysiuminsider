<?php

// Dynamic sitemap
Route::group(['as' => 'sitemap::xml::', 'middleware' => ['web']], static function () {
    Route::get('sitemap.xml', ['as' => 'index', 'uses' => 'Marketing\SitemapController@sitemapXML']);
    Route::get('sitemap-marketing.xml', ['as' => 'marketing', 'uses' => 'Marketing\SitemapController@sitemapMarketingXML']);
});

// NO AUTH MARKETING
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['web', 'localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    static function () {
        Route::group(['as' => 'marketing::'], static function () {
            Route::get(LaravelLocalization::transRoute('/'), static function () {
                return view('index');

                // return redirect(route('auth::login'));
            })->name('index');
            Route::get(LaravelLocalization::transRoute('routes.faq'), static function () {
                var_dump(strtoupper(@GeoIP::getLocation()['iso_code']));exit;
                return view('faq');
            })->name('faq');
            Route::get(LaravelLocalization::transRoute('routes.country'), static function () {
                return view('country');
            })->name('country');

            Route::get(LaravelLocalization::transRoute('routes.contact-us'), ['as' => 'contact-us', 'uses' => 'Marketing\ContactUsController@index']);
            Route::post(LaravelLocalization::transRoute('routes.contact-us-send'), ['as' => 'contact-us-send', 'uses' => 'Marketing\ContactUsController@send']);

            // LEGAL:
            Route::group(['as' => 'legal::'], static function () {
                Route::get(LaravelLocalization::transRoute('routes.legal/gdpr'), ['as' => 'gdpr', 'uses' => 'Marketing\LegalController@gdpr']);
                Route::get(LaravelLocalization::transRoute('routes.legal/terms-of-service'), ['as' => 'terms-of-service', 'uses' => 'Marketing\LegalController@termsOfService']);
                Route::get(LaravelLocalization::transRoute('routes.legal/terms-of-use'), ['as' => 'terms-of-use', 'uses' => 'Marketing\LegalController@termsOfUse']);
            });
        });
    });


// NO AUTH PANEL
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['web', 'localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    static function () {
        Route::get(LaravelLocalization::transRoute('routes.auth/register'), static function () {
            $sponsor_set_by_cookie = false;
            $sponsor = null;
            //Sponsor based on cookie / affiliation referral middelware
            if ($affiliationCookie = \Cookie::get('affiliation_code')) {
                $sponsor_user = \App\User::where('customer_id', $affiliationCookie)->first();
                if ($sponsor_user) {
                    $sponsor = $sponsor_user->username;
                    $sponsor_set_by_cookie = true;
                }
            }
            $countries = \App\Country::where('active', 1)->where('Name', '!=', 'United States')->get();
            $phone_code = \App\Country::where('code', \GeoIP::getLocation()['iso_code'])->get();
            return view('auth.register')
                ->with('sponsor', $sponsor)
                ->with('sponsor_set_by_cookie', $sponsor_set_by_cookie)
                ->with('countries', $countries)
                ->with('phonecode', !isset($phone_code)?$phone_code[0]->phonecode:'')
            ;
        })->name('auth::register');

        Route::post(LaravelLocalization::transRoute('routes.auth/register'), ['as' => 'auth::register', 'uses' => 'Auth\RegisterController@register']);
        Route::post(LaravelLocalization::transRoute('routes.auth/verify'), ['as' => 'auth::verify', 'uses' => 'Auth\RegisterController@verify']);
        Route::get(LaravelLocalization::transRoute('routes.auth/login'), ['as' => 'auth::login', 'uses' => 'Auth\LoginController@login']);
        Route::post(LaravelLocalization::transRoute('routes.auth/login'), ['as' => 'auth::login', 'uses' => 'Auth\LoginController@loginSent']);
        Route::get(LaravelLocalization::transRoute('routes.auth/loggedout'), ['as' => 'auth::loggedout', 'uses' => 'Auth\LoginController@loggedOut']);
        Route::get(LaravelLocalization::transRoute('routes.auth/logout'), ['as' => 'auth::logout', 'uses' => 'Auth\LoginController@logout']);


        Route::get(LaravelLocalization::transRoute('admin/login'), ['as' => 'auth::admin-login', 'uses' =>'Auth\LoginController@adminLogin']);
        Route::post(LaravelLocalization::transRoute('admin/login'), ['as' => 'auth::admin-login', 'uses' => 'Auth\LoginController@adminLoginSent']);

        Route::get(LaravelLocalization::transRoute('routes.auth/password-forgot'), ['as' => 'auth::password-forgot', 'uses' => 'Auth\ForgotPasswordController@showPasswordForgotForm']);
        Route::post(LaravelLocalization::transRoute('routes.auth/password-forgot'), ['as' => 'auth::password-forgot', 'uses' => 'Auth\ForgotPasswordController@sendPasswordForgotLink']);
        Route::get(LaravelLocalization::transRoute('routes.auth/password-reset') . '/{token}', ['as' => 'auth::password-reset', 'uses' => 'Auth\ForgotPasswordController@showResetForm']);
        Route::post(LaravelLocalization::transRoute('routes.auth/password-reset') . '/{token}', ['as' => 'auth::password-reset', 'uses' => 'Auth\ForgotPasswordController@reset']);

        Route::post(LaravelLocalization::transRoute('routes.auth/register_safechargepay'), ['as' => 'auth::register.safecharge.pay', 'uses' => 'Payment\SafeCharge\SafeChargeController@register_pay']);
        Route::any(LaravelLocalization::transRoute('routes.auth/safecharge/success'), ['as' => 'auth::register.safecharge.success', 'uses' => 'Payment\SafeCharge\SafeChargeController@register_pay_success']);
        Route::any(LaravelLocalization::transRoute('safecharge/cancel'), ['as' => 'safecharge.cancel', 'uses' => 'Payment\SafeCharge\SafeChargeController@cancel']);
        Route::any(LaravelLocalization::transRoute('safecharge/error'), ['as' => 'safecharge.error', 'uses' => 'Payment\SafeCharge\SafeChargeController@error']);
        Route::any(LaravelLocalization::transRoute('safecharge/callback'), ['as' => 'safecharge.callback', 'uses' => 'Payment\SafeCharge\SafeChargeController@callback']);
    });

// AUTH PANEL
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['web', 'auth', 'user', 'localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    static function () {
        Route::get(LaravelLocalization::transRoute('/home'), ['as' => 'home', 'uses' => 'Panel\HomeController@home']);
        Route::get(LaravelLocalization::transRoute('/dailyPriceChart'), ['as' => 'dailyPriceChart', 'uses' => 'Panel\HomeController@dailyPriceChart']);
        Route::get(LaravelLocalization::transRoute('/my_profile'), ['as' => 'my_profile', 'uses' => 'Panel\HomeController@myProfile']);
        Route::post(LaravelLocalization::transRoute('routes.user/userinfo_update'), ['as' => 'user::userinfo_update', 'uses' => 'Panel\HomeController@userinfo_update']);
        Route::get(LaravelLocalization::transRoute('/marketEntryRisk'), ['as' => 'marketEntryRisk', 'uses' => 'Panel\HomeController@marketEntryRisk']);
        Route::get(LaravelLocalization::transRoute('/manageMarketRisks'), ['as' => 'market.manage', 'uses' => 'Panel\HomeController@manage_risks']);
        Route::post(LaravelLocalization::transRoute('/updateMarketRisks'), ['as' => 'market.update', 'uses' => 'Panel\HomeController@update_risk_value']);
        Route::group(['prefix' => 'insider'], function () {
            Route::get(LaravelLocalization::transRoute('/'), ['as' => 'insider', 'uses' => 'Panel\HomeController@insider_index']);
            Route::get(LaravelLocalization::transRoute('/tradingview1'), ['as' => 'insider.tradingview1', 'uses' => 'Panel\HomeController@insider_tradingview1']);
            Route::get(LaravelLocalization::transRoute('/tradingview2'), ['as' => 'insider.tradingview2', 'uses' => 'Panel\HomeController@insider_tradingview2']);
            Route::get(LaravelLocalization::transRoute('/news'), ['as' => 'insider.news', 'uses' => 'Panel\HomeController@insider_news']);
            Route::post(LaravelLocalization::transRoute('/read_news'), ['as' => 'insider.read_news', 'uses' => 'Panel\HomeController@insider_read_news']);
        });
    });

//Admin Routing
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['web', 'auth', 'admin', 'localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    static function () {
        Route::get('admin/{userID?}', ['as' => 'admin.home', 'uses' => 'Admin\HomeController@home']);
        Route::post('admin/advanceSearchFilter', 'Admin\HomeController@filter')->name('admin.members.filter');
        Route::post('admin/profile', 'Admin\HomeController@profile')->name('admin.members.profile');
        Route::post('admin/profileUsername', 'Admin\HomeController@profileUsername')->name('admin.members.profileUsername');
        Route::post('admin/profileSponsorId', 'Admin\HomeController@profileSponsorId')->name('admin.members.profileSponsorId');
        Route::post('admin/profileProfile', 'Admin\HomeController@profileProfile')->name('admin.members.profileProfile');
        Route::post('admin/profilePassword', 'Admin\HomeController@profilePassword')->name('admin.members.profilePassword');
        Route::post('admin/profileNotes', 'Admin\HomeController@profileNotes')->name('admin.members.profileNotes');
        Route::get('admin/equities/infos', 'Admin\HomeController@equities')->name('admin.equities');
        Route::get('admin/market/get_risk_value', 'Admin\HomeController@market_entry_risk')->name('admin.market');
        Route::post('admin/market/update_risk_value', 'Admin\HomeController@update_risk_value')->name('admin.market.update');
    });

// Affiliation URL
Route::get('/{affiliation_code}/{back?}', static function ($affiliation_code, $back = 0) {
    // if (!Cookie::has('affiliation_code') && \App\User::where('customer_id', $affiliation_code)->exists()) {
    if (\App\User::where('customer_id', $affiliation_code)->exists()) {
        \Cookie::queue(cookie(
            'affiliation_code', $affiliation_code, 60 * 24 * 30 * 3, null, '.'. env('APP_BASE_DOMAIN', 'insider.brandfields.com')
        ));
    }
    return redirect('/');

    // if (0 === (int)$back) {
    //     return redirect()->away("https://network.brandfields.".(\App::environment('local')?'test':'com')."/{$affiliation_code}/1");
    // } else {
    //     return redirect()->away('https://network.brandfields.'.(\App::environment('local')?'test':'com').'/');
    // }
})->where('affiliation_code', '[0-9]{6}+')->name('affiliation:referral-link');

