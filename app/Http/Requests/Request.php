<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest {

	//

	public function messages(){

		return [
			'title.required' => 'Error: <strong>Title</strong> is a mandatory field',
			'instructorlast.required' => 'Error: <strong>Instructor Last Name</strong> is a mandatory field',
			'instructorfirst.required' => 'Error: <strong>Instructor First Name</strong> is a mandatory field',
			'sem.required' => 'Error: <strong>Semester</strong> is a mandatory field', 
			'topic.required'=> 'Error: <strong>Topic</strong> is a mandatory field',
			'class.required' => 'Error: <strong>Topic</strong> is a mandatory field',
			'year.required' => 'Error: <strong>Semester/Year</strong> is a mandatory field',
			'video.required' => 'Error: Please choose a <strong>Video</strong> to upload',
 		];
	}

}
