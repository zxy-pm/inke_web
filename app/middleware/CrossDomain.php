<?php


namespace app\middleware;


use Closure;


class CrossDomain
{
    public function handle($request, Closure $next, ?array $header = [])
    {
        header('Access-Control-Allow-Origin: http://127.0.0.1:8080', true);
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 1800');
        header('Access-Control-Allow-Methods: GET,DELETE,PUT, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-CSRF-TOKEN, X-Requested-With');
        return $next($request);
    }
}