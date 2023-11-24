<?php

namespace App\Util;

use App\Models\Estado;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Exception;

class QueryUtil
{
    public static function whereCompany(Builder $query): Builder
    {
        $company_id = Session::get('company_id');
        return $query->where(function ($query) use ($company_id) {
            $query->where('company_id', $company_id)
                ->orWhereHas('company', function ($query) use ($company_id) {
                    $query->where('principal_id', $company_id);
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
        $request['company_id'] = Session::get('company_id');
        return $request;
    }

    public static function handleQueryException(QueryException $exception, String $message)
    {
        $errorCode = $exception->errorInfo[1];
        var_dump($errorCode);
        switch ($errorCode) {
            case 1062:
                throw new Exception('No pueden haber ' . $message . ' duplicados', 500);
                break;
            default:
                throw new Exception('Ocurrió un error al guardar', 500);
                break;
        }
    }
}
