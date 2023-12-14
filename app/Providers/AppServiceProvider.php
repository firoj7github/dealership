<?php

namespace App\Providers;

use App\Models\Invoice;
use App\Interface\InventoryServiceInterface;
use App\Interface\LeadServiceInterface;
use App\Interface\MembershipServiceInterface;
use App\Interface\SliderServiceInterface;
use App\Interface\UserServiceInterface as InterfaceUserServiceInterface;
use App\Service\InventoryService;
use App\Service\LeadService;
use App\Service\MembershipService;
use App\Service\SliderService;
use App\Service\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(InventoryServiceInterface::class, InventoryService::class);
        app()->bind(SliderServiceInterface::class, SliderService::class);
        app()->bind(InterfaceUserServiceInterface::class, UserService::class);
        app()->bind(MembershipServiceInterface::class, MembershipService::class);
        app()->bind(LeadServiceInterface::class, LeadService::class);
        App::register(FilesystemServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


            // View::composer('*', function ($view) {
            //     $today = Carbon::now()->toDateString();
            //     $invoices = Invoice::where('user_id',Auth::id())
            //     ->whereDate('created_at', $today)
            //     ->latest()
            //     ->get();

            //     // dd($invoices);
            //     $view->with('invoices', $invoices);
            // });



    }
}
