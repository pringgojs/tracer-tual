<?php

use App\Models\Student;
use App\Models\Schedule;
use App\Helpers\ToasterHelper;
use Illuminate\Support\Facades\Cookie;

/**
 * toaster Helper global function
 */

if (! function_exists('toaster_set')) {
    /**
     * @param $title
     * @param $message
     * @param string $sticky
     * @return mixed
     */
    function toaster_set($title, $message, $sticky = 'false')
    {
        return ToasterHelper::set($title, $message, $sticky);
    }
}

if (! function_exists('toaster_success')) {
    /**
     * @param $message
     * @param string $sticky
     * @return mixed
     */
    function toaster_success($message, $sticky = 'false')
    {
        return ToasterHelper::success($message, $sticky);
    }
}

if (! function_exists('toaster_info')) {
    /**
     * @param $message
     * @param string $sticky
     * @return mixed
     */
    function toaster_info($message, $sticky = 'false')
    {
        return ToasterHelper::info($message, $sticky);
    }
}

if (! function_exists('toaster_error')) {
    /**
     * @param $message
     * @param string $sticky
     * @return mixed
     */
    function toaster_error($message, $sticky = 'false')
    {
        return ToasterHelper::error($message, $sticky);
    }
}

if (! function_exists('max_schedule')) {
    /**
     * @param $message
     * @param string $sticky
     * @return mixed
     */
    function max_schedule()
    {
        return Schedule::max('id');
    }
}

/** cek student yg login */
if (! function_exists('student')) {
    
    function student()
    {
        return Student::where('nrp', Cookie::get('nrp'))->first();
    }
}

/** id item jawaban lainnya */
if (! function_exists('id_item_other_answer')) {
    
    function id_item_other_answer()
    {
        return '9999999999';
    }
}

