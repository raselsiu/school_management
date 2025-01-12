<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  
    public function view()
    {
        $data['allUser'] = User::where('usertype','=','admin')->get();
        return view('backend.user.view_user',$data);
    }

  
    public function add(Request $request)
    {
        return view('backend.user.add_user');
    }

 
    public function store(Request $request)
    {

        $this->validate($request, [
            'role' => 'required',
            'name' => 'required | max:20',
            'email' => 'required|email|unique:users,email',
        ]);


        $code = rand(0000,9999);
        $data = new User();
        $data->usertype = 'admin';
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($code);
        $data->code = $code;
        $data->save();
        return redirect()->route('backUsersView')->with('success','User Created Successfully!');
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        return view('backend.user.edit',compact('user'));
    }

   
    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'role' => 'required',
            'name' => 'required | max:20',
            'email' => 'required|email',
        ]);

        $user = User::find($id);
        $user->role = $request->role;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('backUsersView')->with('success','Data Updated Successfully!');
    }

  
    public function delete(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('backUsersView')->with('success','Data Deleted Successfully!');
    }
}
