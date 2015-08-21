<?php namespace App\Helpers;

use DB;
use Cas;
use Illuminate\Support\Facades\Facade;

class AuthHelper extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'authhelper'; }



    public static function getRole($user){


		$role = DB::select('select role from roles where user = ?', [$user]);

		if($role){
			return ($role[0]->role);
		}else{
			return NULL;
		}
	}

	public static function authenticate(){
		Cas::authenticate();
		$role = AuthHelper::getRole(Cas::user());
		return $role;
	}
	public static function signout(){
		Cas::logout();
		return view('videos.index');
	}

}
