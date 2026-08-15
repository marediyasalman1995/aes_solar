<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Models\ReferralPointSetting;
use Illuminate\Http\Request;
use Response;

class ReferralPointSettingController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('permission:referral-point-settings.index')->only(['index']);
        $this->middleware('permission:referral-point-settings.create')->only(['create', 'store']);
        $this->middleware('permission:referral-point-settings.edit')->only(['edit', 'update']);
        $this->middleware('permission:referral-point-settings.view')->only(['show']);
        $this->middleware('permission:referral-point-settings.delete')->only(['destroy']);
    }

    public function index()
    {
        $referralPointSettings = ReferralPointSetting::paginate(15);
        return view('admin.referral_point_settings.index', compact('referralPointSettings'));
    }

    public function create()
    {
        return view('admin.referral_point_settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:Credit,Debit',
            'amount' => 'required|numeric|min:0',
        ]);

        ReferralPointSetting::create([
            'title' => $request->title,
            'type' => $request->type,
            'amount' => $request->amount,
        ]);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Referral Point Setting created successfully!');

        if ($request->ajax()) {
            return Response::json([
                'message' => 'Referral Point Setting created successfully.',
                'back_url' => route('admin.referral-point-settings.index')
            ]);
        }

        return redirect()->route('admin.referral-point-settings.index');
    }

    public function edit(ReferralPointSetting $referralPointSetting)
    {
        return view('admin.referral_point_settings.edit', compact('referralPointSetting'));
    }

    public function update(Request $request, ReferralPointSetting $referralPointSetting)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:Credit,Debit',
            'amount' => 'required|numeric|min:0',
        ]);

        $referralPointSetting->update([
            'title' => $request->title,
            'type' => $request->type,
            'amount' => $request->amount,
        ]);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Referral Point Setting updated successfully!');

        if ($request->ajax()) {
            return Response::json([
                'message' => 'Referral Point Setting updated successfully.',
                'back_url' => route('admin.referral-point-settings.index')
            ]);
        }

        return redirect()->route('admin.referral-point-settings.index');
    }

    public function destroy(ReferralPointSetting $referralPointSetting)
    {
        $referralPointSetting->delete();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Referral Point Setting deleted successfully!');

        if (request()->ajax()) {
            return Response::json(['message' => 'Referral Point Setting deleted successfully.']);
        }

        return redirect()->route('admin.referral-point-settings.index');
    }
}
