<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\Job;
use App\User;
use App\Traits\GraphqlResponser;

class JobMutator
{
    use GraphqlResponser;

    public function upsertJob($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {

        if (!User::where('id', $args['user_id'])->exists()) {
            return $this->errorResponse('job', null, 'Usuario no encontrado', 400);
        }

        $job = Job::updateOrCreate(
            ['id' => $args['id']],
            [
                'name_job' => $args['name_job'],
                'user_id' => $args['user_id']
            ]
        );

        return $this->successResponse('job', $job, 'Registro creado satisfactoriamente', 200);

    }

    public function deleteJob($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $job = Job::find($args['id']);
        if (!$job) {
            return $this->errorResponse()('job', null, 'Registro no encontrado', 400);
        }

        $job->delete();

        return $this->successResponse('job', $job, 'Registro eliminado satisfactoriamente', 200);
    }

    public function restoreJob($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $job = Job::withTrashed()->find($args['id']);
        if (!$job) {
            return $this->errorResponse()('job', null, 'Registro no encontrado', 400);
        }

        $job->restore();

        return $this->successResponse('job', $job, 'Registro restaurado satisfactoriamente', 200);
    }
}
