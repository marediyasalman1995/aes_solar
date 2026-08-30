<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ServiceRequestDataTable;
use App\Http\Controllers\AppBaseController;
use App\Models\CustomerNotification;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Response;

class ServiceRequestController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('permission:service-requests.index')->only(['index']);
        $this->middleware('permission:service-requests.create')->only(['create', 'store']);
        $this->middleware('permission:service-requests.edit')->only(['edit', 'update']);
        $this->middleware('permission:service-requests.view')->only(['show']);
        $this->middleware('permission:service-requests.delete')->only(['destroy']);
    }

    public function index(ServiceRequestDataTable $serviceRequestDataTable)
    {
        return $serviceRequestDataTable->render('admin.service_requests.index');
    }

    public function show(ServiceRequest $serviceRequest)
    {
        if (auth()->check() && auth()->user()->hasRole('Dealer')) {
            if ($serviceRequest->user && $serviceRequest->user->dealer_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }
        }
        $serviceRequest->load(['user', 'site']);
        return view('admin.service_requests.show', compact('serviceRequest'));
    }

    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        if (auth()->check() && auth()->user()->hasRole('Dealer')) {
            if ($serviceRequest->user && $serviceRequest->user->dealer_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }
        }

        $request->validate([
            'status' => 'required|in:Pending,Scheduled,In Progress,Resolved,Cancelled',
            'admin_notes' => 'nullable|string',
        ]);

        $serviceRequest->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        CustomerNotification::create([
            'user_id' => $serviceRequest->user_id,
            'title' => 'Service Ticket ' . $serviceRequest->ticket_no . ' ' . $request->status,
            'message' => 'Status for your service request (' . $serviceRequest->issue_type . ') has been updated to ' . $request->status . '.',
            'type' => 'service',
        ]);

        // Send Service Ticket Updated Email
        if ($serviceRequest->user && $serviceRequest->user->email) {
            \App\MyClasses\MailHelper::sendMail($serviceRequest->user->email, 'Service Ticket ' . $serviceRequest->ticket_no . ' Update: ' . $serviceRequest->status, 'emails.service_request_updated', [
                'user' => $serviceRequest->user,
                'ticket' => $serviceRequest
            ]);
        }

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Service ticket updated successfully!');

        if ($request->ajax()) {
            return Response::json(['message' => 'Service ticket updated successfully.', 'back_url' => route('admin.service-requests.index')]);
        }

        return redirect()->route('admin.service-requests.index');
    }

    public function destroy(ServiceRequest $serviceRequest)
    {
        if (auth()->check() && auth()->user()->hasRole('Dealer')) {
            if ($serviceRequest->user && $serviceRequest->user->dealer_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }
        }

        $serviceRequest->delete();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Service request deleted successfully!');

        return Response::json(['message' => 'Service request deleted successfully.']);
    }
}
