<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sites;
use App\Links;

class SitesController extends Controller
{
    public function index() {
        $sites = Sites::all();
        return view('pages.sites')->with('sites', $sites);
    }

    public function show($name) {
        $site = Sites::where('name', $name)->first();
        $links = Links::where('site', $site->id)->get();

        $site->links = $links;
        return view('pages.site')->with('site', $site);
    }
}
