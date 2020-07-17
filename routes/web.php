<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true,'register' => false]);

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});
Route::get('/', 'HomeController@index')->name('home')->middleware(['verified','auth']);


Route::resource('api/roles', 'RoleController');
Route::get('roles', 'RoleController@frontend')->name('roles');
Route::get('roles/edit/{id}', 'RoleController@edit_frontend');
Route::resource('api/staff', 'StaffController');
Route::get('staff', 'StaffController@frontend')->name('staff');
Route::get('staff/edit/{id}', 'StaffController@edit_frontend');
Route::get('/roles_list', 'RoleController@roles_list');
Route::get('/allroles', 'RoleController@allroles');

Route::get('/permissions', 'PermissionController@index')->name('permissions');

Route::get('/getRole', 'PermissionController@getRole');
Route::get('/getPermissions/{id?}', 'PermissionController@getPermissions');
Route::get('savePermission/{permission_id}/{role_id}', 'PermissionController@savePermission');
Route::get('deletePermission/{permission_id}/{role_id}', 'PermissionController@deletePermission');
Route::get('saveUserPermission/{permission_id}/{user_id}', 'PermissionController@saveUserPermission');
Route::get('deleteUserPermission/{permission_id}/{user_id}', 'PermissionController@deleteUserPermission');

Route::get('settings', 'SettingController@frontend')->name('settings');
Route::post('/changePassword','SettingController@changePassword');
Route::post('/sendVerificationLink','SettingController@sendVerificationLink');
Route::get('/reset_email/{userid}/{token}','SettingController@emailUpdate')->name('reset.email');
Route::get('permissions/user_listing', 'PermissionController@perm_userData')->name('ajax.permUserdata');
Route::get('permissions/user_permissions/{id}','PermissionController@user_permissions'); 
Route::get('permissions/add_role_permission/{r_id}/{p_name}', 'PermissionController@saveRolePermission');
Route::get('permissions/delete_role_permission/{r_id}/{p_name}', 'PermissionController@deleteRolePermission');
Route::get('permissions/add_user_permission/{u_id}/{p_name}', 'PermissionController@saveUserPermission');
Route::get('permissions/delete_user_permission/{u_id}/{p_name}', 'PermissionController@deleteUserPermission');

