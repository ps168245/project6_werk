<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Throwable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'dateOfBirth',
        'email',
        'password',
        'sick',
        'dateOfBirth',
        'default_address',
        'sick',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function schedule()
    {
        return $this->belongsToMany(Schedule::class)->withTimestamps();
    }

    //It checks if the logged-in user has the role that has been put as argument.
    public function hasRole(string $role)
    {
        try {
            if (auth()->user()) {
                $userRole = Role_User::where('role_id', Role::where('name', $role)->first()->id)
                    ->where('user_id', auth()->user()->id)
                    ->get();

                return $userRole->count() > 0;
            }
        } catch (Throwable $e) {
        }
    }

    //It checks if the logged-in user has one of the roles that is in the array.
    public function hasRolesArray(array $roles)
    {
        foreach ($roles as $role) {
            if (auth()->user()->roles()->where('name', $role)->get()->count() > 0) {
                return true;
            }
        }
    }

    // Checks if the logged-in user has the same or higher role level than the instance of the user.
    public function checkPermission(User $user): bool
    {
        if ($this->getHighestPermissionFromLoggedInUser() >= $this->getHighestPermissionFromUserInstance($user)) {
            return true;
        } else {
            return false;
        }
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
