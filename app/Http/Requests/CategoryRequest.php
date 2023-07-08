<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            'name' => 'required',
            'img'=> 'required|mimes:png,jpg',
            'is_active'=>'required|string|in:true,false'
        ];
    }
    public function getData(){
        $data=$this->validated();
        $data['is_active'] = $data['is_active'] == 'true';

        if ($this->hasFile('img')) {
            $imageName = time() . "" . '.' . $this->file('img')->getClientOriginalExtension();
            $this->file('img')->storePubliclyAs('People', $imageName, ['disk' => 'public']);
            $data['img'] = 'Category/' . $imageName;
        }
        return $data;
    }
}
