<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        //dd($this->route()->parametres['contacts']->id);
        $contactId = $this->method()==='PUT'
            ? $this->route()->parameters['contact']->id
            : null;

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:contacts,email' .
            ($contactId ? ",$contactId" : '')
            //ovo sto smo dodali ide u slucaju da je put metod,sto smo gore testirali,kao i da ignorise ako smo ovde opet stavili isti mail,
            //da sam taj mail stavila na neki drugi kontakt ne bi proslo,primelo bi pravilo unique
        ];
    }
}
