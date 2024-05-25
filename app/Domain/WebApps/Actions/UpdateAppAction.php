<?php

namespace SAAS\Domain\WebApps\Actions;

use Illuminate\Support\Facades\DB;
use SAAS\Domain\WebApps\DataTransferObjects\AppData;
use SAAS\Domain\WebApps\Models\App;

class UpdateAppAction
{
    use UpsertTrait;

    public function __construct()
    {
    }

    public static function execute(AppData $data, App $app): App
    {
        DB::transaction(function () use ($data, &$app) {
            return self::saveApp($data, $app);
        });

        return $app;
    }

    public static function saveApp(AppData $data, App $app): App
    {
        $app->fill($data->all());
        $app->save();

        // logo handling
        if (! empty($data->logo)) {
            $app->uploadLogo($data->logo);
        }

        // create features and attach to app
        if (! empty($data->features)) {
            self::createFeatures($data->features, $app);
        }

        // create plans and attach to app
        if (! empty($data->plans)) {
            self::createPlans($data->plans, $app);
        }

        return $app->fresh(['features.feature', 'plans.plan', 'media']);
    }
}
