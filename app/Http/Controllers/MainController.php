<?php

namespace pnit\Http\Controllers;

use Illuminate\Session\SessionManager as Session;
use Illuminate\Http\Request;


class MainController extends Controller
{
  public function principal(Request $request){
    return view('index');
  }
}
