<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Debugbar
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Exception если не сохнанаем модель не добавив поля в fillable
        //выдаст Exception если в коде забудем указать EagerLoad и возникнут жадные загрузки N+1
        //Model::shouldBeStrict(!app()->isProduction());

        //Действие если запросы к базе выполняются дольше чем 1000мс
        if (app()->isProduction()){
            DB::whenQueryingForLongerThan(1000, function (Connection $connection) {
                logger()->channel('telegram')->debug('whenQueryingForLongerThan: '. $connection->totalQueryDuration());
            });

            DB::listen(function ($query) {
                if ($query->time > 100){
                    logger()->channel('telegram')->debug('whenQueryingForLongerThan: '. $query->sql, $query->bindings);
                }
            });

            //Запрос гуляет более 4 секунд
            $kernel = app(Kernel::class);
            $kernel->whenRequestLifecycleIsLongerThan(
                CarbonInterval::seconds(4),
                function(){
                    logger()->channel('telegram')->debug('whenRequestLifecycleIsLongerThan: '. request()->url());
                }
            );
        }


    }
}
