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
        $users=User::orderby('fname', 'asc')->paginate(1);
        return view('admin.users.index',compact('users'));
    }
    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('query');
            $search = str_replace(" ", "%", $search);
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');

            $users = User::where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$search."%")
            ->orWhere('email',"LIKE","%$search%")
            ->orWhere('phone',"LIKE","%$search%")->orderBy($sort_by, $sort_type)
            ->paginate(1);
            return view('admin.users.data', compact('users'))->render();
        }
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
        $search=$request->user_search;
        if ($search!='') {
            $users=User::where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$search."%")
            ->orWhere('email',"LIKE","%$search%")
            ->orWhere('phone',"LIKE","%$search%")->orderby('fname', 'asc')->paginate(1);
            if($users){
                return view('admin.users.search',compact('users','search'));
            }
        } else {
            return redirect()->back();
        }
    }
}
