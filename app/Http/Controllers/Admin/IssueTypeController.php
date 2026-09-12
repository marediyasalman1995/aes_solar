<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Models\IssueType;
use Illuminate\Http\Request;
use Response;

class IssueTypeController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('permission:issue-types.index')->only(['index']);
        $this->middleware('permission:issue-types.create')->only(['create', 'store']);
        $this->middleware('permission:issue-types.edit')->only(['edit', 'update']);
        $this->middleware('permission:issue-types.view')->only(['show']);
        $this->middleware('permission:issue-types.delete')->only(['destroy']);
    }

    public function index()
    {
        $issueTypes = IssueType::orderBy('sort_order', 'asc')->paginate(15);
        return view('admin.issue_types.index', compact('issueTypes'));
    }

    public function create()
    {
        return view('admin.issue_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        IssueType::create([
            'title' => $request->title,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
        ]);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Issue Type created successfully!');

        if ($request->ajax()) {
            return Response::json([
                'message' => 'Issue Type created successfully.',
                'back_url' => route('admin.issue-types.index')
            ]);
        }

        return redirect()->route('admin.issue-types.index');
    }

    public function edit(IssueType $issueType)
    {
        return view('admin.issue_types.edit', compact('issueType'));
    }

    public function update(Request $request, IssueType $issueType)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $issueType->update([
            'title' => $request->title,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
        ]);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Issue Type updated successfully!');

        if ($request->ajax()) {
            return Response::json([
                'message' => 'Issue Type updated successfully.',
                'back_url' => route('admin.issue-types.index')
            ]);
        }

        return redirect()->route('admin.issue-types.index');
    }

    public function destroy(IssueType $issueType)
    {
        $issueType->delete();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Issue Type deleted successfully!');

        if (request()->ajax()) {
            return Response::json(['message' => 'Issue Type deleted successfully.']);
        }

        return redirect()->route('admin.issue-types.index');
    }
}
