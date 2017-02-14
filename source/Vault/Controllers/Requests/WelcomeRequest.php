<?php
/**
 * vault
 *
 * @author    Wolfy-J
 */

namespace Spiral\Vault\Controllers\Requests;

use Spiral\Http\Request\RequestFilter;

class WelcomeRequest extends RequestFilter
{
    const SCHEMA = [
        'name'   => 'data:name',
        'status' => 'data:status'
    ];

    const VALIDATES = [
        'name'   => ['notEmpty'],
        'status' => [
            'notEmpty',
            ['in_array', ['active', 'disabled'], 'message' => '[[Invalid status value.]]']
        ]
    ];
}