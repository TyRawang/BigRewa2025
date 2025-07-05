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

    function getMailShortBody($string_arr)
    {
        $from_country = '';
        $from_state = '';
        $from_city = '';
        $from_zip = '';

        $to_country = '';
        $to_state = '';
        $to_city = '';
        $to_zip = '';

        $date = '';
        $size = '';

        foreach ($string_arr as $string) {
            if (strpos($string, 'Moving From Country') !== false) {
                $arr_val = explode(':', $string);
                $from_country = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Moving From State') !== false) {
                $arr_val = explode(':', $string);
                $from_state = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Moving From City') !== false) {
                $arr_val = explode(':', $string);
                $from_city = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Moving From Zip') !== false) {
                $arr_val = explode(':', $string);
                $from_zip = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Moving To Country') !== false) {
                $arr_val = explode(':', $string);
                $to_country = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Moving To State') !== false) {
                $arr_val = explode(':', $string);
                $to_state = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Moving To City') !== false) {
                $arr_val = explode(':', $string);
                $to_city = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Moving To Zip') !== false) {
                $arr_val = explode(':', $string);
                $to_zip = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Move Date') !== false) {
                $arr_val = explode(':', $string);
                $date = (isset($arr_val[1])) ? $arr_val[1] : '---';
            } elseif (strpos($string, 'Move Size') !== false) {
                $arr_val = explode(':', $string);
                $size = (isset($arr_val[1])) ? $arr_val[1] : '---';
            }


        }

        $html = '<p> Moving Size : ' . $size . '</p>';
        $html .= '<p> Moving Date : ' . $date . '</p>';
        $html .= '<p> Moving From : ' . $from_city . ', ' . $from_state . ', ' . $from_country . ' ( ' . $from_zip . ' ) ' . '</p>';

        $html .= '<p> Moving To : ' . $to_city . ', ' . $to_state . ', ' . $to_country . ' ( ' . $to_zip . ' ) ' . '</p>';

        return $html;

    }
}
