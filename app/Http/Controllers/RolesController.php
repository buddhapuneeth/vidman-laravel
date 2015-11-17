<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role as Role;
use Illuminate\Http\Request;
class RolesController extends Controller {

	//
	public function index(){
		$roles = Role::latest('updated_at')->get();

		return view('roles.index', compact('roles'));
	}

	public function show($role){



		return view('roles.show', compact('role'));
	}
	public function create(){
		return view('roles.create');
	}

	public function store(Requests\RolesRequest $request){

		Role::create($request->all());

		return redirect('roles');

		}

		public function edit($role){

			return view('roles.edit', compact('role'));
		}
		public function update($role, Requests\RolesRequest $request){
			$role->update($request->all());

			return redirect('roles');
		}
		public function destroy($role, Requests\RolesRequest $request){

			$role->delete();

			return redirect('roles');
		}

}
