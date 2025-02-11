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
use App\Mail\UserRegistrationMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

Route::get('/', function() {
	return view('welcome');
});

Route::post('/signup', function() {
    $user = User::firstOrCreate(['email' => request('email')]);

    Mail::to(config('app.admin_email'))->send(new UserRegistrationMail($user));

    return view('thanks');
});

Route::post('/queries', function (Request $request) {

	$mail = \App\ReceivedMail::findOrFail($request->queryId);

	$results = $request->results;

	Mail::to($mail->sender)->send(new SearchResultsMail($mail, $results));

	return response([], 200);
});

Route::get('/groups/{group}', function ($group) {
	$mails = \App\ReceivedMail::where('processed_at', null)->where('group', $group)->get();

	if (count($mails) < 1) {
	    return [];
    }

	$mails->each->update(['processed_at' => now()]);

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
