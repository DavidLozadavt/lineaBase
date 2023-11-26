<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaccionRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'fechaTransaccion'  => 'required|date',
      'hora'              => 'required|date',
      'numFacturaInicial' => 'required|integer',
      'valor'             => 'required|numeric',
      'idEstado'          => 'required|integer',
      'idTipoTransaccion' => 'required|integer',
      'idTipoPago'        => 'required|integer',
    ];
  }
}
