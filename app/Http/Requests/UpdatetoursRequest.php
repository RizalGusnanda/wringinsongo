<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatetoursRequest extends FormRequest
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
            'name' => 'required|string',
            'profile_tour' => 'required|',
            'description' => 'required|string',
            'history' => 'nullable',
            'fasilitas_km' => 'required|in:Fasilitas Tersedia,Fasilitas Tidak Tersedia',
            'fasilitas_tm' => 'required|in:Fasilitas Tersedia,Fasilitas Tidak Tersedia',
            'fasilitas_ti' => 'required|in:Fasilitas Tersedia,Fasilitas Tidak Tersedia',
            'maps' => 'required|url|starts_with:https://maps.app.goo.gl/',
            'type' => 'required|string|in:wisata tidak bertiket,wisata bertiket',
            'harga_tiket' => 'nullable',
        ];
    }
}
