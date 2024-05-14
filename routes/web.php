<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\MyWorkApplicationController;
use App\Http\Controllers\MyWorkController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WorkApplicationController;
use App\Http\Controllers\WorkController;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

//Route::get('/', function () {
//    return view('welcome');
//})->name('home');
//Route::get('/', function () {
//    return to_route('work.index');
//});
Route::get('/', function () {
    return view('components.livewire-layout');
//    return view('components.work-layout');
//    return redirect()->route('books.index');
});

Route::resource('books', BookController::class)
    ->only(['index', 'show']);

Route::resource('books.reviews', ReviewController::class)
    ->scoped(['review' => 'book'])
    ->only(['create', 'store']);

Route::get('/tasks', function () {
//    $tasks = Task::getLatestTasks()->get();
    $tasks = Task::getLatestTasks()->paginate(10);
    return view('index', compact('tasks'));
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/edit/{task}', function (Task $task) {
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task) {
//    $task = collect($tasks)->firstWhere('id', $id);
//    if (!$task) abort(Response::HTTP_NOT_FOUND);
//    return view('show', compact('task'));
    return view('show', ['task' => $task]);
})->name('tasks.show');

//Route::get('/tasks/{task}', function (Task $task) {
//    return view('show', ['task' => $task]);
//})->name('tasks.show')->where('task', '[0-9]+');


Route::post('/tasks', function (TaskRequest $request) {
//    $data = $request->validated();
//    $task = new Task;
//    $task->title = $data['title'];
//    $task->description = $data['description'];
//    $task->long_description = $data['long_description'];
//    $task->completed = false;
//    $task->save();
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show', ['task' => $task])->with(['success' => 'Task created successfully!']);
})->name('tasks.store');

Route::put('/tasks/{task}', function (TaskRequest $request, Task $task) {
//    $data = $request->validated();
//    $task->title = $data['title'];
//    $task->description = $data['description'];
//    $task->long_description = $data['long_description'];
//    $task->completed = false;
//    $task->save();
    $task->update($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])->with(['success' => 'Task updated successfully!']);
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')->with(['success' => 'Task deleted successfully!']);
})->name('tasks.destroy');

Route::put('/tasks/toggle-complete/{task}', function (Task $task) {
    $task->toggleComplete();
    return redirect()->back()->with(['success' => 'Task updated successfully!']);
})->name('tasks.toggle-complete');


Route::resource('work', WorkController::class)->only(['index', 'show']);


Route::get('login', fn() => to_route('auth.create'))->name('login');

Route::resource('auth', AuthController::class)->only(['create', 'store']);

Route::delete('logout', fn() => to_route('auth.destroy'))->name('logout');

Route::delete('auth', [AuthController::class, 'destroy'])->name('auth.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/work-application/{work}', [WorkApplicationController::class,'create'])->name('work-application.create');
    Route::post('/work-application/{work}', [WorkApplicationController::class,'store'])->name('work-application.store');

    Route::get('/my-work-applications', [MyWorkApplicationController::class,'index'])->name('my-work-application.index');
    Route::delete('/my-work-applications/{application}', [MyWorkApplicationController::class,'destroy'])->name('my-work-application.destroy');

    Route::resource('employer', EmployerController::class)
        ->only(['create', 'store']);

    Route::middleware('employer')
        ->resource('my-work', MyWorkController::class);
});

//Route::fallback(function () {
//    return '404 page';
//});
