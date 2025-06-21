<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    /**
     * Check if user has Google SMTP configured
     */
    public function checkGoogleSMTP()
    {
        $data = \App\Models\GoogleSMTP::where('user_id', $this->id)->first();
        if ($data) {
            return $data;
        }
        return false;
    }

    /**
     * Check if user has Custom SMTP configured
     */
    public function checkCustomSMTP()
    {
        $data = \App\Models\CustomData::where('user_id', $this->id)->first();
        if ($data) {
            return $data;
        }
        return false;
    }

    /**
     * Get customer number for the user
     */
    public function getCustomerNo()
    {
        return 'CUST-NO-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
