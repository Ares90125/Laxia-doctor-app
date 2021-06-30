<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Stuff' => 'App\Policies\StuffPolicy',
        'App\Models\TreatCase' => 'App\Policies\CasePolicy',
        'App\Models\Reservation' => 'App\Policies\RsvPolicy',
        'App\Models\PatientInfo' => 'App\Policies\PatientInfoPolicy',
        'App\Models\Mailbox' => 'App\Policies\MailboxPolicy',
        'App\Models\Diary' => 'App\Policies\DiaryPolicy',
        'App\Models\TreatProgress' => 'App\Policies\TreatProgressPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
