<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function success($data = null,$token = null , $message = 'Success', $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
            'token'=>$token,
            'errors'  => null
        ], $status);
    }

    protected function error($message = 'Error', $errors = null, $status = 500): JsonResponse 
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => null,
            'errors'  => $errors
        ], $status);
    }
}
