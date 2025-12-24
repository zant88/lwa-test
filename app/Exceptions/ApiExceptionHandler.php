<?php 
namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Throwable;

class ApiExceptionHandler extends ExceptionHandler 
{
    public static function handle(Throwable $e, Request $request): ?JsonResponse
    {
        if (!$request->is('api/*')) {
            return null;
        }

        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return response()->json([
                'error' => 'Resource not found',
                'messasge' => 'The requested resource was not found'
            ], 404);
        }

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return response()->json([
                'error' => 'Not found',
                'message' => 'The requested endpoint was not found'
            ], 404);
        }

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException) {
            return response()->json([
                'error' => 'Forbidden',
                'message' => 'You do not have permission to acccess this resouce'
            ], 403);
        }

        if ($e instanceof \Illuminate\Validation\ValidationException) {
            return response()->json([
                'error' => 'Validastion failed',
                'message' => 'The given data was invalid',
                'errors' => $e->errors()
            ], 409);
        }

        return response()->json([
            'error' => 'Server Error',
            'message' => 'An unexpected error occurred'
        ], 500);
    }
}