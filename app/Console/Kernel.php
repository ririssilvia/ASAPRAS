<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\FetchWeatherForecast;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        FetchWeatherForecast::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Ubah jadwal menjadi setiap menit untuk pengujian
        $schedule->command(FetchWeatherForecast::class)->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}


