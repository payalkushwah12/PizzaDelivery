<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Project;
use App\Models\Menu;
use App\Models\Cart;
use App\Mail\PDMail;
use Illuminate\Support\Facades\Mail;
use Session;

class Myproject extends Controller
{
    //
    public function home(){
        return view('project.home');
    }
    public function login(){
        return view('project.login');
    }
    public function postlogin(Request $req){
        $validatedData=$req->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'password.required'=>'pass is required',
            'email.required'=>'Email is required',            
        ]);
        if($validatedData)
        {
            $email=$req->email;
            $password=$req->password;
            $data=Project::where(['email'=>$email])->get();
            if(count($data)>0)
            {
                if(Hash::check($password,$data[0]->password))
                {
                    $req->session()->put('sid',$data);
                    return redirect('/home/dashboard');
                }
                else 
                {
                    return back()->with('errMsg',"Email or Password is incorrect");
                }
            }
            else
            {
                return back()->with('errMsg',"Email or Password is incorrect");
            }
        }
    }
    public function register(){
        return view('project.register');
    }
    public function postregister(Request $req){
        $validatedData=$req->validate([
            'email'=>'required|min:9|max:20',
            'name'=>'required|min:2|max:50',
            'mobile'=>'required|min:10|max:10',
            'address'=>'required|min:3|max:500',
            'password'=>'required|min:5|max:500',
        ],[
            'name.required'=>'name is required',
            'mobile.required'=>'mobile is required',
            'address.required'=>'address is required',
            'password.required'=>'password is required',
            'email.required'=>'Email is required',
            'email.min'=>'minimun 10',
        ]);
        if($validatedData)
        {
        $email=$req->email;
        $password=$req->password;
        $name=$req->name;
        $mobile=$req->mobile;
        $address=$req->address;
          $admin=new Project();
          $admin->email=$email;
          $admin->password=Hash::make($password);
          $admin->name=$name;
          $admin->address=$address;
          $admin->mobile=$mobile;
          if($admin->save())
            {
              return redirect('/home/login');
            }
            else 
            {
              return back()->with('errMsg','Registration Error');
            }
        }
    }
    public function dashboard(){
        $menudata=Menu::all();
        return view("project.dashboard",['menudata'=>$menudata]);
            
    }
    public function add(Request $req){
        $menudata=Menu::all();
        $name=$req->name;
        $data=Cart::where('name',$req->name)->get()->count();
        /* $cart = DB::table('carts')
             ->select('cartvalue')
             ->where('name','=', $req->name)
             ->first();  */
              
        
        if($data<=0)
        {
            $cart = new Cart();
            $cart->name=$req->name;
            $cart->price=$req->price;
            $cart->image=$req->image;
            $cart->cartvalue = 1;
            $cart->save();
        }
        else
        {
           $cart = Cart::select('cartvalue')->where('name',$req->name)->get();
            $b = $cart[0]->cartvalue;
            $c = $b + 1;
            Cart::where('name',$name)->update(['cartvalue'=>$c]);
           
        }
        $cartv=Cart::select('id')->count();
        $req->session()->put('cartv',$cartv);
        return back()->with('menudata',$menudata);
       
    }
    public function cart()
    {
        $sum=0;
        $cartdata=Cart::all();
        foreach($cartdata as $cart)
        {
            $sum = $sum + ($cart->price * $cart->cartvalue);
        }
        return view("project.cart",['cartdata'=>$cartdata],['sum'=>$sum]);
    }
    public function checkout()
    { 
        $sum=0;
        $cartdata=Cart::all();
        foreach($cartdata as $cart)
        {
            $sum = $sum + $cart->price;
        }
        return view("project.checkout",['sum'=>$sum]);
    }
    
    public function deletecart(Request $req)
    { 
        $cartv=session('cartv');
        $cat=Cart::find($req->cid);
        if($cat->delete())
        {
            $cartv--;
            $req->session()->put('cartv',$cartv);
          return "cart deleted";
        }
        else
        {
        return "cart not deleted";
        }
    }
    public function profile()
    {
        $sid= session('sid');
        $email = $sid[0]->email;
        $data=Project::where('email',$email)->first();
        return view("project.profile",['data'=>$data]);
    }
    public function update($id)
    {
        $catdata=Project::where('id',$id)->first();
        return view("project.update",['catdata'=>$catdata]);
    }
    public function updatepro(Request $req)
    {
        Project::where('id',$req->id)->update([
        'name'=>$req->name,
        'mobile'=>$req->mobile,
        'address'=>$req->address,
            ]);
        return redirect('/home/dashboard/profile');
    }
    public function order(Request $req)
    { 
        $validdata= $req->validate([
            'check'=>'required'
        ],[
            'check.required'=>'field is required'
        ]);
        if($validdata)
        {
            $req->session()->put('cartv',0);
        }
        Cart::truncate();
        $sid=session('sid');
        $details=[
            'title'=>'Mail from pizza Delivery',
            'body'=>'Your Pizza order is ordered successfully.'
        ];
        Mail::to("payalkushwah19@gmail.com")->send(new PDmail($details));
        return view("project.order");
    }
    public function sendemail(){
        $details=[
            'title'=>'Mail from pizza Delivery',
            'body'=>'Your Pizza order is ordered successfully.'
        ];
        Mail::to("payalkushwah19@gmail.com")->send(new PDmail($details));
        return "Email Sent";
    }

    public function logout(){
        session()->forget('sid');
        return redirect("/home");
    }

}

