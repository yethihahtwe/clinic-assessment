<?php

namespace App\Http\Controllers;

use App\Models\Subdomain;
use Illuminate\Http\Request;

class SubdomainController extends Controller
{
    public function index()
    {
        $subdomains = Subdomain::all();
        return $subdomains;
    }
}
