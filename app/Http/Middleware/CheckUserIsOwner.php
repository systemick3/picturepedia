<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;

use Closure;

class CheckUserIsOwner
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
    $currentUserId = auth()->id();
    if ($request->id != $currentUserId) {
      return new Response('Forbidden', 403);
    }
    return $next($request);
  }
}
