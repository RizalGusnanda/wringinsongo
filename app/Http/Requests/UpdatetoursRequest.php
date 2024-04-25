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
            'name' => 'required|string|unique:tours,name,' . $this->tour,
            'profile_tour' => 'required|',
            'description' => 'required|string',
            'history' => 'nullable',
            'fasilitas_km' => 'required|in:Fasilitas Tersedia,Fasilitas Tidak Tersedia',
            'fasilitas_tm' => 'required|in:Fasilitas Tersedia,Fasilitas Tidak Tersedia',
            'fasilitas_ti' => 'required|in:Fasilitas Tersedia,Fasilitas Tidak Tersedia',
            'maps' => 'required|url|starts_with:https://maps.app.goo.gl/|unique:tours,maps',
            'type' => 'required|string|in:wisata tidak bertiket,wisata bertiket',
            'harga_tiket' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tour name must be filled in.',
            'profile_tour.required' => 'Tour profile must be uploaded.',
            'description.required' => 'Description must be filled in.',
            'fasilitas_km.required' => 'Bathroom facilities option must be selected.',
            'fasilitas_tm.required' => 'Dining facilities option must be selected.',
            'fasilitas_ti.required' => 'Worship facilities option must be selected.',
            'maps.required' => 'Location must be filled in.',
            'type.required' => 'Tour type must be selected.',
            'harga_tiket.numeric' => 'Ticket price must be a number.',
        ];
    }
}
