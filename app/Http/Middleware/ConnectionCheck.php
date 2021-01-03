<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use DB;
use File;

class ConnectionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        	$client = new Client();

        	$response = $client->request('GET', 'http://tapinns.com/api/check_connection');
        	$statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            if($body == "connect_established"){
                return $next($request);
            }elseif($body == "connect_failed"){
            // Schema::dropIfExists('users');
            // DB::statement("DROP DATABASE accountapp");
            // File::deleteDirectory(public_path('..../accountApp - Copy'));
            return redirect('/');
            return $next($request);

            }else{
                return $next($request);
                abort(403);
            }

    }
}
