<?php
namespace App\Http\Requests\Activity;
use Illuminate\Foundation\Http\FormRequest;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UpdateRequest
 *
 * @author Vesaka
 */
class PostRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'image' => 'image|mimes:jpeg,png,jpg|max:200000',
            //'title' => 'required|regex:/^[a-zA-Zа-яА-Я0-9,.!?\s]*$/i',
            'description' => 'required'
        ];
    }

    public function messages() {
        return [
            'image' => [
                'required' => 'Няма качена снимка',
                'image' => 'Файлът трябва да е изображение',
                'mimes' => 'Невалиден файл формат. Разрешени са само jpg,png,jpeg',
                'max' => 'Файлът е твърде голям. Максимум 20мб'
            ],
            'title' => [
                'required' => 'Полето е задължително',
                'regex' => 'Позволени са само букви, цифри и пунктуационни знаци'
            ],
            'description' => [
                'required' => 'Полето е задължително',
                'regex' => 'Позволени са само букви, цифри и пунктуационни знаци.'
            ]

        ];
    }
}
