<?php

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

use App\Mail\SearchResultsMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

Route::get('/', function() {
	return view('welcome');
});

Route::post('/queries', function (Request $request) {
    Log::info($request->all());

	$mail = \App\ReceivedMail::find($request->query);

	return $mail;

	$results = $request->results;

	Mail::to($mail->sender)->send(new SearchResultsMail($mail, $results));

	return response([], 200);
});

Route::get('/{group}', function ($group) {
	$mails = \App\ReceivedMail::where('group', $group)->get();

	return $mails->map(function ($mail) {
		return [
			'id' => $mail->id,
			'keywords' => $mail->keywords(),
		];
	});
});

// Route::get('/{query}', function ($query) {
// 	$syborchResults = collect(json_decode(file_get_contents('http://syborch.test/searchjson?search=' . $query)));
// 	$medchemResults = collect(json_decode(file_get_contents('http://medchem.test/searchjson?search=' . $query)));

// 	return [
// 		'syborch' => $syborchResults,
// 		'medchem' => $medchemResults
// 	];
// });
