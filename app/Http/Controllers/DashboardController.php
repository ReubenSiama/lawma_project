<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Auth;
use App\User;
use App\Item;
use App\role;
class DashboardController extends Controller
{   
    public function postlogin(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->psw])){
            return redirect('/home');
        }else{
            return back()->with('error','Invalid email or password');
        }
    }
    public function getHome()
    {
        $items = Item::all();
        return view('home',['items'=>$items]);
    }
    public function postLogout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function getProducts()
    {
        $items = Item::all();
        return view('items',['items'=>$items]);
    }
    public function addProducts(ItemRequest $request)
    {
        $img_path = $request->file('image');
        $img_data = file_get_contents($img_path);
        $type = pathinfo($img_path, PATHINFO_EXTENSION);
        $base64 = base64_encode($img_data);
        $item = new Item;
        $item->item_name = $request->item_name;
        $item->image = $base64;
        $item->price = $request->price;
        $item->quantity = $request->quantity;
        if($item->save()){
            return back()->with('Success','Item Added Successfully');
        }else{
            return back()->with('Error','Item Not Added!');
        }
    }
    public function deleteItem(Request $request)
    {
        Item::findOrFail($request->id)->delete();
        return back()->with('Success','Item Deleted Successfully');
    }
    public function editItem(Request $request)
    {
        $item = Item::findOrFail($request->id);
        $item->item_name = $request->item_name;
        if($request->image){
            $img_path = $request->file('image');
            $img_data = file_get_contents($img_path);
            $type = pathinfo($img_path, PATHINFO_EXTENSION);
            $base64 = base64_encode($img_data);
            $item->image = $base64;
        }
        $item->price = $request->price;
        $item->quantity = $request->quantity;
        if($item->save()){
            return back()->with('Success','Item Updated Successfully');
        }else{
            return back()->with('Error','Oops! Something Went Wrong While Updating Item');
        }
    }
    public function getSales()
    {
        $items = Item::all();
        return view('sales',['items'=>$items]);
    }
    public function getEmployees()
    {
        $roles = role::all();
        $users = User::where('role_id','!=',Auth::user()->role_id)->get();
        return view('employees',['roles'=>$roles,'users'=>$users]);
    }
    public function addEmployee(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->phone_no = $request->phNo;
        $user->password = bcrypt($request->password);
        $user->save();
        return back()->with('Success','New Employee Added Successfully');
    }
    public function deleteUser(Request $request)
    {
        User::find($request->id)->delete();
        return back()->with('Success','Employee Deleted');
    }
    public function editUser(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->phone_no = $request->phNo;
        $user->save();
        return back()->with('Success','User details updated successfully');
    }
    public function generateInvoice(Request $request)
    {
        $table = "";
        $total = 0;
        $customer_name = $request->name;
        foreach($request->item as $item){
            $newItem = Item::find($item);
            $total += $amount = $newItem->price * $request->qnty[$newItem->item_name];
            $table .= "<tr>
           
            <td style='text-align:center'>".
            $newItem->item_name  
            ."</td>
            <td style='text-align:center'>".
                $newItem->price
            ."</td>
            <td style='text-align:center'>".
                $request->qnty[$newItem->item_name]
            ."</td>
            <td style='text-align:center'>".
                $amount
            ."</td>
            </tr>";
        }
        return view('invoice',['items'=>$table,'total'=>$total,'customer_name'=>$customer_name]);
    }
}
