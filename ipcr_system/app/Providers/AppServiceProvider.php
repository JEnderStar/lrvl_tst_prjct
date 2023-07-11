<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Exception;

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
    public function boot()
    {
        View::composer('layouts.menu', function ($view) {
            try {
                // Retrieve all schedule data from the schedule_ipcr table
                $schedules = DB::table('schedule_ipcr')->get();

                $currentDate = Carbon::now();
                $isWithinRange = false;
                $isAccomplishedRatedWithinRange = false;

                // Iterate over each schedule
                foreach ($schedules as $schedule) {
                    $startDate = Carbon::parse($schedule->duration_from);
                    $endDate = Carbon::parse($schedule->last_submission);
                    $purpose = $schedule->purpose;

                    // Check if the current date falls within the range for each purpose
                    if ($currentDate->gte($startDate) && $currentDate->lte($endDate)) {
                        // Check if the purpose is "Performance Targets"
                        if ($purpose == 'Performance Targets') {
                            $isWithinRange = true;
                        }
                        // Check if the purpose is "Accomplished & rated IPCR"
                        elseif ($purpose == 'Accomplished & rated IPCR') {
                            $isAccomplishedRatedWithinRange = true;
                        }
                    }
                }

                // Pass the resulting flags to the view
                $view->with('isWithinRange', $isWithinRange);
                $view->with('isAccomplishedRatedWithinRange', $isAccomplishedRatedWithinRange);
            } catch (Exception $e) {
                // Handle the exception here
                // You can log the error or provide a default error state if needed

                // Set default error state for "Performance Targets"
                $view->with('isWithinRange', false);

                // Set default error state for "Accomplished & rated IPCR"
                $view->with('isAccomplishedRatedWithinRange', false);
            }
        });
    }
}
