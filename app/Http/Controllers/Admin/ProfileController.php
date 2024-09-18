<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function changePasswordPage(){
        return view('admin.profile.changePassword'); 
    }

    // change password
    public function changePassword(Request $request){
        $this->checkValidation($request);

        // login win htr tae user password ko a yin shar
        $currentLoginPassword = Auth::user()->password; // or auth()->user()->password kyite ta lo coding

        if(Hash::check($request->oldPassword, $currentLoginPassword)){
            User::where('id',Auth::user()->id)->update([
               'password' => Hash::make($request->newPassword) 
            ]);
            Alert::success('Success', 'Password Changed Successfully');
            return to_route('adminHome');
        }else{
            Alert::error('Error', 'Old password does not match');
            return back();
        }
        
    }

    // route to account profile
    public function profile(){
        return view('admin.profile.accountProfile');
    }

    // route to edit profile page
    public function editProfilePage(){
        return view('admin.profile.edit');
    }

    // edit profile
    public function editProfile(Request $request){
        $this->checkProfileValidation($request);
        $data = $this->requestProfileData($request);

        if($request->hasFile('image')){
            // delete old image
            if(Auth::user()->profile != null){
                if(file_exists(public_path().'/profile/'.Auth::user()->profile)){
                    unlink(public_path().'/profile/'.Auth::user()->profile);
                }
            }

            // store image
            // first step => filename that mhat
            $fileName = uniqid().$request->file('image')->getClientOriginalName();

            // second step => file path that mhat
            $request->file('image')->move(public_path().'/profile/',$fileName);

            // third step => store in database
            $data['profile'] = $fileName;

        }else{
            //$data['db name']
            // new image ma htae yin old image ko use ag
            $data['profile'] = Auth::user()->profile;
        }

        User::where('id',Auth::user()->id)->update($data);
        Alert::success('Success', 'Profile Updated Successfully');
        return to_route('profileAccount');
    }

    // check passwor validate
    private function checkValidation($request){
        $request->validate([
            'oldPassword' => 'required', 
            'newPassword' => 'required|min:6', 
            'confirmPassword' => 'required|same:newPassword|min:6', 
        ]);
    }

    // route addnew admin page
    public function addNewAdminPage(){       
        return view('admin.addAdmin.create');
    }

    // add new admin
    public function addNewAdmin(Request $request){
        $this->checkAddAdminValidation($request);
        $data = $this->requestAddAdminData($request);
        User::create($data);
        Alert::success('Success', 'New Admin Added Successfully');
        return to_route('adminList');
    }

    // admin list
    public function adminList(){
        // data search tr % % htae tr ka sin tu tr tway pr shar ya ag
            $admin = User::select('id','name','email','phone','address','role','created_at')
                        ->whereIn('role',['admin','superadmin'])
                        ->when(request('search'),function($query){
                            $query->whereAny(['name','email','address','phone','role'],'like','%'.request('search').'%');
                        })
                        ->orderBy('id','asc')
                        ->get();
                                               
        return view('admin.addAdmin.list',compact('admin'));
    }

    //delete admin acc
    public function adminDelete($id){
        User::find($id)->delete();
        Alert::success('Success', 'Admin Account Deleted Successfully');
        return back();
    }

    // route user page
    public function userList(){
        $users = User::select('id','name','nickname','email','phone','address','role','created_at')
                        ->where('role','user')
                        ->when(request('search'),function($query){
                            $query->whereAny(['name','email','nickname','address','phone','role'],'like','%'.request('search').'%');
                        })
                        ->orderBy('id','desc')
                        ->paginate(5);
        return view('admin.addUser.list',compact('users'));
    }

    //route add user page
    public function addNewUserPage(){
        return view('admin.addUser.create');
    }

    //add user
    public function addNewUser(Request $request){
        $this->checkAddAdminValidation($request);
        $data = $this->requestAddUserData($request);
        User::create($data);
        Alert::success('Success', 'New User Added Successfully');
        return to_route('userList');
    }

    //delete user
    public function userDelete($id){
        User::find($id)->delete();
        Alert::success('Success', 'User Account Deleted Successfully');
        return back();
    }


    // request profile data
    private function requestProfileData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }

    // check profile validate
    private function checkProfileValidation($request){
        $request->validate([
            'name' => 'required', 
            //email ka unique phit pho lo tal. d tai update twat unique check yin email alredy use phit nay mal
            //because login win htr tae email nae db htae ko email tu nay loh
            //so login win htr tae email ka lwae yin ta chr mail nae check ag out ko lo lote
            'email' => 'required|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|unique:users,phone,'.Auth::user()->id, 
            'image' => 'mimes:jpeg,jpg,png,svg|file'
        ]);
    }

    // check add new admin validation
    private function checkAddAdminValidation($request){
        $request->validate([
            'name' => 'required|min:3|max:30',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password|min:6'
        ]);
    }

    // request add new admin data
    private function requestAddAdminData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin'
        ];
    }

    //request user data
    private function requestAddUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ];
    }

}
