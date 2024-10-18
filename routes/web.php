<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/practice',function(){
    $questions = [
        [
            'questions' => 'what is Laravel?',
            'answer' => 'Laravel is a PHP framework for web artisian.'
        ],
        [
            'questions' => 'what are Laravel Routes?',
            'answer' => 'Routes in Laravel are used to define the UrLs for your application.'
        ],
    ];
    foreach ($questions as $q) {
        echo "<strong>Question:</strong> " . $q['questions'] . "<br>";
        echo "<strong>Answer:</strong> " . $q['answer'] . "<br><br>";
    }
});

// Route::get('/data',function(){
//     return response()->json([
//         '('student.create')'
//         Route::post('/student',[StudController::class]) => 'John',
//         'age'=>38,
//         'city'=>'New York'
//     ]);
// });

Route::get('/grade', function () {
    $score = request('score');

    if ($score >= 90) {
        $grade = 'A';
    } elseif ($score >= 80) {
        $grade = 'B';
    } elseif ($score >= 70) {
        $grade = 'C';
    } elseif ($score >= 60) {
        $grade = 'D';
    } else {
        $grade = 'F';
    }

    return "Score: $score, Grade: $grade";
});

Route::get('/product/{category}/{id}',function($category,$id){
    return "Product $id in category $category";

})->where(['id'=>'[0-9]+','category'=>'[A-Za-z]+']);


Route::get('/product/{id}/{email}', function ($id, $email) {
    return "Product $id with email id $email";
})->where(['id' => '[0-9]+', 'email' => '[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}']);

Route::get('/dob/{day/{month}/{year}', function($day, $month, $year) {
    return "Date of Birth: $day-$month-$year";
})->where([
    'day' => '[0-3][0-9]',   
    'month' => '[0-1][0-9]', 
    'year' => '[0-9]{2}'    
]);

Route::get('user/{name?}',function($name='INT221'){
    return $name;
});

Route::get('/appearance',function(){
    return view('appearance');
});

Route::get('/name', function () {
    return view('name', ['name' => 'Stuti']);
});

Route::get('/name/courses', function () {
    return view('name', ['name' => 'Stuti', 'course' => 'PHP']);
});
Route::get('/set-cookie', function () {
    $minutes=60;
    return response('Cookie has been set!')
    ->cookie('user_name','Stuti Sharma',$minutes);
});
Route::get('/get-cookie', function () {
    $userName=Cookie::get('user_name');
    return response('The cookie value is: '.$userName);
});
Route::get('/delete-cookie', function () {
    Cookie::queue(Cookie::forget('user_name'));
    return response('Cookie has been deleted');
});
Route::get('/set-cookie-with-header', function () {
    $minutes=60;
    return response('Cookie and headers have been set')
    ->header('X-Custom-Header', 'HeaderValue')
    ->cookie('user_name','Mamta Sharma',$minutes);
});
Route::get('/set-cookie-json', function () {
    $minutes=60;
    return response()->json([
        'message'=>'Cookie has been set with JSON response'
    ])->cookie('user_name','John Doe',$minutes);
});
Route::get('/set-advanced-cookie',function(){
    return response('Advanced cookie set!')
    ->cookie('user_name','John Doe',60,'/',null,true,true,false,'Strict');
});

//JSON
Route::get('/json',function(){
    return response()->json([
        'status'=>'success',
        'message'=>'This is json response'
    ]);
});
Route::get('/json-with-header',function(){
    return response()->json([
        'status'=>'success',
        'message'=>'This json response has custom headers',
    ])->header('X-Custom-Header','CustomHeaderValue');
});
Route::get('/json-with-cookie',function(){
    return response()->json([
        'status'=>'success',
        'message'=>'This JSON response has a cookie',
    ])->cookie('user_role','admin',60);
});
Route::get('/json-with-header-cookie',function(){
    return response()->json([
        'status'=>'success',
        'message'=>'This json response has both headers and cookies'
    ])->header('X-Custom-Header','HeaderValue')
      ->cookie('user_role','guest',60);
});
Route::get('/conditional-json-response',function(){
    if(Cookie::has('user_role')){
    return response()->json([
        'status'=>'success',
        'message'=>'User role exists',
        'role'=>Cookie::get('user_role'),
    ])->header('X-Role-Exists','true');
}else{
    return response()->json([
        'status'=>'success',
        'message'=>'User Role set to guest',
    ])->cookie('user_role','guest',60)
    ->header('X-Role-Exists','false');
}
});

//write a laravel route that sets a cookie named session id witha random string value that expires in 2 hours. also, attach a header named x-app-environment with the value development. verify the cookie and ehader in browsers dvelopers tool
Route::get('/set-session-cookie', function () {
    $minutes=120;
    return response('Cookie have been set')
    ->header('X-App-Environment', 'Development')
    ->cookie('session_id','session',$minutes);
});
//write a route that returns a json response containing a message key with the value "Welcome to our API". Attach a cookie named api_access with the value granted,and add a header named X-API-Version with the value v1.0.

Route::get('/json-with-header1',function(){
    return response()->json([
        'status'=>'success',
        'message'=>'Welcome to our API'
    ])->header('X-API-Version','v1.0.')
      ->cookie('api_access','granted',60);
});

//create a route that deletes a cookie named remember me if it exists. After deleting the cookie,return a response with a header X-Remember-Me set to deleted

Route::get('/delete-cookie1', function () {
    Cookie::queue(Cookie::forget('Remember_Me'));
    return response('Cookie has been deleted')
    ->header('X-Remember-Me', 'deleted');
});

Route::get('/name1',function(){
    return view('name1');
});

Route::get('/student',function(){
    $id=5;
    return view('student',['id'=>$id]);
});

Route::get('/link',function(){
    return view('link');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/submit', function (Request $request) {
    $data = $request->all();
    return back()->with('success', 'Your message has been sent successfully!');
})->name('contact.submit');


// create a controller named NewsController to display news articles with the following routes:
// GET/news-display list of all new articles
// GET/news/{category}-display news articles filtered by specific category eg technology,sports
// GET/news/{category}/{id}-displays a specific news article by category and id



use App\Http\Controllers\NewsController;

Route::get('/news', [NewsController::class, 'displayAllNews']);
Route::get('/news/{category}', [NewsController::class, 'displayByCategory']);
Route::get('/news/{category}/{id}', [NewsController::class, 'displayByCategoryAndId']);

use App\Http\Controllers\CookieController;

Route::get('/set-cookie', [CookieController::class, 'setCookie']);
Route::get('/get-cookie', [CookieController::class, 'getCookie']);
Route::get('/delete-cookie', [CookieController::class, 'deleteCookie']);

use App\Http\Controllers\preferenceController;

Route::get('/set-preferences', [preferenceController::class, 'setPreferences']);
Route::get('/get-preferences', [preferenceController::class, 'getPreferences']);
Route::get('/update-preferences', [preferenceController::class, 'updatePreferences']);
Route::get('/delete-preferences', [preferenceController::class, 'deletePreferences']);

// use App\Http\Controllers\FileUploadController;
// Route::get('/upload', function(){
//     return view('upload');
// })->name('file.form');
// Route::post('/upload',[FileUploadController::class,'upload'])->name('file.upload');

use App\Http\Controllers\FileUploadController;

Route::get('/upload', [FileUploadController::class, 'showForm'])->name('file.form');
Route::post('/upload', [FileUploadController::class, 'upload'])->name('file.upload');

Route::get('session/get',function(){
    $value=session('key','Default value');
    return response()->json(['session_data'=>$value]);
});

Route::view('success','success');
Route::get('/session/delete',function(){
    session()->forget('key');
    return response()->json(['message'=>'Session data deleted']);
});
Route::get('/session1/get', function() {
    $value = session('session_data', 'blue');
    $session_key = 'session1';
    return response()->json([$session_key => $value]);
});

use App\Http\Controllers\StudController;
Route::get('/student', [StudController::class, 'create'])->name('student.create');
Route::post('/student',[StudController::class, 'store'])->name('student.store');

