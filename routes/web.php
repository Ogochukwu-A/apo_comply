<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HealthInfoController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\DrugInteractionController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DrugController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/about', [LandingController::class, 'about'])->name('about');

Route::get('/services', [LandingController::class, 'services'])->name('services');

Route::get('/contact', [LandingController::class, 'contact'])->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // health info dashboard 
    Route::get('/health-info', [HealthInfoController::class, 'index'])->name('healthinfo.index');
    Route::post('/health-info/add-prescription', [HealthInfoController::class, 'save_medication'])->name('healthinfo.add_prescription');
    Route::post('/health-info/add-health-metrics', [HealthInfoController::class, 'add_health_metrics'])->name('healthinfo.add_health_metrics');
    
    Route::put('/health-info/update-prescription', [HealthInfoController::class, 'update_prescription'])->name('healthinfo.update_prescription');
    Route::delete('/health-info/delete-prescription', [HealthInfoController::class, 'remove_prescription'])->name('healthinfo.delete_prescription');
    // end health info dashboard

    // reminder dashboard
    Route::get('/reminder', [ReminderController::class, 'index'])->name('reminder.index');
    // end reminder dashboard

    // drug interaction dashboard 
    Route::get('/drug-interaction', [DrugInteractionController::class, 'index'])->name('druginteraction.index');
    
    Route::get('/drugs/search', [DrugController::class, 'search'])->name('drugs.search');

    Route::post('/drugs/add', [DrugInteractionController::class, 'saveDrug'])->name('drugs.add');

    Route::delete('/drugs/delete', [DrugInteractionController::class, 'deleteDrug'])->name('drugs.delete');

    // end drug interaction dashboard 


    // chat bot dashboard 
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/get-bot-response', [ChatbotController::class, 'getBotResponse'])->name('chatbot.response');
    // end chat bot dashboard

    // start appointment dashboard 
    Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.index');

    Route::post('/save-appointment', [AppointmentController::class, 'save_appointment'])->name('appointment.save_appointment');
    
    // end appointment dashboard

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/users', function () {
    return view('pages.users');
});


require __DIR__.'/auth.php';
