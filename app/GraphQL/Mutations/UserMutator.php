<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\Traits\GraphqlResponser;
use App\User;

class UserMutator
{
    use GraphqlResponser;

    public function upsertUser($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = User::updateOrCreate(
            ['id' => $args['id']],
            ['name' => $args['name'], 'email' => $args['email'], 'password' => $args['password']]
        );

        return $this->successResponse('user', $user, 'Registro creado satisfactoriamente', 200);
    }

    public function deleteUser($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = User::find($args['id']);
        if (!$user) {
            return $this->errorResponse('user', null, 'Registro no encontrado', 400);
        }

        $user->delete();

        return $this->successResponse('user', $user, 'Registro eliminado satisfactoriamente', 200);
    }

    public function restoreUser($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = User::withTrashed()->find($args['id']);
        if (!$user) {
            return $this->errorResponse('user', null, 'Registro no encontrado', 400);
        }

        $user->restore();

        return $this->successResponse('user', $user, 'Registro restaurado satisfactoriamente', 200);
    }
}
