<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Updatetours_virtualRequest extends FormRequest
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
            'virtual_tours.*' => 'required|image|max:20480',
        ];
    }

    public function messages()
    {
        return [
            'virtual_tours.*.required' => 'Setiap gambar virtual tour wajib diisi.',
            'virtual_tours.*.image' => 'File harus berupa gambar.',
            'virtual_tours.*.max' => 'Ukuran gambar virtual tour terlalu besar, maksimal adalah 20MB.',
        ];
    }
}
