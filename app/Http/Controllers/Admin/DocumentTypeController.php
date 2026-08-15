<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Response;

class DocumentTypeController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('permission:document-types.index')->only(['index']);
        $this->middleware('permission:document-types.create')->only(['create', 'store']);
        $this->middleware('permission:document-types.edit')->only(['edit', 'update']);
        $this->middleware('permission:document-types.view')->only(['show']);
        $this->middleware('permission:document-types.delete')->only(['destroy']);
    }

    public function index()
    {
        $documentTypes = DocumentType::paginate(15);
        return view('admin.document_types.index', compact('documentTypes'));
    }

    public function create()
    {
        return view('admin.document_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        DocumentType::create([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Document Type created successfully!');

        if ($request->ajax()) {
            return Response::json([
                'message' => 'Document Type created successfully.',
                'back_url' => route('admin.document-types.index')
            ]);
        }

        return redirect()->route('admin.document-types.index');
    }

    public function edit(DocumentType $documentType)
    {
        return view('admin.document_types.edit', compact('documentType'));
    }

    public function update(Request $request, DocumentType $documentType)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $documentType->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Document Type updated successfully!');

        if ($request->ajax()) {
            return Response::json([
                'message' => 'Document Type updated successfully.',
                'back_url' => route('admin.document-types.index')
            ]);
        }

        return redirect()->route('admin.document-types.index');
    }

    public function destroy(DocumentType $documentType)
    {
        $documentType->delete();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Document Type deleted successfully!');

        if (request()->ajax()) {
            return Response::json(['message' => 'Document Type deleted successfully.']);
        }

        return redirect()->route('admin.document-types.index');
    }
}
