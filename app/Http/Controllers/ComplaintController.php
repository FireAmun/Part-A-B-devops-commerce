<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        return view('complaints.index');
    }

    public function store(Request $request)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to submit a complaint.');
        }

        $request->validate([
            'complaint_type' => 'required|in:vendor_specific,general',
            'vendor_id' => 'nullable|integer',
            'subject' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'priority' => 'required|in:low,medium,high'
        ]);

        // Get user data from authenticated user
        $user = auth()->user();

        Complaint::create([
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_phone' => $user->phone,
            'complaint_type' => $request->complaint_type,
            'vendor_id' => $request->vendor_id,
            'subject' => $request->subject,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'pending'
        ]);

        return redirect()->route('complaints.index')
            ->with('success', 'Your complaint has been submitted successfully. We will review it and get back to you soon.');
    }

    public function myComplaints()
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to view your complaints.');
        }

        // Get complaints for the authenticated user
        $complaints = Complaint::where('user_email', auth()->user()->email)
                              ->orderBy('created_at', 'desc')
                              ->get();

        return view('complaints.my-complaints', compact('complaints'));
    }

    public function vendorComplaints(Request $request, $vendorId)
    {
        $query = Complaint::where('vendor_id', $vendorId)
                          ->orWhere(function($q) use ($vendorId) {
                              $q->where('complaint_type', 'general')
                                ->whereNull('vendor_id');
                          });

        // Filter by status if specified
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $complaints = $query->orderBy('created_at', 'desc')->get();

        return compact('complaints');
    }

    public function updateComplaintStatus(Request $request, $complaintId)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,closed',
            'admin_response' => 'nullable|string'
        ]);

        $complaint = Complaint::findOrFail($complaintId);

        $updateData = ['status' => $request->status];

        if ($request->filled('admin_response')) {
            $updateData['admin_response'] = $request->admin_response;
        }

        if ($request->status === 'resolved') {
            $updateData['resolved_at'] = now();
        }

        $complaint->update($updateData);

        return redirect()->back()->with('success', 'Complaint status updated successfully.');
    }
}
