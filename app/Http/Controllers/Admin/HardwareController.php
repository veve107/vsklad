<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hardware\Brand;
use App\Models\Hardware\Device;
use App\Models\Hardware\Order;
use App\Models\Hardware\Type;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

class HardwareController extends Controller
{
    /*
     * Hardware
     * */
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
        ]);
        $type = Type::findOrFail($request->type_id);
        if ($type->type == 1) {
            $this->validate($request, [
                'serial_number' => 'required|max:55',
            ]);
        } else {
            $this->validate($request, [
                'stock' => 'required|numeric',
            ]);
        }
        $device = new Device($request->all());
        $device->save();

        $notification = array(
            'message' => 'Zariadenie úspešne pridané.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function deleteHardware($id)
    {

    }

    /*
     * Types
     * */
    public function types()
    {
        $types = Type::all();
        return view('admin.hardware.types', compact('types'));
    }

    public function storeType(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
        ]);
        $type = new Type($request->all());
//        $type->name = $request->name;
        $type->save();
        $notification = array(
            'message' => 'Typ úspešne pridaný.',
            'alert-type' => 'success',
        );

        return Redirect()->back()->with($notification);
    }

    public function updateType($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $type = Type::findOrFail($id);
        $type->name = $request->name;
        $type->save();
        $notification = array(
            'message' => 'Typ úspešne upravený.',
            'alert-type' => 'success',
        );

        return Redirect()->back()->with($notification);
    }

    public function deleteType($id)
    {
        $type = Type::find($id);
        if ($type->requests->isEmpty() && $type->devices->isEmpty()) {
            $type->delete();
            $notification = array(
                'message' => 'Typ úspešne zmazaný.',
                'alert-type' => 'success',
            );
        } else {
            $notification = array(
                'message' => 'Nie je možné zmazať používaný typ!',
                'alert-type' => 'error',
            );
        }

        return Redirect()->back()->with($notification);
    }

    /*
     * Orders
     * */
    public function orders()
    {
        $orders = Order::all();
        return view('admin.hardware.orders', compact('orders'));
    }

    public function storeOrder(Request $request)
    {
        $this->validate($request, [
            'order_number' => 'required',
            'delivery_date' => 'required',
            'warranty_years' => 'required'
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
        return Redirect()->route('hardware.orders')->with($notification);
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);
        if ($order->devices->isEmpty()) {
            $order->delete();
            $notification = array(
                'message' => 'Objednávka úspešne zmazaná.',
                'alert-type' => 'success',
            );
        } else {
            $notification = array(
                'message' => 'Nie je možné zmazať používanú objednávku!',
                'alert-type' => 'error',
            );
        }

        return Redirect()->back()->with($notification);
    }

    /*
     * Brands
     * */
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

    public function deleteBrand($id)
    {
        $brand = Brand::find($id);
        if ($brand->devices->isEmpty()) {
            $brand->delete();
            $notification = array(
                'message' => 'Značka úspešne zmazana.',
                'alert-type' => 'success',
            );
        } else {
            $notification = array(
                'message' => 'Nie je možné zmazať používanú značku!',
                'alert-type' => 'error',
            );
        }

        return Redirect()->back()->with($notification);
    }

    public function updateBrand($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->save();
        $notification = array(
            'message' => 'Značka úspešne upravená.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

}
