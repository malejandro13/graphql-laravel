<?php

namespace App\Traits;

trait GraphqlResponser
{
    public function successResponse($model, $data, $message, $status)
    {
        $success[$model] = $data;
        $success['message'] = $message;
        $success['success'] = true;
        $success['status'] = $status;
        return $success;
    }

    public function errorResponse($model, $data, $message, $status)
    {
        $success[$model] = $data;
        $success['message'] = $message;
        $success['success'] = false;
        $success['status'] = $status;
        return $success;
    }
}
