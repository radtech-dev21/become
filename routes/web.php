<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Agent\EventController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\DownloadFileController;
use App\Http\Controllers\Agent\ChatController as AgentChatController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Leads\LeadsController;
use App\Http\Controllers\Leads\DocController;
use App\Http\Controllers\Admin\StipController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\NewLeadController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\StatusController;
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
Route::get('/dashboard2', function () {
    return view('dashboard-2');
});
Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
});
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('chats', [ChatController::class, 'index']);
Route::post('full-calender/action', [EventController::class, 'action']);
Route::post('chats/users/list', [ChatController::class, 'postChatUserList']);
Route::post('support/chat/messages', [ChatController::class, 'postChatMessageList']);
/* Leads Routes */
Route::group(['prefix' =>'leads','middleware'=>['auth','role:leads']], function() {
    Route::resource('chat', AgentChatController::class);
    Route::resource('documents', DocController::class);
    Route::get('application',[LeadsController::class, 'application'])->name('application');
    Route::post('application',[LeadsController::class, 'postApplication'])->name('application');
});
/* Agent Routes */
Route::group(['prefix' =>'agent','middleware'=>['auth','role:agents']], function() {
    Route::get('chats/agents', [ChatController::class, 'agent']);
    Route::get('chats/admin', [ChatController::class, 'admin']);
    Route::get('chats/members', [ChatController::class, 'members']);
    Route::get('calendar', function () {
        $events = App\Models\Event::where('user_id', Auth::id())->get(['id', 'title', 'start', 'end','category_type as className']);
        return view('admin.calendar', compact('events'));
    });
    Route::group(['prefix' =>'email'], function() {
        Route::get('inbox', function () {
            return view('admin.email.inbox');
        });
        Route::get('templates', function () {
            return view('admin.email.templates');
        });
    });
    Route::post('application/{id}',[LeadController::class, 'postApplication']);
    Route::resource('documents', DocumentController::class);
    Route::resource('leads', LeadController::class)->parameters(['leads' => 'users']);
    Route::resource('new-leads', NewLeadController::class)->parameters(['new-leads' => 'users']);
    Route::post('assign/agent', [LeadController::class, 'assignAgent'])->name('assign-agent');
    Route::post('update/status', [LeadController::class, 'updateApplicationStatus'])->name('update-status');
});
Route::group(['middleware'=>['auth']], function() {
    Route::post('updateThings', [LeadController::class, 'updateThings']);
});
/* Admin Routes */
Route::group(['prefix' =>'admin','middleware'=>['auth']], function() {
    Route::post('assign/agent', [LeadController::class, 'assignAgent'])->name('assign-agent');
    Route::post('update/status', [LeadController::class, 'updateApplicationStatus'])->name('update-status');
    Route::get('calendar', function () {
        return view('admin.calendar');
    });
    Route::group(['prefix' =>'email'], function() {
        Route::get('compose', function () {
            return view('admin.email.compose');
        });
        Route::get('inbox', function () {
            return view('admin.email.inbox');
        });
        Route::get('read', function () {
            return view('admin.email.read');
        });
        Route::get('templates', function () {
            return view('admin.email.templates');
        });
    });
    Route::post('application/{id}',[LeadController::class, 'postApplication']);
    Route::post('upload/stips/{lead_id}',[StipController::class, 'postApplication']);
    Route::post('upload/bank_statement/{lead_id}',[DocumentController::class, 'postUploadBankDocument']);
    Route::post('upload/document/{lead_id}',[DocumentController::class, 'postUploadDocument']);
    Route::get('chats/agents', [ChatController::class, 'agent']);
    Route::get('chats/admin', [ChatController::class, 'admin']);
    Route::get('chats/members', [ChatController::class, 'members']);
    Route::resource('status', StatusController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('download-file/{file_id}', [DownloadFileController::class, 'downloadFile']);
    Route::get('download-stip/{file_id}', [DownloadFileController::class, 'downloadStip']);
    Route::get('download-statement/{file_id}', [DownloadFileController::class, 'downloadBankStatementFile']);
    Route::resource('leads', LeadController::class)->parameters(['leads' => 'users']);
    Route::resource('agents', UserController::class)->parameters(['agents' => 'users']);
    Route::resource('admins', AdminsController::class)->parameters(['admins' => 'users']);
    Route::resource('new-leads', NewLeadController::class)->parameters(['new-leads' => 'users']);
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');