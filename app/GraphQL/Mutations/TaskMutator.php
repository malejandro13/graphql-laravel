<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\Task;
use App\Traits\GraphqlResponser;

class TaskMutator
{
    use GraphqlResponser;

    public function upsertTask($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {

        $task = Task::updateOrCreate(
            ['id' => $args['id']],
            [
                'name_task' => $args['name_task']
            ]
        );

        return $this->successResponse('task', $task, 'Registro creado satisfactoriamente', 200);

    }

    public function deleteTask($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $task = Task::find($args['id']);
        if (!$task) {
            return $this->errorResponse()('task', null, 'Registro no encontrado', 400);
        }

        $task->delete();

        return $this->successResponse('task', $task, 'Registro eliminado satisfactoriamente', 200);
    }

    public function restoreTask($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $task = Task::withTrashed()->find($args['id']);
        if (!$task) {
            return $this->errorResponse()('task', null, 'Registro no encontrado', 400);
        }

        $task->restore();

        return $this->successResponse('task', $task, 'Registro restaurado satisfactoriamente', 200);
    }
}
