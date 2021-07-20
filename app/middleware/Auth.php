<?php


namespace app\middleware;


use Closure;

class Auth
{
    public function handle($request, Closure $next, ?array $header = [])
    {
        //防止sql注入,把所有的参数都给他过滤一遍
//        $param = request()->param();
//        if ($param) {
//            foreach ($param as $k => $v) {
//                $param[$k] = htmlspecialchars(trim($v));
//            }
//        }
//        if ($request->isPost())
//            $request->withPost($param);
//        if ($request->isGet())
//            $request->withGet($param);
        return $next($request);
    }
}