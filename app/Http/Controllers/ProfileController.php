<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\traits\ImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Hash;
class ProfileController extends Controller
{
    use ImageTrait;

    public function index(Request $request)
    {
        return view('admin.profile.index');
    }
    public function edit(Request $request)
    {
        return view('admin.profile.edit');
    }

    public function update(Request $request)
    {
        $user= User::where('id',auth()->id())->firstOrFail();
        $request->validate([
            'name'=>"required|min:3|max:190",
            'bio'=>"nullable|max:10000"
        ]);
        $user->update([
            'name'=>$request->name,
            'bio'=>$request->bio
        ]);

        if($request->file('avatar')){

            if(Auth::user()->avatar != 'avatar.jpg'){
                Storage::disk('user_image')->delete(Auth::user()->avatar);
            }
                $dataimage = $this->insertImage(Auth::user()->id,$request->avatar,'assets/img/faces/');
                Auth::user()->update([
                    'avatar' => $dataimage,
                ]);

             }

        //toastr()->success('تمت العملية بنجاح');
        //emotify('info','تمت العملية بنجاح');
           return redirect()->route('profile.index');
    }

    public function update_phone(Request $request){

        $request->validate([
        'old_phone'=>"required",
        'phone'=>"required|confirmed|size:11|unique:users,phone,".auth()->user()->id,

        ]);
        auth()->user()->update([
            'phone'=>$request->phone
        ]);

      //  toastr()->success('تمت عملية تغيير الهاتف بنجاح','عملية ناجحة');
      return redirect()->route('profile.index');
    }

    public function update_password(Request $request){
        $request->validate([
            'old_password'=>"required|string|min:8|max:190",
            'password'=>"required|string|confirmed|min:8|max:190"
        ]);
        if(Hash::check($request->old_password, auth()->user()->password)){
            auth()->user()->update([
                'password'=>Hash::make($request->password)
            ]);
           // toastr()->success('تم تغيير كلمة المرور بنجاح','عملية ناجحة');
           return redirect()->route('profile.index');

        }else{
            //flash()->error('كلمة المرور الحالية التي أدخلتها غير صحيحة','عملية غير ناجحة');
            return redirect()->back();
        }
    }
}
