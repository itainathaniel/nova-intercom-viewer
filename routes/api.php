<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user/{user_id}', 'Itainathaniel\IntercomViewer\Http\Controllers\IntercomViewerController@show');
Route::get('/user/{user_id}/events', 'Itainathaniel\IntercomViewer\Http\Controllers\IntercomViewerController@events');
Route::get('/user/{user_id}/conversations', 'Itainathaniel\IntercomViewer\Http\Controllers\IntercomViewerController@conversations');
Route::get('/user/{user_id}/notes', 'Itainathaniel\IntercomViewer\Http\Controllers\IntercomViewerController@notes');
