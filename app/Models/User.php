<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Roles;
use App\Models\Filters\UserFilter;
use App\Traits\dealWithRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        "is_complete"
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

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, "user_skill", "user_id", "skill_id");
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }


    public function reviews()
    {
        return $this->hasMany(Review::class, "company_id");
    }


    public function applications()
    {
        if ($this->hasRole(Roles::EMPLOEE->value))

            return  $this->hasMany(Application::class, "emploee_id");

        elseif ($this->hasRole(Roles::ENTREPRENEUR->value))

            return  $this->hasMany(Application::class, "company_id");
    }

    public function scopeFilter($query, $search)
    {
        $filter = new UserFilter($query);

        $filter->byName($search)
            ->orByJobSpecification($search);
    }

    public function reports()
    {
        return $this->morphOne(Report::class, "reportable");
    }

    public function wishlist()
    {
        return $this->belongsToMany(Job::class, "wishlist", "user_id", "job_id");
    }
}
