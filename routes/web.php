<?php

Route::get('/', 'RegistroController@principal')->name('inicio_sesion')->middleware('Authentication');
Route::get('/register', 'RegistroController@formReg')->name("register");

Route::get('cambio', 'UsuariosController@cambio')->name("cambio");
Route::post('bcamcla', 'UsuariosController@bcamcla')->name("bcamcla");
Route::post('cambiodos', 'UsuariosController@cambiodos')->name("cambiodos");
Route::post('selecccionado', 'UsuariosController@selecccionado')->name("selecccionado");
Route::post('resetear', 'UsuariosController@resetear')->name("resetear");


Route::get('/logout', function() {
    Session::flush();
    return redirect()->route("inicio_sesion");
})->name("cerrar_sesion");



Route::middleware("Authentication")->prefix('admin')->group(function() {
    Route::get('/', 'MainController@principal')->name("principal");
    Route::get('/edit_perfil', 'UsuariosController@eperfil')->name('edit_perfil');
    Route::post('municipio', 'RegistroController@municipio');
    Route::post('parroquia', 'RegistroController@parroquia');
    Route::post('actualizarData', 'UsuariosController@actualizarData');
    Route::get('cambclv', 'UsuariosController@cambclv')->name("cambclv");
    Route::post('resetear', 'UsuariosController@resetear')->name("resetear");

    //////////////////////////////////////////////
    Route::get('/reg_pro', 'ProductoController@registerPro')->name("reg_pro");
    Route::post('/prod_sar', 'ProductoController@sub_area'); 
    Route::post('/prod_esp', 'ProductoController@especialidad'); 
    Route::get('/reg_up', 'ProductoController@index')->name("reg_up");
    Route::post('/deletepro', 'ProductoController@deletepro')->name("deletepro");
    /////////////////////////////////////////////
    
});

Route::middleware('AuthAjax')->group(function() {
    Route::post('/check', 'UsuariosController@checkAction')->name('login_check');
    Route::post('/bcacedula', 'RegistroController@bcacedula');
    Route::post('municipio', 'RegistroController@municipio');
    Route::post('parroquia', 'RegistroController@parroquia');
    Route::post('/procesar', 'RegistroController@procesamiento')->name("procesar");

    Route::post('/procInf', 'ProductoController@proc_reg_pro')->name('procInf');
});
