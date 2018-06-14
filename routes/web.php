<?php
Route::get('/', function () {
 return redirect("home");
});
 
Route::get('/home', 'HomeController@index');
Route::get('/carteirinha', 'ReportController@carteirinhaReport')->middleware('checkInstitution');

