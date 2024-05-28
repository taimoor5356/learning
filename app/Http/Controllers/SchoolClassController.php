<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['header_title'] = 'Classes List';
        $data['records'] = SchoolClass::getClasses()->paginate(25);
        return view('admin.class.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['header_title'] = 'Add Class';
        return view('admin.class.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'name' => 'required|string'
        ]);
        $class = new SchoolClass();
        $class->name = trim($request->name);
        $class->amount = trim($request->amount);
        $class->status = $request->status;
        $class->created_by = Auth::user()->id;
        $class->save(); //remove all save
        return redirect('admin/class/list')->with('success', 'Class created successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolClass $schoolClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data['record'] = SchoolClass::getSingleClass($id);
        if (isset($data['record'])) {
            $data['header_title'] = 'Edit Class Details';
            return view('admin.class.edit', $data);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        request()->validate([
            'name' => 'required|string',
        ]);
        $class = SchoolClass::getSingleClass($id);
        if (isset($class)) {
            $class->name = trim($request->name);
            $class->amount = trim($request->amount);
            $class->status = $request->status;
            $class->created_by = Auth::user()->id;
            $class->save(); //remove all save
            return redirect('admin/class/list')->with('success', 'Class updated successfully');
        } else {
            return redirect()->back()->with('error', 'Class data not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $class = SchoolClass::getSingleClass($id);
        $class->delete();
        return redirect()->back()->with('success', 'Class deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashed()
    {
        //
        $data['header_title'] = 'Trashed Class list';
        $data['records'] = SchoolClass::getTrashedClasses()->paginate(25);
        return view('admin.class.trashed', $data);
    }
}
