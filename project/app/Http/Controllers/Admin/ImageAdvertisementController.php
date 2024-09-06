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

    public function add()
    {
        return view(('backend.admin.setting.ads_add'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg,webp',
        ]);

        if ($request->hasFile('image')) {
            // Retrieve the extension of the uploaded photo file
            $ext = $request->file('image')->getClientOriginalExtension();
            
            // Generate a unique file name for the photo using the current timestamp
            $final_name = time() . '.' . $ext;
            
            // Move the uploaded photo file to the specified directory with the new file name
            $request->file('image')->move(public_path('assets/images/'), $final_name);

            // Save image name to database
            $image_ads = new ImageAds();
            $image_ads->image = $final_name;
            $image_ads->save();

            return redirect()->back()->with('success', 'Image uploaded successfully!');
        }

    }

    public function delete($id)
    {
        $ads_image = ImageAds::where('id', $id)->first();
        $ads_image->delete();

        return redirect()->back()->with('success', 'Image has been deleted successfully!');
    }
}
