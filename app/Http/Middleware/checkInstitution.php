<?php

namespace App\Http\Middleware;

use Closure;
use \App\Http\Controllers\InstitutionController;

class checkInstitution
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

      
        $institution_id = $request->institution_id;

       if(isset($institution_id) && !is_null($institution_id)){

         $institutionController = new InstitutionController(new \App\Models\Institution);
            $institution = $institutionController->show($institution_id);
     \Config::set('database.connections.tenant', array(
            'driver'    => 'pgsql',
            'host'      => $institution[0]['host'],
            'database'  => $institution[0]['database'],
            'username'  => $institution[0]['username'],
            'password'  => $institution[0]['password'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ));
          \Config::get('database.connections.tenant');
    
       }
  
      


      
   

        return $next($request);
    }
}
