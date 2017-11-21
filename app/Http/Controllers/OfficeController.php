<?php

namespace App\Http\Controllers;

use App\Office;
use App\Business;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
  public function index($id_business)
  {
    $business = Business::find($id_business);
    $offices = $business->offices()->get();

    return response()->json($offices, 200);
  }

  public function store(Request $request, $id_business)
  {
    $business = Business::find($id_business);

    $office = new Office;

    $office->name       = $request->name;
    $office->phone      = $request->phone;
    $office->email      = $request->email;
    $office->address    = $request->address;
    $office->latitude   = $request->latitude;
    $office->longitude  = $request->longitude;

    if ($business->addOffice($office)) {
      return response()->json($office, 201);
    }else{
      return responde()->json(['error' => 'Failed'], 404);
    }
  }

  public function show($id)
  {
    $office = Office::find($id);

    if ($office) {
      return response()->json($office, 200);
    }else{
      return response()->json(['error' => 'Failed'], 404);
    }
  }

  public function update(Request $request, $id)
  {
    $office = Office::find($id);

    if ($office) {

      $office->name       = $request->name;
      $office->phone      = $request->phone;
      $office->email      = $request->email;
      $office->address    = $request->address;
      $office->latitude   = $request->latitude;
      $office->longitude  = $request->longitude;

      if ($office->update()) {
        return response()->json($office, 200);
      }else {
        return response()->json(['error' => 'Failed'], 404);
      }
    }else{
      return response()->json(['error' => 'Failed'], 404);
    }
  }

  public function destroy($id)
  {
    $office = Office::find($id);

    if ($office) {
      if ($office->delete()) {
        return response()->json(['status' => 'Deleted success'], 200);
      }else{
        return response()->json(['error' => 'Failed'], 404);
      }
    }else{
      return response()->json(['error' => 'Failed'], 404);
    }
  }
}
