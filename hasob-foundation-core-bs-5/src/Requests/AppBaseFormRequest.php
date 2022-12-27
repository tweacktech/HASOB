<?php

namespace Hasob\FoundationCore\Requests;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

abstract class AppBaseFormRequest extends FormRequest
{

    abstract public function rules();

    abstract public function authorize();

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();


        if($this->wantsJson())
        {
            $response = response()->json([
                'errors' => $validator->errors()
            ]);

         }else{
             
            $response = redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
         }
            
         throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}