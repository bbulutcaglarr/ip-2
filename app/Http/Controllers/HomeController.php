<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $campaigns = Campaign::popular()->take(5)->get();

        return view('welcome', compact('campaigns'));
    }
}
