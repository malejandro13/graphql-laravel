<?php

namespace App\GraphQL\Mutations;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AccountMutator
{
    public function login($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $data = array_merge($args, [
            'grant_type' => 'password',
            'scope' => '',
        ]);

        $request = Request::create('v1/oauth/token', 'POST', $data, [], [], [
            'HTTP_Accept' => 'application/json',
        ]);

        $response = app()->handle($request);
        $auth_token = json_decode($response->getContent(), true);
        $user = $this->user($auth_token);

        return compact('auth_token', 'user');
    }

    /**
     * Get user from access token.
     *
     * @param  array  $auth_token
     * @return \App\User|null
     */
    protected function user(array $auth_token)
    {
        $jwt = Arr::get($auth_token, 'access_token');
        if (!$jwt) {
            return null;
        }

        $tks = explode('.', $jwt);
        list($headb64, $bodyb64, $cryptob64) = $tks;
        $body = JWT::jsonDecode(JWT::urlsafeB64Decode($bodyb64));
        $sub = data_get($body, 'sub');

        if (!$sub) {
            return null;
        }

        return User::find($sub);
    }
}
