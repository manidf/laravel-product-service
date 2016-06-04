<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
  /**
   * Display a listing of the ResourceBundle
   * @return Response
   **/
  public function index()
  {
    return Product::paginate();
  }

  /**
   * Store a newly created resource in storage
   * @param Request $Request
   * @return Response
   **/
  public function store(Request $request)
  {
    // insert record
    return Product::create([
      'name' => $request->input('name')
    ]);
  }

  /**
   * Update the specified resource in storage/
   *
   * @param Request $requested
   * @param int $id
   * @return Response
   **/
  public function update(Request $request, $id)
  {

  }
}
