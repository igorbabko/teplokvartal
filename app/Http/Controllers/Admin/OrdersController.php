<?php

namespace DymaVDomeNet\Http\Controllers\Admin;

use Illuminate\Http\Request;

use DymaVDomeNet\Http\Requests;
use DymaVDomeNet\Http\Controllers\Controller;
use DymaVDomeNet\Order;
use DymaVDomeNet\Http\Middleware\Authenticate;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Order::destroy($id); 

        $this->flashData($request, [
            'type' => 'success',
            'message' => 'Заявка успешно удалена!',
        ]);

        return back();
    }

    protected function flashData(Request $request, $data = [])
    {
        foreach ($data as $key => $value) {
            $request->session()->flash($key, $value);
        }
    }
}