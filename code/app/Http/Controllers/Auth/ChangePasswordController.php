<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Where to redirect users after password is changed.
     *
     * @var string $redirectTo
     */
    protected $redirectTo = '/changepassword';

    /**
     * Change password form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showChangePasswordForm()
    {
        $user = Auth::user();




        return view('auth.passwords.change', compact('user'));
    }

    /**
     * Change password.
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $validator = $this->validator($request->all());
        if($validator->fails())
        {
            return back()->withErrors($validator->getMessageBag());
        }

        if (Hash::check($request->get('current_password'), $user->password)) {


            $user->password = Hash::make ($request->get('new_password'));
            $user->save();
            flash()->overlay('Password updated successfully.');
            return back();

        } else {

            return back()->withErrors(['current_password'=>'The current password entered is incorrect.']);
        }



    }

    /**
     * Get a validator for an incoming change password request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|same:new_password',
        ]);
    }
}
