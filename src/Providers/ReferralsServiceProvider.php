<?php

namespace Pdazcom\Referrals\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class ReferralsServiceProvider extends EventServiceProvider
{

    protected $listen = [
        'Pdazcom\Referrals\Events\UserReferred' => [
            'Pdazcom\Referrals\Listeners\ReferUser',
        ],
        'Pdazcom\Referrals\Events\ReferralCase' => [
            'Pdazcom\Referrals\Listeners\RewardUser',
        ],
    ];

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/referrals.php', 'referrals');
    }

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        parent::boot();

        // resolve config
        $this->publishes([__DIR__ . '/../../config/referrals.php' => config_path('referrals.php')], 'config');

        // resolve migrations
        $migrationsPath = __DIR__ . '/../../database/migrations/2017_09_23_1100';
        $this->publishes([
            "{$migrationsPath}00_create_referral_programs_table.php" => database_path('migrations/' . date("Y_m_d_Hi") . "00_create_referral_programs_table.php"),
            "{$migrationsPath}01_create_referral_links_table.php" => database_path('migrations/' . date("Y_m_d_Hi") . "01_create_referral_links_table.php"),
            "{$migrationsPath}02_create_referral_relationships_table.php" => database_path('migrations/' . date("Y_m_d_Hi") . "02_create_referral_relationships_table.php"),
        ], 'migrations');
    }
}
