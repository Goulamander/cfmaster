<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // 'product/store',
        // 'product/updateStock',
        // 'product/edit',
        // 'runningCost/newEntry',
        // 'uniqueCost/singleEntry',
        // '/uniqueCost/updatesingleEntry',
        // 'product/updateDemand'
        '/user/change_photo'

    ];
}
