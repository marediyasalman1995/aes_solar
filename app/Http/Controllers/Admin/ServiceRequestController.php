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
    public function index(ServiceRequestDataTable $serviceRequestDataTable)
    {
        return $serviceRequestDataTable->render('admin.service_requests.index');
    }

    public function show(ServiceRequest $serviceRequest)
    {
        $serviceRequest->load(['user', 'site']);
        return view('admin.service_requests.show', compact('serviceRequest'));
    }

    public function update(Request $request, ServiceRequest $serviceRequest)
    {
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

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Service ticket updated successfully!');

        if ($request->ajax()) {
            return Response::json(['message' => 'Service ticket updated successfully.', 'back_url' => route('admin.service-requests.index')]);
        }

        return redirect()->route('admin.service-requests.index');
    }

    public function destroy(ServiceRequest $serviceRequest)
    {
        $serviceRequest->delete();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Service request deleted successfully!');

        return Response::json(['message' => 'Service request deleted successfully.']);
    }
}
