<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile=User::where('id',auth()->user()->id)->first();
        $parent_menu_active='profile';
        $menu_active='profile';
        return view('profile.index',compact('profile','parent_menu_active','menu_active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $user=User::findOrFail($id);
        $this->authorize('update', $user);

       $profile=User::where('id',$user->id)->first();

        $parent_menu_active='profile';
        $menu_active='profile';
       return view('profile.edit',compact('profile','parent_menu_active','menu_active'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);
        $this->authorize('update', $user);
        $validatedData = $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'. auth()->user()->id . ',id',
            'password' => 'required|min:8',
            'password_confirmation' => 'required:password|same:password|min:8',


        ],[
            'name.requierd'=>'وارد کردن نام الزامی می باشد.',
            'email.required'=>'وارد کردن ایمیل الزامی می باشد.',
            'email.unique'=>'این ایمیل قبلا رزرو شده است.',

            'password.required'=>'وارد کردن رمز عبور الزامی می باشد.',
            'password.min'=>'کلمه عبور حداقل 8 کاراکتر نیاز  دارد.',
            'password_confirmation.required'=>'وارد کردن تکرار رمز عبور الزامی می باشد.',
            'password_confirmation.min'=>'تکرار کلمه عبور حداقل 8 کاراکتر نیاز دارد.',
            'password_confirmation.same'=>'تکرار رمز عبور نادرست می باشد.',
        ]);

//        dd($user_id);
        $user->update([
            'name'=>$request['name'],
            'email'=>$request['email'],

            'password'=>Hash::make($request->password)

        ]);
        session()->flash('success', 'پروفایل با موفقیت بروزرسانی شد.');
        return redirect('profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
