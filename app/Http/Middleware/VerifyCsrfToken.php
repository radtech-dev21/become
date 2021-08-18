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
    protected $except = ['admin/assign/agent', 'admin/documents', 'full-calender/action', 'admin/upload/stips/*', 'admin/upload/document/*', 'admin/upload/bank_statement/*'];
}
