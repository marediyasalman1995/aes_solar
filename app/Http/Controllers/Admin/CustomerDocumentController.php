<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CustomerDocumentDataTable;
use App\Http\Controllers\AppBaseController;
use App\Models\CustomerDocument;
use App\Models\CustomerNotification;
use App\Models\CustomerSite;
use App\Models\User;
use Illuminate\Http\Request;
use Response;

class CustomerDocumentController extends AppBaseController
{
    public function index(CustomerDocumentDataTable $customerDocumentDataTable)
    {
        return $customerDocumentDataTable->render('admin.customer_documents.index');
    }

    public function create()
    {
        $customers = User::where('user_type', 'customer')->orWhereNull('user_type')->with('sites')->get();
        return view('admin.customer_documents.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_site_id' => 'nullable|exists:customer_sites,id',
            'doc_type' => 'required|string',
            'title' => 'required|string|max:255',
            'valid_until' => 'nullable|date',
            'notes' => 'nullable|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:20480',
        ]);

        $data = $request->except('document_file');

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $fileName = 'doc_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/customer_documents');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $file->move($destinationPath, $fileName);
            $data['file_path'] = 'uploads/customer_documents/' . $fileName;
        }

        $doc = CustomerDocument::create($data);

        CustomerNotification::create([
            'user_id' => $request->user_id,
            'title' => 'Document Added: ' . $request->title,
            'message' => 'Your ' . $request->doc_type . ' document is now accessible for download in the AES One portal.',
            'type' => 'warranty',
        ]);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Customer document created successfully!');

        if ($request->ajax()) {
            return Response::json(['message' => 'Document created successfully.', 'back_url' => route('admin.customer-documents.index')]);
        }

        return redirect()->route('admin.customer-documents.index');
    }

    public function edit(CustomerDocument $customerDocument)
    {
        $customers = User::where('user_type', 'customer')->with('sites')->get();
        return view('admin.customer_documents.edit', compact('customerDocument', 'customers'));
    }

    public function update(Request $request, CustomerDocument $customerDocument)
    {
        $request->validate([
            'doc_type' => 'required|string',
            'title' => 'required|string|max:255',
            'valid_until' => 'nullable|date',
            'notes' => 'nullable|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:20480',
        ]);

        $data = $request->except('document_file');

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $fileName = 'doc_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/customer_documents');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $file->move($destinationPath, $fileName);
            $data['file_path'] = 'uploads/customer_documents/' . $fileName;
        }

        $customerDocument->update($data);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Document updated successfully!');

        if ($request->ajax()) {
            return Response::json(['message' => 'Document updated successfully.', 'back_url' => route('admin.customer-documents.index')]);
        }

        return redirect()->route('admin.customer-documents.index');
    }

    public function destroy(CustomerDocument $customerDocument)
    {
        $customerDocument->delete();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Document deleted successfully!');

        return Response::json(['message' => 'Document deleted successfully.']);
    }
}
