<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\TaskUser;
use App\Traits\GraphqlResponser;

class TaskUserMutator
{
    use GraphqlResponser;

    public function upsertUsersByTask($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $taskUser = collect([]);

        foreach ($args['users'] as $user) {
            $taskUser->push(
                TaskUser::updateOrCreate(
                    ['task_id' => $args['task_id'], 'user_id' => $user['user_id']]
                )
            );
        }

        return $this->successResponse('usersByTask', $taskUser, 'Registro creado satisfactoriamente', 200);

    }
}
