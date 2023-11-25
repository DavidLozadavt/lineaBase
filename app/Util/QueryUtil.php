<?php

namespace App\Util;

use App\Models\Estado;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\JsonResponse;

class QueryUtil
{
    public static function whereCompany(Builder $query): Builder
    {
        $idCompany = Session::get('idCompany');
        return $query->where(function ($query) use ($idCompany) {
            $query->where('idCompany', $idCompany)
                ->orWhereHas('company', function ($query) use ($idCompany) {
                    $query->where('principal_id', $idCompany);
                });
        });
    }

    public static function whereUser(Builder $query): Builder
    {
        $user_id = auth() -> id();
        $query = $query -> whereHas('user',function($query) use ($user_id){
            $query -> where('id',$user_id);
        });
        return $query;
    }

    public static function whereActive(Builder $query): Builder
    {
        $now = Carbon::now();
        return $query
            ->where('state_id', Estado::ID_ACTIVE)
            ->whereDate('fechaInicio', '<=', $now)
            ->whereDate('fechaFin', '>=', $now);
    }

    public static function createWithCompany(array $request): array
    {
        $request['idCompany'] = Session::get('idCompany');
        return $request;
    }

    public static function handleQueryException(QueryException $exception, String $message)
    {
        $errorCode = $exception->errorInfo[1];
        switch ($errorCode) {
            case 1062:
                throw new Exception('No pueden haber ' . $message . ' duplicados', 500);
                break;
            default:
                throw new Exception('Ocurrió un error al guardar', 500);
                break;
        }
    }


    /**
     * Return exception in function
     *
     * @param \Exception $e
     * @return JsonResponse
     */
    public static function showExceptions(\Exception $e): JsonResponse
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json(['error' => 'Registro no encontrado ' . $e], 404);
        } elseif ($e instanceof QueryException) {
            return response()->json(['error' => 'Error de base de datos ' . $e], 500);
        } elseif ($e instanceof ValidationException) {
            return response()->json(['error' => 'Error de validación', 'detalle' => $e->errors()], 422);
        } elseif ($e instanceof HttpException) {
            return response()->json(['error' => 'Error HTTP', 'codigo' => $e->getStatusCode()], $e->getStatusCode());
        } else {
            return response()->json(['error' => 'Error interno del servidor ' . $e], 500);
        }
    }


}