<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;

/**
 * This class corresponds to database table email_template
 * Class EmailTemplate
 * @package App
 */
class EmailTemplate extends Model
{
    protected $table = 'email_template';
    public $primaryKey = 'id';

    /**
     * This function is used to check if current user has any active template or not
     * @return bool -> Returns true if current user has any active template else false
     */
    function checkTemplateIsActive()
    {
        $data = $this->where('user_id', Auth::id())->where('status', 'Active')->first();
        if ($data) {
            return true;
        }
        return false;
    }
}

