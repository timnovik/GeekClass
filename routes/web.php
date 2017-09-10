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
Route::get('/home', function () {
    if (\Illuminate\Support\Facades\Auth::check() ) {
        return redirect('/insider');
    }
    return redirect('/login');

});

Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::check() ) {
        return redirect('/insider');
    }
    return redirect('/login');

});

Auth::routes();

Route::prefix('insider')->middleware(['auth'])->group(function () {

    #TODO Check
    Route::get('/', function () {
        return redirect('/insider/courses');
    });
    Route::get('/courses', 'CoursesController@index')->name('Courses');

    Route::get('/courses/create', 'CoursesController@createView')->name('Create course');
    Route::post('/courses/create', 'CoursesController@create');

    Route::get('/courses/{id}/', 'CoursesController@details');
    Route::get('/courses/{id}/edit', 'CoursesController@editView');
    Route::get('/courses/{id}/start', 'CoursesController@start');
    Route::get('/courses/{id}/stop', 'CoursesController@stop');
    Route::post('/courses/{id}/edit', 'CoursesController@edit');
    Route::get('/courses/{id}/assessments', 'CoursesController@assessments');

    Route::get('/courses/{id}/create', 'StepsController@createView');
    Route::post('/courses/{id}/create', 'StepsController@create');


    Route::get('/lessons/{id}', 'StepsController@details');
    Route::get('/lessons/{id}/edit', 'StepsController@editView');
    Route::post('/lessons/{id}/edit', 'StepsController@edit');
    Route::post('/lessons/{id}/question', 'StepsController@question');
    Route::post('/lessons/{id}/task', 'TasksController@create');

    Route::get('/questions/{id}/delete', 'StepsController@deleteQuestion');
    Route::get('/tasks/{id}/delete', 'TasksController@delete');
    Route::get('/tasks/{id}/edit', 'TasksController@editForm');
    Route::post('/tasks/{id}/edit', 'TasksController@edit');
    Route::post('/tasks/{id}/solution', 'TasksController@postSolution');
    Route::get('/tasks/{id}/student/{student_id}', 'TasksController@reviewSolutions');
    Route::post('/solution/{id}', 'TasksController@estimateSolution');
    Route::get('/invite', 'CoursesController@invite');

    Route::get('/community', 'ProfileController@index');
    Route::get('/profile/{id?}', 'ProfileController@details');


    Route::get('/profile/{id}/edit', 'ProfileController@editView');
    Route::post('/profile/{id}/edit', 'ProfileController@edit');
    Route::post('/profile/{id}/course', 'ProfileController@course');
    Route::get('/profile/delete-course/{id}', 'ProfileController@deleteCourse');

    Route::get('/projects/create', 'ProjectsController@createView');
    Route::post('/projects/create', 'ProjectsController@create');
    Route::get('/projects/{id}/', 'ProjectsController@details');
    Route::post('/project/{id}/edit', 'ProjectsController@edit');

    Route::get('/projects/{id}/edit', 'ProjectsController@editView');
    Route::post('/projects/{id}/edit', 'ProjectsController@edit');
    Route::get('/projects/{id}/delete', 'ProjectsController@deleteProject');
    Route::get('/projects', 'ProjectsController@index');

});


Route::get('media/{dir}/{name}', 'MediaController@index');
