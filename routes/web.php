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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

// Fronted Route Configuration
Route::namespace('Fronted')->group(function(){
Route::get('rooms','RoomController@index')->name('rooms');
Route::post('rooms_check','RoomController@checkAvailableRoom')->name('room.checkAvail');
Route::get('rooms_table','RoomController@roomTable')->name('room.table');
Route::get('rooms_details/{id}','RoomController@Details')->name('room.details');
Route::match(['get','post'],'rooms/book_now/{id}','RoomController@Booking')->name('room.book_now');
Route::get('room/availability/{id}','BookingController@checkAvail')->name('room.availability');
Route::post('room/booking_confirmation/{id}','BookingController@store')->middleware('auth')->name('room.booking_confirmation');
Route::post('room/booking_request','BookingController@BookNow')->middleware('auth')->name('room.booking');
Route::get('/galleries','OtherController@Gallery')->name('gallery');
Route::get('/contact_us','OtherController@Contact')->name('contact');
Route::post('/contact_us','OtherController@Contact_store')->name('contact.store');
});

// User Route
Route::middleware('auth')->group(function(){
Route::get('profile','HomeController@Profile')->name('profile');
Route::get('password_change','HomeController@Password')->name('password_change');
Route::post('password_change','HomeController@Password_store')->name('password_change.update');
Route::get('message','HomeController@Message')->name('user.message');
});
// Admin Routes Configuration
Route::prefix('admin')->namespace('Admin')->group(function(){
	Route::get('/',function (){
		return view('admin.login');
	});
	Route::post('checklogin','AdminController@login')->name('admin.login');
	Route::get('dashboard','AdminController@dashboard')->name('admin.dashboard');

	// Room Route
	Route::get('rooms','RoomController@index')->name('admin.room.list');
	Route::get('rooms/available','RoomController@availRoom')->name('admin.room.available');
	Route::get('rooms/add','RoomController@AddRoom')->name('admin.room.add');
	Route::post('rooms/add','RoomController@InsertRoom')->name('admin.room.insert');

	Route::get('rooms/edit/{id}','RoomController@EditRoom')->name('admin.room.edit');
	Route::post('rooms/edit/{id}','RoomController@UpdateRoom')->name('admin.room.update');

	Route::get('rooms/{id}/delete','RoomController@DeleteRoom')->name('admin.room.delete');
	Route::post('search','BookingController@extendSearch')->name('admin.extend.search');

	// Booking ROute
	Route::get('booking/all','BookingController@index')->name('admin.booking.all');
	Route::get('booking/new','BookingController@NewBooking')->name('admin.booking.new');
	Route::get('booking/approved','BookingController@Approved')->name('admin.booking.approved');
	Route::get('booking/cancelled','BookingController@Cancelled')->name('admin.booking.cancelled');
	// Route::post('booking/new/{id}/update','BookingController@Update')->name('admin.booking.update');
	Route::post('booking/{id}/update','BookingController@Update')->name('admin.booking.update');

	Route::post('booking/search','BookingController@Search')->name('admin.search');

	// Customer Route
	Route::get('customers','CustomerController@index')->name('admin.customers.list');
	Route::get('reports','BookingController@Reports')->name('admin.reports');
	Route::post('reports','BookingController@Reports_Update')->name('reports.get');

	// Message Route
	Route::get('read_message','MessageController@index')->name('message.read');
	Route::get('unread_message','MessageController@unread')->name('message.unread');
	Route::get('message/replied/{id}','MessageController@reply')->name('message.reply');
	Route::post('message/replied/{id}','MessageController@replySubmit')->name('message.reply.submit');
	Route::get('message/mark_replied/{id}','MessageController@MarkAsRead')->name('message_mark_replied');

	// Profile Route
	Route::get('profile','AdminController@Profile')->name('admin.profile');
	Route::post('profile','AdminController@Profile_Update')->name('admin.profile.update');
	Route::get('logout','AdminController@logout')->name('admin.logout');
});