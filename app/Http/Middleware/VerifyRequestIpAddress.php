<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use GeoIp2\Database\Reader;

class VerifyRequestIpAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    protected $allowedCountries = ['NL', 'BE'];
    protected $localIps = ['127.0.0.1', '::1'];
    public function handle(Request $request, Closure $next): Response
    {
         // Toestaan als het een lokaal IP is (bijv. tijdens development)
        if (in_array($request->ip(), $this->localIps)) {
            return $next($request);
        }

        try {
            $reader = new Reader(storage_path('app/GeoLite2-Country.mmdb'));
            $record = $reader->country($request->ip());

            if (!in_array($record->country->isoCode, $this->allowedCountries)) {
                abort(403, 'Access restricted to NL and BE');
            }
        } catch (\Exception $e) {
            // Optioneel: loggen of fallback bij IP's die niet gevonden worden
            abort(403, 'Geolocation lookup failed or IP not allowed');
        }
        return $next($request);
    }
}
