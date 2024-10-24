<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\Carbon;
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
        //выдаст Exception если в коде забудем указать EagerLoad и возникнут жадные загрузки N+1
        Model::preventLazyLoading(!app()->isProduction());
        //Exception если не сохнанаем модель не добавив поля в fillable
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());

        //Действие если запросы к базе выполняются дольше чем 500мс

        DB::whenQueryingForLongerThan(500, function (Connection $connection) {
            logger()->channel('telegram')->debug('whenQueryingForLongerThan: '. $connection->toSql());
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
