<?php

namespace App\Http\Middleware;

use Closure;
use GeoIP;

class blockAccessByIp
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $blockIPs = [
            // '91.180.89.51',
        ];
        $blockCities = [
            // 'brussels',
        ];
        $blockCountries = [
            // 'AF' => 'Afghanistan',
            // 'BS' => 'Bahamas',
            // 'BI' => 'Burundi',
            // 'CF' => 'Central African Republic',
            // 'CG' => 'Congo',
            // //'' => 'Crimea',
            // 'CU' => 'Cuba',
            // 'CD' => 'Democratic Republic of Congo',
            // 'ER' => 'Eritrea',
            // 'HT' => 'Haiti',
            // 'IR' => 'Iran',
            // 'IL' => 'Israel',
            // 'LY' => 'Libya',
            // 'MM' => 'Myanmar',
            // 'NI' => 'Nicaragua',
            // 'KP' => 'North Korea',
            // 'PA' => 'Panama',
            // 'SO' => 'Somalia',
            // 'SD' => 'Sudan',
            // 'SY' => 'Syria',
            // 'TM' => 'Turkmenistan',
            // 'UM' => 'United States Minor Outlying Islands',
            // 'US' => 'USA',
            // 'VI' => 'Virgin Islands, US',
            // 'EH' => 'Western Sahara',
            // 'YE' => 'Yemen',
            // 'ZW' => 'Zimbabwe', 
        ];

        // if (strtoupper(@GeoIP::getLocation()['iso_code']) === 'US')
        //     die('.');

        return $next($request);
    }
}
