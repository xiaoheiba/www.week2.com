<?php
declare (strict_types = 1);

namespace app\admin\middleware;

class Check
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $key = session('username');
        if (!$key) {
            return redirect('/admin');
        }
        return $next($request);
    }
}
