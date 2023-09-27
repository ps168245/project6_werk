<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\Role_User;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //

        Blade::if('checkPermission', function (User $user) {
            // Checks if the logged in user has the same or higher role level than the instance of the user.
            if ($this->getHighestPermissionFromLoggedInUser() >= $this->getHighestPermissionFromUserInstance($user)) {
                return true;
            } else {
                return false;
            }
        });

        //The blade if is used for the @. So when in a blade file it sees @role()
        // it runs this code that checks if that user has the role.
        Blade::if('hasRole', function (string $value) {
            if (auth()->user()) {
                $userRole = Role_User::where('role_id', Role::where('name', $value)->first()->id)
                    ->where('user_id', auth()->user()->id)
                    ->get();

                return $userRole->count() > 0;
            }
        });
        //Almost the same as hasRole, but with an array instead of a single string.
        Blade::if('hasRolesArray', function (array $roles) {
            foreach ($roles as $role) {
                if (auth()->user()->roles()->where('name', $role)->get()->count() > 0) {
                    return true;
                }
            }
        });
    }

    private function getHighestPermissionFromLoggedInUser()
    {
        $output = auth()->user()->load(['roles' => function ($query) {
            $query->orderBy('level', 'desc')->first();
        }])->roles[0]->level;

        return $output;
    }

    private function getHighestPermissionFromUserInstance(User $user)
    {
        $output = $user->load(['roles' => function ($query) {
            $query->orderBy('level', 'desc')->first();
        }])->roles[0]->level;

        return $output;
    }
}
