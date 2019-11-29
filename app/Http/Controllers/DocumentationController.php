<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return response()->json(
        [
            'message' => '﷽',
            'user' => 
            [
                'registration' => 
                [
                    'method' => 'POST',
                    'endpoint' => '/api/auth/register',
                    'params' => [
                        'name',
                        'username',
                        'email',
                        'password',
                        'password_confirmation'
                    ]
                ],
                'login' =>
                [
                    'method' => 'POST',
                    'endpoint' => '/api/auth/login',
                    'params' => [
                        'email',
                        'password',
                    ]
                ]
            ],
            'speakers' => 
            [
                'registeration' => 
                [
                    'method' => 'POST',
                    'endpoint' => '/api/speaker/auth/register',
                    'params' => [
                        'first_name',
                        'last_name',
                        'email',
                        'phone_number',
                        'location_address',
                        'city',
                        'password',
                        'password_confirmation',
                        'avatar'
                    ]
                ],
                'login' => 
                [
                    'method' => 'POST',
                    'endpoint' => '/api/speaker/auth/login',
                    'params' => [
                        'email', 'password'
                    ]
                ]
            ],
            'topics' => 
            [
                'list' => [
                    'method' => 'GET',
                    'endpoint' => '/api/topics'
                ],
                'create' => [
                    'method' => 'POST',
                    'endpoint' => '/api/topics',
                    'params' => [
                        'title',
                        'description'
                    ]
                ],
                'update' => [
                    'method' => 'PATCH',
                    'endpoint' => '/api/topics/:id',
                    'params' => [
                        'title',
                        'description'
                    ]
                ],
                'delete' => [
                    'method' => 'DELETE',
                    'endpoint' => '/api/topics/:id',
                    'params' => [
                        'permanent' => 'boolean'
                    ]
                ]
            ],    
        ]);
    }
}