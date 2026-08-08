<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CustomerSiteDataTable;
use App\Http\Controllers\AppBaseController;
use App\Models\CustomerSite;
use App\Models\User;
use Illuminate\Http\Request;
use Response;

class CustomerSiteController extends AppBaseController
{
    public function index(CustomerSiteDataTable $customerSiteDataTable)
    {
        return $customerSiteDataTable->render('admin.customer_sites.index');
    }

    public function create()
    {
        $customers = User::where('user_type', 'customer')->orWhereNull('user_type')->get();
        return view('admin.customer_sites.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'site_name' => 'required|string|max:255',
            'capacity_kw' => 'required|numeric|min:0.1',
            'system_type' => 'required|string',
            'installation_date' => 'nullable|date',
            'inverter_details' => 'nullable|string',
            'panel_details' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'monthly_avg_kwh' => 'nullable|numeric',
            'co2_offset_ton' => 'nullable|numeric',
        ]);

        $site = CustomerSite::create([
            'user_id' => $request->user_id,
            'site_name' => $request->site_name,
            'capacity_kw' => $request->capacity_kw,
            'system_type' => $request->system_type,
            'installation_date' => $request->installation_date ?? now(),
            'inverter_details' => $request->inverter_details,
            'panel_details' => $request->panel_details,
            'address' => $request->address,
            'city' => $request->city,
            'monthly_avg_kwh' => $request->monthly_avg_kwh ?? ($request->capacity_kw * 120),
            'co2_offset_ton' => $request->co2_offset_ton ?? round($request->capacity_kw * 0.5, 2),
            'status' => 1,
        ]);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Solar site created successfully!');

        if ($request->ajax()) {
            return Response::json(['message' => 'Site created successfully.', 'back_url' => route('admin.customer-sites.index')]);
        }

        return redirect()->route('admin.customer-sites.index');
    }

    public function show(CustomerSite $customerSite)
    {
        $customerSite->load(['user', 'serviceRequests', 'documents']);
        return view('admin.customer_sites.show', compact('customerSite'));
    }

    public function edit(CustomerSite $customerSite)
    {
        $customers = User::where('user_type', 'customer')->orWhereNull('user_type')->get();
        return view('admin.customer_sites.edit', compact('customerSite', 'customers'));
    }

    public function update(Request $request, CustomerSite $customerSite)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'capacity_kw' => 'required|numeric|min:0.1',
            'system_type' => 'required|string',
            'installation_date' => 'nullable|date',
            'inverter_details' => 'nullable|string',
            'panel_details' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'monthly_avg_kwh' => 'nullable|numeric',
            'co2_offset_ton' => 'nullable|numeric',
            'status' => 'required|in:0,1',
        ]);

        $customerSite->update($request->all());

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Solar plant details updated successfully!');

        if ($request->ajax()) {
            return Response::json(['message' => 'Site updated successfully.', 'back_url' => route('admin.customer-sites.index')]);
        }

        return redirect()->route('admin.customer-sites.index');
    }

    public function destroy(CustomerSite $customerSite)
    {
        $customerSite->delete();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Site deleted successfully!');

        return Response::json(['message' => 'Site deleted successfully.']);
    }
}
