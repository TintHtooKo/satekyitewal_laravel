<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    //direct user home page
    public function userHome(){ 
        // a twinn htae mhr use htr tae categoryId ko ma ti loh use keyword ko use tr
        $products = Product::select('products.id','products.name','products.price','products.description','products.image','categories.name as category_name')
                    ->leftJoin('categories','products.category_id','categories.id')

                    // search with name
                    ->when(request('search'), function($query){
                        $query = $query->where('products.name','like','%'.request('search').'%');
                    })

                    // sorting
                    //sorting si phox blade bat ka nay select option ye value htae mhr
                    // string a nay nae ko si chin tae name and acs or desc a yin htae htr tal
                    // ae string ko array a nay nae ya ag a yin lote ya mal
                    // ae twat explode and comma khan p string two khu ko array a phit change pay lite tal
                    ->when(request('sortingType'), function($query){
                        $sortRule = explode(',',request('sortingType'));
                        $sortName = 'products.'.$sortRule[0];
                        $sortType = $sortRule[1];
                        $query = $query->orderBy($sortName,$sortType);
                    })

                    // search with category
                    // route nae ma phan pal url nae phan loh request nae u tr
                    // url nae phan tr ka active color lote ya easy ag
                    ->when(request('categoryId'),function($query){
                        $query->where('products.category_id',request('categoryId'));
                    })

                    // filter price
                    // min = true || max = true
                    ->when(request('minPrice') != null && request('maxPrice') != null, function($query){
                        $query = $query->whereBetween('products.price',[request('minPrice'),request('maxPrice')]);
                    })

                    // filter price
                    // min = true || max = false
                    ->when(request('minPrice') != null && request('maxPrice') == null, function($query){
                        $query = $query->where('products.price','>=',request('minPrice'));
                    })

                    // filter price
                    // min = false || max = true
                    ->when(request('minPrice') == null && request('maxPrice') != null, function($query){
                        $query = $query->where('products.price','<=',request('maxPrice'));
                    })
                    ->get();
        $categories = Category::get();
        return view('user.home.list',compact('products','categories'));
    }

    // user profile
    public function userProfile(){
        return view('user.profile.profile');
    }

    // route to user profile edit page
    public function userEditPage(){
        return view('user.profile.edit');
    }

    public function userEdit(Request $request){
        $this->checkUserValidate($request);
        $data = $this->requestUserData($request);
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
        };

        User::where('id',Auth::user()->id)->update($data);
        Alert::success('Success', 'Profile Updated Successfully');
        return to_route('userProfile');
    }

    // route to user password change page
    public function changePasswordPage(){
        return view('user.profile.changepw');
    }

    //user password change
    public function changePassword(Request $request){
        $this->checkPasswordValidation($request);
        $currentPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword,$currentPassword)){
            User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword),
            ]);
            Alert::success('Success', 'Password Changed Successfully');
            return to_route('userProfile');
        }else{
            Alert::error('Error', 'Old password does not match');
            return back();
        }
    }

    //validate user profile
    private function checkUserValidate($request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|numeric|unique:users,phone,'.Auth::user()->id,
        ]);
    }

    // request user data
    private function requestUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }

    //password validate
    private function checkPasswordValidation($request){
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|same:newPassword|min:6',
        ]);
    }
}
