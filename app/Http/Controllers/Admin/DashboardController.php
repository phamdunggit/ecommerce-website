<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function users()
    {
        $users=User::paginate(1);
        return view('admin.users.index',compact('users'));
    }
    public function viewuser($id)
    {
        $user=User::findOrFail($id);
        return view('admin.users.view',compact('user'));
    }
    public function search()
    {
        return view('admin.users.search');
    }
    public function usersearch(Request $request)
    {
        $search_user=$request->user_search;
        if ($search_user!='') {
            $users=User::where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$search_user."%")
            ->orWhere('email',"LIKE","%$search_user%")
            ->orWhere('phone',"LIKE","%$search_user%")->paginate(1);
            if($users){
                return view('admin.users.search',compact('users'));
            }
        } else {
            return redirect()->back();
        }
    }
}
