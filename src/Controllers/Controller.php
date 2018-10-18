<?php
/**
 * Created by PhpStorm.
 * User: brunocouty
 * Date: 18/10/18
 * Time: 00:35
 */

namespace BrunoCouty\LaravelViewLogs\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
