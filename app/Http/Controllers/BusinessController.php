<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;

class BusinessController extends Controller
{
  public function index()
  {
    $user = \Auth::user();

    $businesses = $user->businesses()->get();

    return response()->json($businesses);
  }

  public function show($id)
  {
    $business = Business::findOrFail($id);

    return response()->json($business);
  }

  public function store(Request $request)
  {
    $user = $request->user();

    $business = new Business;

    $business->name   = $request->name;
    $business->email  = $request->email;
    $business->phone  = $request->phone;
    $business->address  = $request->address;

    if ($user->addBusiness($business)) {
      return response()->json($business, 201);
    }else{
      return responde()->json(['error' => 'Failed'], 404);
    }
  }

  public function update(Request $request, $id)
  {
    $business = Business::findOrFail($id);

    $business->name   = $request->name;
    $business->email  = $request->email;
    $business->user_id  = $request->user_id;
    $business->phone  = $request->phone;
    $business->address  = $request->address;

    if ($business->update()) {
      return response()->json($business, 200);
    }else{
      return responde()->json(['error' => 'Failed'], 404);
    } 

  }

  public function destroy($id)
  {
    $business = Business::findOrFail($id);

    if ($business->delete()) {
      return response()->json(['message' => 'Business Deleted'], 200);
    }else{
      return response()->json(['error' => 'Failed'], 404);
    }
  }
}
