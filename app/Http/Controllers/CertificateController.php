<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Resources\CertificateResource;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificates = Certificate::all();
        return CertificateResource::collection($certificates);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'issuer' => 'required|string',
            'date' => 'required|date',
        ]);

        $certificate = Certificate::create($request->all());

        return response()->json([
            'message' => 'Certificate created successfully',
            'data' => $certificate
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $certificate = Certificate::find($id);
        
        if (!$certificate) {
            return response()->json(['message' => 'Certificate not found'], 404);
        }
        
        return new CertificateResource($certificate);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Certificate $certificate)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $certificate = Certificate::find($id);

        if (!$certificate) {
            return response()->json(['message' => 'Certificate not found'], 404);
        }

        $certificate->update($request->all());

        return response()->json([
            'message' => 'Certificate updated successfully',
            'data' => $certificate
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $certificate = Certificate::find($id);

        if (!$certificate) {
            return response()->json([
                'message' => 'Certificate not found'
            ], 404);
        }

        $certificate->delete();

        return response()->json([
            'message' => 'Certificate deleted successfully'
        ]);
    }
}
