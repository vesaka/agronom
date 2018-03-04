<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
/**
 * Description of PostMessageRequest
 *
 * @author Vesaka
 */
class PostMessageRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'email' => 'required|email',
            'name' => 'required|alpha',
            'user_name' => 'honeypot',
            'stamp' => 'required|honeytime:5',
            'subject' => 'regex:/^[a-zа-я0-9\s\.,\'"!?]*$/iu',
            'text' => 'required|regex:/^[a-zа-я0-9\s\.,\'"!?]*$/iu',
        ];
    }
}
