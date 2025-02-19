<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'phone_number',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted()
    {
        static::saving(function ($user) {
            if ($user->isDirty('photo')) {
                $oldFile = $user->getOriginal('photo');
                if ($oldFile) {
                    Storage::disk('public')->delete($oldFile);
                }
            }
        });

        static::deleting(function ($user) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $user->skills()->delete();
            $user->projects()->delete();
            $user->experiences()->delete();
            $user->educations()->delete();
            $user->testimonials()->delete();
            $user->messages()->delete();
        });

        static::creating(function ($model) {
            if ($model->username !== 'superadmin') {
                $baseUsername = Str::slug($model->name, '_');

                $username = $baseUsername;
                $counter = 1;

                while (self::where('username', $username)->exists()) {
                    $username = $baseUsername . '_' . rand(1000, 9999);
                    $counter++;

                    if ($counter > 10) {
                        throw new \Exception('Unable to generate a unique username');
                    }
                }

                $model->username = $username;
            }
        });
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
