<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Auth;
use App\User;
use App\Item;
use App\role;
use App\Invoice;
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
        $item->quantity = $item->quantity + $request->quantity;
        if($item->save()){
            return back()->with('Success','Item Updated Successfully');
        }else{
            return back()->with('Error','Oops! Something Went Wrong While Updating Item');
        }
    }
    public function getSales()
    {
        $invoices = Invoice::orderBy('created_at','DESC')->get();
        $myItem = Item::all();
        $statsW = array();
        $statsY = array();
        $items = array();
        $items2 = array();
        $today = date('Y-m-d');
        $previous_week = date('Y-m-d',strtotime('-6 days'));
        foreach($invoices as $invoice){
            if(!in_array($invoice->item_name,$items)){
                $count = Invoice::where('item_name',$invoice->item_name)->where('invoice_date','>=',$previous_week)->where('invoice_date','<=',$today)->count();
                array_push($statsW,['item'=>$invoice->item_name,'count'=>$count]);
            }
            array_push($items,$invoice->item_name);
        }
        foreach($invoices as $invoice){
            if(!in_array($invoice->item_name,$items2)){
                $count = Invoice::where('item_name',$invoice->item_name)->count();
                array_push($statsY,['item'=>$invoice->item_name,'count'=>$count]);
            }
            array_push($items2,$invoice->item_name);
        }
        return view('sales',['invoices'=>$invoices,'week_sales'=>$statsW,'all_sales'=>$statsY]);
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
        $customer_name = $request->name;
        if(count($request->item) == 0){
            return back()->with('Error','Please select item');
        }
        $total = 0;
        $items = Item::whereIn('id',$request->item)->get();
        $invoiceNumber = "ANSS".time();
        foreach($items as $item){
            if($item->quantity < $request->qnty[$item->item_name]){
                return back()->with('Error','You are running out of stock on '.$item->item_name);
            }
        }
        foreach($items as $item){
            $invoice = new Invoice;
            $invoice->invoice_no = $invoiceNumber;
            $invoice->invoice_date = date('Y-m-d');
            $invoice->customer_name = $customer_name;
            $invoice->item_name = $item->item_name;
            $invoice->price = $item->price;
            $invoice->quantity = $request->qnty[$item->item_name];
            $invoice->total = $request->qnty[$item->item_name] * $item->price;
            $invoice->save();
            $item->quantity = $item->quantity - $request->qnty[$item->item_name];
            $item->save();
        }
        return view('invoice',['customer_name'=>$customer_name,'items'=>$items,'quantity'=>$request->qnty,'total'=>$total,'invoice_number'=>$invoiceNumber]);
    }
}
