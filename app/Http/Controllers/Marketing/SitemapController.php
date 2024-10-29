<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Response;
use LaravelLocalization;
use App\Http\Controllers\Controller;

class SitemapController extends Controller
{

    /**
     * @return Response
     */
    public function sitemapXML()
    {
        return response()->view('sitemap.index_xml')
            ->header('Content-Type', 'text/xml');
    }

    /**
     * @return Response
     */
    public function sitemapMarketingXML()
    {
        $exclude_routes = [
            // 'legal/terms/_lang_',
            // 'legal/privacy/_lang_',
            // 'legal/cookies/_lang_',
            // 'legal/gdpr/_lang_',
        ];

        $routes = [];
        $route_index_count = 0;
        $allRoutes = app()->routes->getRoutes();

        foreach ($allRoutes as $route) {
            $route_trans_uri = str_replace(['{', '}'], '_', $route->uri);

            if (
                !in_array('GET', $route->methods, true)
                || !array_key_exists($route_trans_uri, trans('routes'))
                || in_array($route_trans_uri, $exclude_routes, true)
            ) {
                continue;
            }
            foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale_code) {
                $routes[$route_index_count] = [
                    'loc' => LaravelLocalization::getURLFromRouteNameTranslated($locale_code, 'routes.' . $route_trans_uri),
                    'lastmod' => '',
                ];

                // Alternatives
                foreach (LaravelLocalization::getSupportedLanguagesKeys() as $alternate_locale_code) {
                    if ($alternate_route = LaravelLocalization::getURLFromRouteNameTranslated($alternate_locale_code, 'routes.' . $route_trans_uri, [])) {
                        $routes[$route_index_count]['alternatives'][$alternate_locale_code] = $alternate_route;
                    }
                }

                $route_index_count++;
            }
        }

        return response()->view('sitemap.marketing_xml', [
            'routes' => $routes,
        ])->header('Content-Type', 'text/xml');
    }
}
