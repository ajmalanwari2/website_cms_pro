<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\SetLocale;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about_us', [HomeController::class, 'about_us'])->name('about_us.index');
Route::get('locale/{locale}', [HomeController::class, 'setLocale'])->name('locale');

Route::middleware([
    EncryptCookies::class,
    AddQueuedCookiesToResponse::class,
    StartSession::class,
    ShareErrorsFromSession::class,
    SubstituteBindings::class,
    SetLocale::class,
])->group(function () {

    // Authentication routes (login, register, password reset, etc.)
    Auth::routes([
        'register' => false,
        'reset' => false,
        'verify' => false,
    ]);

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Company Profile
        Route::get('/company-profile', [DashboardController::class, 'viewCompanyProfile'])->name('company.profile.index');
        // Update Company Profile
        Route::post('/update-company-profile', [DashboardController::class, 'updateCompanyProfile'])->name('company.profile.update');

        // Language switch
        Route::get('lang/{lang}', function ($lang) {
            $availableLangs = ['fa', 'pa', 'en'];
            if (in_array($lang, $availableLangs)) {
                session(['locale' => $lang]);
                app()->setLocale($lang);

                // Store the locale in the session
                session()->put('locale', $lang);

                /** @var \App\Models\User|null $user */
                $user = auth()->user();

                // Check if the user is authenticated
                if ($user) {
                    // Update the user's language preference
                    $updateLang = $user->update(['lang' => $lang]);

                    // Redirect back if the update was successful
                    if ($updateLang) {
                        return redirect()->back()->with('success', 'Language updated successfully!');
                    }
                }
            }
            return redirect()->back();
        })->name('lang');

        // user route
        require __DIR__ . '/users.php';

        // company route
        require __DIR__ . '/companies.php';

        // location route
        require __DIR__ . '/locations.php';

        // employee route
        require __DIR__ . '/employees.php';


        require __DIR__ . '/rolePermission.php';

        // general route
        Route::prefix('notification')->group(function () {
            require __DIR__ . '/notification.php';
        });
    });

    Route::group(['middleware' => ['role_or_permission:UserProfile - View UserProfile|UserProfile - Edit Name|UserProfile - Edit Email|UserProfile - Edit Password']], function () {
        //UserProfile section
        Route::get('/userprofile', [UserController::class, 'userProfile'])->name('userprofile')->middleware('role_or_permission:UserProfile - View UserProfile');
        Route::get('/userprofile/fetchUserProfile', [UserController::class, 'fetchUserProfile'])->name('fetchUserProfile')->middleware('role_or_permission:UserProfile - Edit Name|UserProfile - Edit Email|UserProfile - Edit Password');
        Route::post('/userprofile/update', [UserController::class, 'updateUserProfile'])->name('update_userprofile')->middleware('role_or_permission:UserProfile - Edit Name|UserProfile - Edit Email|UserProfile - Edit Password');
        //End UserProfile Section
    });
});
