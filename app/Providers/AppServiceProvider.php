<?php

namespace App\Providers;

use App\Models\Profile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            $lang = app()->getLocale();
            $user = auth()->check() ? auth()->user()->load('employee', 'driver') : null;
            $notifications = $user ? $user->unreadNotifications->take(7) : collect();
            $viewName = $view->getName(); // نام ویو، مثل dashboard یا users.index
            $pageTitles = config('titles', []);
            $profile = Profile::first();
            $paginationArray = [25 => '25', 50 => '50', 100 => '100', 250 => '250', 500 => '500', 'all' => __('global.all')];
            if (isset($pageTitles[$viewName][$lang])) {
                // عنوان مشخص شده در config
                $title = $pageTitles[$viewName][$lang];
            } else {
                // نسخه هوشمند: تولید عنوان از Controller یا مسیر URL
                $routeAction = optional(Route::current())->getActionName();
                // مثال: App\Http\Controllers\UserController@index

                if ($routeAction && strpos($routeAction, '@') !== false) {
                    [$controllerFull, $method] = explode('@', $routeAction);
                    $controllerParts = explode('\\', $controllerFull);
                    $controllerName = end($controllerParts); // UserController
                    $controllerName = str_replace('Controller', '', $controllerName); // User
                    $controllerName = Str::title(Str::snake($controllerName, ' ')); // تبدیل به "User"
                    $methodName = Str::title(Str::snake($method, ' ')); // تبدیل index -> Index

                    $title = "$controllerName $methodName"; // مثال: "User Index"
                } else {
                    // اگر مسیر یا Controller معلوم نبود، از اسم ویو استفاده کنیم
                    $title = Str::title(Str::snake(str_replace('.', ' ', $viewName), ' '));
                }

                // ترجمه ساده به فارسی (اختیاری)
                if ($lang === 'fa') {
                    $title = str_replace(['Index', 'Create', 'Edit'], ['لیست', 'ایجاد', 'ویرایش'], $title);
                }
            }

            $allView = [
                'lang' => $lang,
                'user' => $user,
                'page_title' => $title,
                'notifications' => $notifications,
                'paginationArray' => $paginationArray,
                'profile' => $profile
            ];


            $view->with($allView);
        });
    }
}
