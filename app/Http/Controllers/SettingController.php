<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['header_title'] = 'System Settings';
        $data['record'] = Setting::find(1);
        return view('admin.settings.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $setting = Setting::find($id);
        if (isset($setting)) {
            $setting = $setting;
        } else {
            $setting = new Setting();
        }
        $setting->school_name = $request->school_name;
        $setting->school_logo_name = $request->school_logo_name;
        $setting->school_description = $request->school_description;
        $setting->school_email = $request->school_email;
        if (!empty($request->school_email_password)) {
            $setting->school_email_password = Hash::make($request->school_email_password);
        }
        $setting->school_email_api_key = $request->school_email_api_key;
        $setting->school_sms_api_key = $request->school_sms_api_key;
        $setting->school_email_description = $request->school_email_description;
        $setting->school_exam_report_description = $request->school_exam_report_description;
        $setting->school_login_page_notification_01 = $request->school_login_page_notification_01;
        $setting->school_login_page_notification_02 = $request->school_login_page_notification_02;
        $setting->school_login_page_notification_03 = $request->school_login_page_notification_03;
        // Images
        // Store multiple images for settings
        $settings = [
            'school_browser_icon',
            'school_logo',
            'school_login_page_image_one',
            'school_login_page_image_two',
            'school_login_page_image_three',
            'school_login_page_image_four',
            'school_login_page_image_five'
        ];

        if ($request->hasFile('school_images')) {
            foreach ($settings as $key => $image) {
                if (!empty($request->file('school_images')[$key])) {
                    if (!empty($setting->$image) && file_exists('public/images/school_images' . $setting->$image)) {
                        unlink('public/images/school_images/' . $setting->$image);
                    }
                    $ext = $request->file('school_images')[$key]->getClientOriginalExtension();
                    $fileName = 'sch' . Str::random(10) . '.' . $ext;
                    $request->file('school_images')[$key]->move('public/images/school_images', $fileName);
                    $setting->$image = $fileName;
                }
            }
        }
        $setting->save(); //remove all save
        return redirect()->back()->with('success', 'Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
