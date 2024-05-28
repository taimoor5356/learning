<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\ZoomClass;
use Illuminate\Http\Request;

class ZoomClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['header_title'] = 'Zoom Classes';
        $data['records'] = ZoomClass::getAllZoomClasses()->paginate(25);
        return view('zoom_classes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['header_title'] = 'Add Zoom Class';
        $data['subjects'] = Subject::getSubjects()->get();
        return view('zoom_classes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $zoomClass = new ZoomClass();
        $zoomClass->class_id = $request->class_id;
        $zoomClass->subject_id = $request->subject_id;
        $zoomClass->zoom_link = $request->zoom_link;
        $zoomClass->status = !empty($request->status) ? 1 : 0;
        $zoomClass->date = $request->date;
        $zoomClass->time = $request->time;
        $zoomClass->description = $request->description;
        $zoomClass->save(); //remove all save
        return redirect('zoom-classes')->with('success', 'Save Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ZoomClass $zoomClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data['header_title'] = 'Edit Zoom Class';
        $zoomClass = ZoomClass::find($id);
        if (isset($zoomClass)) {
            $data['record'] = $zoomClass;
            $data['subjects'] = Subject::getSubjects()->get();
            return view('zoom_classes.edit', $data);
        } else {
            return redirect()->back()->with('error', 'Resource not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $zoomClass = ZoomClass::find($id);
        $zoomClass->class_id = $request->class_id;
        $zoomClass->subject_id = $request->subject_id;
        $zoomClass->zoom_link = $request->zoom_link;
        $zoomClass->status = !empty($request->status) ? 1 : 0;
        $zoomClass->date = $request->date;
        $zoomClass->time = $request->time;
        $zoomClass->description = $request->description;
        $zoomClass->save(); //remove all save
        return redirect('zoom-classes')->with('success', 'Saved Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ZoomClass $zoomClass)
    {
        //
    }
}
