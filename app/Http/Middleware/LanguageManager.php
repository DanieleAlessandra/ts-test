<?php

namespace App\Http\Middleware;

use Closure;
use App;

class LanguageManager {

    const LOCALES = [
        'en',
        'es',
        'it'
    ];

    public function handle( $request, Closure $next )
    {
        $route_locale = $request->route( 'lang' );
        $locale = $route_locale;

        if ( is_null( $locale ) ) {
            if ( session()->has( 'locale' ) ) {
                $locale = session()->get( 'locale' );
            } else {
                $locale = $request->getPreferredLanguage( self::LOCALES );
            }
        }

        if ( ! in_array( $locale, self::LOCALES, true ) ) {
            $locale = 'en';
        }

        /**
         * Session Language is the same of Route language?
         */
        if ($route_locale !== $locale) {
            return redirect("$locale/home");
        }

        session()->put( 'locale', $locale );
        App::setLocale( $locale );

        return $next( $request );
    }
}
