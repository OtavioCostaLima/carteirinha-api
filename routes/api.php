<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v2'
  ,'middleware' => ['checkInstitution'
  , 'auth:api'
  ]
  ], 
  function(){

   Route::resource('classes', 'ClassController', ['except' => ['edit', 'create']]);

    Route::resource('students', 'StudentController', ['except' => ['edit', 'create']]);

  Route::get('class/{id}/students','ClassController@getStudentsByClass')->where('id', '[0-9]+');

  Route::resource('points','PontoController');
  Route::get('points/students/now','StudentController@getStudentsToday');
  Route::get('points/students/flow','StudentController@getStudents');


  Route::get('reports/points', 'ReportController@pointsReport');
  Route::get('reports/carteirinha','ReportController@carteirinhaReport');


  Route::get('/institution/students','StudentController@index');

 Route::get('parents/{id}','ParentController@show');
 Route::post('users','UserController@store');

});


   Route::post('v2/institutions', 'DataBaseController@create');    
   Route::get('v2/institutions', 'InstitutionController@index');  
   Route::get('v2/institutions/{id}', 'InstitutionController@show');  
 Auth::routes();