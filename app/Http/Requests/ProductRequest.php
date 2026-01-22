<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'url' => [
                'required',
                'string',
                'max:255',
                'url',
            ],

            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                    'canceled',
                    'lost_domain',
                    'frozen_domain',
                    'maintenance',
                ]),
            ],

            'hosting' => [
                'required',
                Rule::in([
                    'laon',
                    'external',
                ]),
            ],

            'department' => [
                'required',
                Rule::in([
                    'laon',
                    'wordpress',
                    'opencart',
                    'outros',
                ]),
            ],
            'service' => [
                'required',
                Rule::in([
                    'site',
                    'email',
                    'sistema',
                    'site_email',
                    'site_sistema',
                    'sistema_email',
                    'site_email_sistema'
                ]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'url.required' => 'A URL é obrigatória',
            'status.required' => 'O status é obrigatório',
            'departament.required' => 'O departamento é obrigatório',
            'hosting.required' => 'A hosting é obrigatória',
            'service.required' => 'O serviço é obrigatório',
            'url.url' => 'Informe uma URL válida',

            'status.in' => 'Status inválido. Opções permitidas: active, inactive, canceled, lost_domain, frozen_domain e maintenance.',
            'hosting.in' => 'Tipo de hosting inválido. Opções permitidas: laon e external.',
            'department.in' => 'Departamento inválido. Opções permitidas: laon, wordpress, opencart e outros.',
            'service.in' => 'Serviço inválido. Opções permitidas: site, email, sistema, site_email, site_sistema, sistema_email, site_email_sistema'
        ];
    }
}
