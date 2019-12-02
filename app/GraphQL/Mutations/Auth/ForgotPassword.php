<?php

namespace App\GraphQL\Mutations\Auth;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Password;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPassword
{

    use SendsPasswordResetEmails;
    /**
     * @param $rootValue
     * @param array $args
     * @param \Nuwave\Lighthouse\Support\Contracts\GraphQLContext|null $context
     * @param \GraphQL\Type\Definition\ResolveInfo $resolveInfo
     * @return array
     * @throws \Exception
     */
    public function resolve($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $response = $this->broker()->sendResetLink(['email' => $args['email']]);
        if ($response == Password::RESET_LINK_SENT) {
            return [
                'status' => 'EMAIL_SENT',
                'message' => trans($response)
            ];
        }
        return [
            'status' => 'EMAIL_NOT_SENT',
            'message' => trans($response)
        ];
    }
}
