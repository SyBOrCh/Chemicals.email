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
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

Route::get('/', function() {
	return view('welcome');
});

Route::post('/queries', function (Request $request) {
	return $request->results;

	// SearchResult::create([
		// 'query_id' 	=> $request->query,
		// 'results'	=> $request->results, 
	// ]);

	// $mail = \App\ReceivedMail::find(request('query'));

	// Mail::to($mail->sender)->send(new SearchResultsMail($mail, request('results')));

	// return [$mail, request()];
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
