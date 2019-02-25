<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MonitorSites;

class PagesController extends Controller
{
    //

    public function index() {
        $title = 'Welcome to Express';
        return view('pages.index')->with('title', $title);
    }

    public function about() {
        $data = array(
            'title' => 'About Express',
            'features' => ['Fastest Monitors', 'Free bots', 'Guides']
        );
        return view('pages.about')->with($data);
    }

    public function sites() {
        $sites = MonitorSites::all();
        return view('pages.sites')->with('sites', $sites);
    }

}
