<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PostTitleDoesNotContainPost;
use App\Rules\PostDescriptionDoesNotContainDescription;

class UpdatePostRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', new PostTitleDoesNotContainPost()],
            'description' => ['required', 'min:30', new PostDescriptionDoesNotContainDescription()],
            'deadline' => 'required|date|after:today',
            'workType' => 'required',
            'location' => 'required',
            'skills' => 'required',
            'salaryRange' => 'required',
            'benefites' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', //need to be handeled
            'category' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'There is no post without a title',
            'title.string' => 'The title must be a string',
            'title.max' => 'The title must not be more than 255 characters',
            'description.required' => 'There is no post without a description',
            'description.min' => 'The description must be at least 30 characters long',
            'deadline.required' => 'You must specify a deadline',
            'deadline.after' => 'The deadline cannot be a past date',
            'workType.required' => 'The work type is required',
            'location.required' => 'The location is required',
            'skills.required' => 'The skills are required',
            'salaryRange.required' => 'The salary range is required',
            'benefites.required' => 'The benefits are required',
            'logo.image' => 'The file must be an image',
            'logo.mimes' => 'The image must be a file of type: jpeg, png, jpg',
            'logo.max' => 'The image may not be greater than 2048 kilobytes',
            'category.required' => 'The category is required',
        ];
    }

}
