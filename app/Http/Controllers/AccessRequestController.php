<?php

namespace App\Http\Controllers;

use App\Models\AccessRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AccessRequestController extends Controller
{
    /**
     * Store a new access request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:access_requests,email',
            'country' => 'required|string|max:255',
            'investor_type' => 'required|in:client,developer,family-office,institutional',
            'investment_amount' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'proof_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'consent' => 'required|accepted',
        ]);

        // Handle file upload
        if ($request->hasFile('proof_document')) {
            $path = $request->file('proof_document')->store('proof_documents', 'public');
            $validated['proof_document'] = $path;
        }

        // Create access request
        $accessRequest = AccessRequest::create($validated);

        // Notify all admins
        $admins = User::where('role', 'admin')->get();
        // TODO: Send email notifications to admins

        return redirect()->route('home')->with('success', 'Your application has been submitted successfully! Our team will review it and contact you shortly.');
    }

    /**
     * Show all pending access requests (admin only)
     */
    public function index()
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403);
        }

        $requests = AccessRequest::with('reviewer')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.access-requests.index', compact('requests'));
    }

    /**
     * Approve an access request
     */
    public function approve(Request $request, AccessRequest $accessRequest)
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'access_days' => 'required|integer|min:1',
            'admin_notes' => 'nullable|string',
        ]);

        // Determine role based on investor type
        $role = match($accessRequest->investor_type) {
            'developer' => 'developer',
            default => 'client',
        };

        // Generate temporary password
        $temporaryPassword = Str::random(12);

        // Create user account
        $user = User::create([
            'name' => $accessRequest->name,
            'email' => $accessRequest->email,
            'password' => Hash::make($temporaryPassword),
            'role' => $role,
            'status' => 'active',
            'access_expires_at' => now()->addDays($validated['access_days']),
        ]);

        // Update access request
        $accessRequest->update([
            'status' => 'approved',
            'reviewed_by' => auth()->id(),
            'admin_notes' => $validated['admin_notes'] ?? null,
            'reviewed_at' => now(),
        ]);

        // TODO: Send approval email with credentials

        return redirect()->back()->with('success', 'Access request approved successfully! Temporary password: ' . $temporaryPassword);
    }

    /**
     * Reject an access request
     */
    public function reject(Request $request, AccessRequest $accessRequest)
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'admin_notes' => 'required|string',
        ]);

        $accessRequest->update([
            'status' => 'rejected',
            'reviewed_by' => auth()->id(),
            'admin_notes' => $validated['admin_notes'],
            'reviewed_at' => now(),
        ]);

        // TODO: Send rejection email

        return redirect()->back()->with('success', 'Access request rejected.');
    }
}
