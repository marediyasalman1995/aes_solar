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
    public function __construct()
    {
        $this->middleware('permission:customer-documents.index')->only(['index']);
        $this->middleware('permission:customer-documents.create')->only(['create', 'store']);
        $this->middleware('permission:customer-documents.edit')->only(['edit', 'update']);
        $this->middleware('permission:customer-documents.view')->only(['show']);
        $this->middleware('permission:customer-documents.delete')->only(['destroy']);
    }

    public function index(CustomerDocumentDataTable $customerDocumentDataTable)
    {
        return $customerDocumentDataTable->render('admin.customer_documents.index');
    }

    public function create()
    {
        $customersQuery = User::where(function($q) {
            $q->where('user_type', 'customer')->orWhereNull('user_type');
        })->with('sites');
        if (auth()->check() && auth()->user()->hasRole('Dealer')) {
            $customersQuery->where('dealer_id', auth()->id());
        }
        $customers = $customersQuery->get();
        $documentTypes = \App\Models\DocumentType::where('status', 1)->get();
        return view('admin.customer_documents.create', compact('customers', 'documentTypes'));
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

        if (auth()->check() && auth()->user()->hasRole('Dealer')) {
            $customer = User::find($request->user_id);
            if (!$customer || $customer->dealer_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }
        }

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

        // Send Document Uploaded Email
        $customer = User::find($request->user_id);
        if ($customer && $customer->email) {
            \App\MyClasses\MailHelper::sendMail($customer->email, 'New Document Uploaded — ' . $request->title, 'emails.document_uploaded', [
                'user' => $customer,
                'title' => $request->title,
                'doc_type' => $request->doc_type,
                'notes' => $request->notes
            ]);
        }

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Customer document created successfully!');

        if ($request->ajax()) {
            return Response::json(['message' => 'Document created successfully.', 'back_url' => route('admin.customer-documents.index')]);
        }

        return redirect()->route('admin.customer-documents.index');
    }

    public function edit(CustomerDocument $customerDocument)
    {
        if (auth()->check() && auth()->user()->hasRole('Dealer')) {
            if ($customerDocument->user && $customerDocument->user->dealer_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }
        }
        $customersQuery = User::where(function($q) {
            $q->where('user_type', 'customer')->orWhereNull('user_type');
        })->with('sites');
        if (auth()->check() && auth()->user()->hasRole('Dealer')) {
            $customersQuery->where('dealer_id', auth()->id());
        }
        $customers = $customersQuery->get();
        $documentTypes = \App\Models\DocumentType::where('status', 1)->get();
        return view('admin.customer_documents.edit', compact('customerDocument', 'customers', 'documentTypes'));
    }

    public function update(Request $request, CustomerDocument $customerDocument)
    {
        if (auth()->check() && auth()->user()->hasRole('Dealer')) {
            if ($customerDocument->user && $customerDocument->user->dealer_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }
        }

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
        if (auth()->check() && auth()->user()->hasRole('Dealer')) {
            if ($customerDocument->user && $customerDocument->user->dealer_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }
        }

        $customerDocument->delete();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Document deleted successfully!');

        return Response::json(['message' => 'Document deleted successfully.']);
    }
}
