<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FieldType\StoreFieldTypeRequest;
use App\Http\Requests\FieldType\UpdateFieldTypeRequest;
use App\Models\FieldType;

class FieldTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fieldTypes = FieldType::all();
        return view('admin.fieldTypes.index', compact('fieldTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fieldTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFieldTypeRequest $request)
    {
        FieldType::query()->create($request->validated());
        return to_route('admin.fieldTypes.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FieldType $fieldType)
    {
        return view('admin.fieldTypes.edit', compact('fieldType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFieldTypeRequest $request, FieldType $fieldType)
    {
        $fieldType->update($request->validated());
        return to_route('admin.fieldTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FieldType $fieldType)
    {
        $fieldType->delete();
        return to_route('admin.fieldTypes.index');
    }
}
