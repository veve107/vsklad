<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hardware\Brand;
use App\Models\Hardware\Device;
use App\Models\Hardware\Order;
use App\Models\Hardware\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class HardwareController extends Controller
{
    public function hardware()
    {
        $devices_available = Device::all()->where('status', '=', '1');
        $devices_unavailable = Device::all()->where('status', '=', '2');
        $brands = Brand::all();
        $types = Type::all();
        $orders = Order::all();
        return view('admin.hardware.hardware', compact('devices_available', 'devices_unavailable', 'brands', 'types', 'orders'));
    }

    public function addHardware()
    {
        $brands = Brand::all();
        $types = Type::all();
        $orders = Order::all();
        return view('admin.hardware.add', compact('brands', 'types', 'orders'));
    }

    public function storeHardware(Request $request)
    {
        $this->validate($request, [
            'brand_id' => 'required',
            'name' => 'required|max:55',
            'type_id' => 'required',
            'order_id' => 'required',
            'serial_number' => 'required|max:55',
            'inventory_number' => 'required|unique:devices|numeric',
        ]);
        $device = new Device($request->all());
        $device->save();

        $notification = array(
            'message' => 'Zariadenie úspešne pridané.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function storeType(Request $request)
    {
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


    public function types()
    {
        $types = Type::all();
        return view('admin.hardware.types', compact('types'));
    }

    public function deleteType($id){
        Type::find($id)->delete();
    }
    public function orders()
    {
        $orders = Order::all();
        return view('admin.hardware.orders', compact('orders'));
    }

    public function addOrder()
    {
        return view('admin.hardware.add_order');
    }

    public function brands()
    {
        $brands = Brand::all();
        return view('admin.hardware.brands', compact('brands'));
    }

    public function storeBrand(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->save();
        $notification = array(
            'message' => 'Značka úspešne pridaná.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    //todo
    public function storeOrder(Request $request){
        $this->validate($request, [
            'order_number' => 'required',
            'delivery_date' => 'required',
        ]);

        $order = new Order();
        $order->order_number = $request->order_number;
        $order->delivery_date = Carbon::createFromFormat('m/d/Y', $request->delivery_date);
        $order->end_of_warranty = $order->delivery_date->addYears(2);
        $order->touch();
        $order->save();
        $notification = array(
            'message' => 'Objednávka úspešne pridaná.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }
}
