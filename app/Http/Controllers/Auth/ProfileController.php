<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use JsValidator;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class ProfileController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    protected function validationRules() {
        $rule['now_password'] = 'required';
        $rule['password'] = 'required|min:5|confirmed|different:now_password';
        return $rule;
    }

    public function index()
    {
        $id = Auth::user()->id;
        $profile = $this->user->find($id);

        return view('auth.profile', compact('profile'));
    }

    public function changePassword(Request $request)
    {

        $id = Auth::user()->id;

        if ($request->isMethod('post')) {

            $validation = Validator::make($request->all(), $this->validationRules());

            if (!(Hash::check($request->get('now_password'), Auth::user()->password))) {
                $validation->after(function($validation) {
                    $validation->errors()->add('now_password', 'Old password not same');
                });
            }

            if ($validation->fails()) {
                return redirect()->back()->withInput()->withErrors($validation->errors());
            }

            try {
                $this->user->changePassword($id, $request->get('password'));
                return redirect()->action('Auth\ProfileController@changePassword')->with('success', 'Password has been saved');;
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }
        }

        $validator = JsValidator::make($this->validationRules());
        $profile = $this->user->find($id);

        return view('auth.changePassword', compact('profile','validator'));
    }
}
