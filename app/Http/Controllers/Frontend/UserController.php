<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kjmtrue\VietnamZone\Models\Province;
use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Ward;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('frontend.orders.index', compact('orders'));
    }
    public function view($id)
    {
        $orders = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $provinces = Province::where('id', $orders->province_id)->first();
        $districts = District::where('id', $orders->district_id)->first();
        $wards = Ward::where('id', $orders->ward_id)->first();
        return view('frontend.orders.view', compact('orders', 'provinces', 'districts', 'wards'));
    }
    public function cancel($id)
    {
        $orders = Order::where('id', $id)->where('user_id', Auth::id())->first();
        $orders->status = '3';
        $orders->update();
        return redirect('/my-orders');
    }
    public function profile()
    {
        $user = Auth::user();
        $provinces = Province::get();
        $districts = District::whereProvinceId(Auth::user()->province_id)->get();
        $wards = Ward::whereDistrictId(Auth::user()->district_id)->get();
        return view('frontend.profile', compact('user','provinces','districts','wards'));
    }
    public function avatar(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        $path = 'assets/uploads/avatar/'. $user->avatar;
            if (File::exists($path)) {
                File::delete($path);
            }
        $img=$request->input('imageUrl');
        preg_match('/data:image\/(gif|jpeg|png);base64,(.*)/i', $img, $matches);
        // $img = str_replace('data:image/png;base64,', '', $img);
        // $img = str_replace(' ', '+', $img);
        // $fileData = base64_decode($img);
        // $filetype= $matches[1];
        $fileData = base64_decode($matches[2]);
        //saving
        $filename = time() . '.' . 'png';
        $image = imagecreatefromstring($fileData);
        // $file->move('assets/uploads/avatar/', $filename);
        imagepng($image, public_path().'\\assets\\uploads\\avatar\\'. $filename);
            $user->avatar = $filename;
            $user->update();
        return response()->json('Bất ngờ chưa thằng lz');
    }
    public function update(Request $request)
    {
        if (Auth::user()->address !== $request->input('address')
        ||Auth::user()->fname!==$request->input('fname')
        ||Auth::user()->lname!==$request->input('lname')
        ||Auth::user()->phone!==$request->input('phone')
        ||Auth::user()->province_id!==$request->input('province')
        ||Auth::user()->district_id!==$request->input('district')
        ||Auth::user()->ward_id!==$request->input('ward')) {
            $user = User::where('id', Auth::id())->first();
            $user->fname = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->province_id = $request->input('province');
            $user->district_id = $request->input('district');
            $user->ward_id = $request->input('ward');
            $user->update();
        }
        return redirect('/profile');
    }
    public function changepassword()
    {
        $user = Auth::user();
        return view("auth.passwords.change",compact('user'));
    }
    public function updatepassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'newpass' => ['required', 'string', 'min:8', 'confirmed'],
            'newpass_confirmation' => ['required', 'string', 'min:8', ],
        ]);
        $curent_user=User::where('id',Auth::id())->first();
        if(Hash::check($request->password,$curent_user->password)){
            $curent_user->password= bcrypt($request->newpass) ;
            $curent_user->update();
            return redirect('/change-password')->with('status', "Password Updated Successfully");
        } else {
            return redirect('/change-password')->with('status', "Wrong pass");
        }

    }
}
