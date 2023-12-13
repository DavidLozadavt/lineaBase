<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJornadaRequest extends FormRequest
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
      'nombreJornada' => 'required|string|max:255',
      'description'   => 'string',
      'horaInicial'   => 'required|date_format:H:i',
      'numeroHoras'   => 'required|integer',
      'idCompany'     => 'required|exists:companies,id',
    ];
  }
}
