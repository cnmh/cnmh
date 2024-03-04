<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class ConsultationMidddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        //Get params
        $params = $request->model;
        //Define model
        $model = 'App\\Models\\' . ucfirst($params);
        //check if subclass model
        if (is_subclass_of($model, 'App\\Models\\Consultation')) {

            return $next($request);

        }if(ucfirst($request->model) == "Liste-attente"){

            return $next($request);

        } else {
            abort(404);
        }
    }
}
