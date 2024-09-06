<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageAds;
use Illuminate\Http\Request;

class ImageAdvertisementController extends Controller
{
    public function index()
    {
        $images = ImageAds::get();
        return view('backend.admin.setting.ads_view', compact('images'));
    }
}
