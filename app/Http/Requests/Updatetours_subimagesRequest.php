<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Updatetours_subimagesRequest extends FormRequest
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
            'subimages.*' => 'required|image|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'subimages.*.required' => 'Setiap gambar pendukung wajib diisi.',
            'subimages.*.image' => 'File harus berupa gambar.',
            'subimages.*.max' => 'Ukuran gambar pendukung terlalu besar, maksimal adalah 5MB.',
        ];
    }
}
