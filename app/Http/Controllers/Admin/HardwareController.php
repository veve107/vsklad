<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hardware\Brand;
use App\Models\Hardware\Device;
use App\Models\Hardware\Order;
use App\Models\Hardware\Type;
use Illuminate\Http\Request;

class HardwareController extends Controller
{
    public function hardware()
    {
        $devices = Device::all();
        $brands = Brand::all();
        $types = Type::all();
        $orders = Order::all();
        return view('admin.hardware.hardware', compact('devices', 'brands', 'types', 'orders'));
    }

    public function addHardware()
    {
        $brands = Brand::all();
        $types = Type::all();
        $orders = Order::all();
        return view('admin.hardware.add', compact('brands', 'types', 'orders'));
    }

    public function storeHardware(Request $request){
        $this->validate($request, [
            'brand_id' => 'required',
            'name' => 'required|max:55',
            'type_id' => 'required',
            'order_id' => 'required',
            'serial_number' => 'required|max:55',
            'inventory_number' => 'required|unique:devices|max:55',
        ]);
        $device = new Device($request->all());
        $device->save();

        $notification = array(
            'message' => 'Zariadenie úspešne pridané.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function storeType(Request $request){
        $this->validate($request, [
           'name' => 'required',
        ]);
        $type = new Type();
        $type->name = $request->name;
        $type->save();
        $notification = array(
            'message' => 'Typ úspešne pridaný.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }


    public function types(){
        $types = Type::all();
        return view('admin.hardware.types', compact('types'));
    }
    public function orders(){
        $orders = Order::all();
        return view('admin.hardware.orders', compact('orders'));
    }
    public function addOrder(){
        return view('admin.hardware.add_order');
    }



}
