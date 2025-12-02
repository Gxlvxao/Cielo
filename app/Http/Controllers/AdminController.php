<?php

namespace App\Http\Controllers;

use App\Models\AccessRequest;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        $stats = [
            'pending_requests' => AccessRequest::where('status', 'pending')->count(),
            'total_properties' => Property::count(),
            'published_properties' => Property::where('status', 'published')->count(),
            'total_users' => User::where('role', '!=', 'admin')->count(),
            'developers' => User::where('role', 'developer')->count(),
            'clients' => User::where('role', 'client')->count(),
        ];

        $recentRequests = AccessRequest::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentProperties = Property::with('owner')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentRequests', 'recentProperties'));
    }

    /**
     * Display access requests
     */
    public function accessRequests()
    {
        $requests = AccessRequest::with('user')
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.access-requests', compact('requests'));
    }

    /**
     * Approve access request
     */
    public function approveAccessRequest(AccessRequest $accessRequest)
    {
        $accessRequest->update([
            'status' => 'approved',
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
        ]);

        // Update user status and role
        $accessRequest->user->update([
            'status' => 'active',
            'role' => $accessRequest->requested_role,
        ]);

        return redirect()->back()->with('success', 'Pedido aprovado com sucesso!');
    }

    /**
     * Reject access request
     */
    public function rejectAccessRequest(Request $request, AccessRequest $accessRequest)
    {
        $validated = $request->validate([
            'rejection_reason' => 'nullable|string|max:500',
        ]);

        $accessRequest->update([
            'status' => 'rejected',
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
            'rejection_reason' => $validated['rejection_reason'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Pedido rejeitado.');
    }

    /**
     * Display all properties for admin management
     */
    public function properties(Request $request)
    {
        $query = Property::with('owner');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // Filter by exclusive
        if ($request->filled('is_exclusive')) {
            $query->where('is_exclusive', $request->is_exclusive);
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by transaction type
        if ($request->filled('transaction_type')) {
            $query->where('transaction_type', $request->transaction_type);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('city', 'like', '%' . $request->search . '%');
            });
        }

        $properties = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.properties', compact('properties'));
    }

    /**
     * Delete property (admin only)
     */
    public function deleteProperty(Property $property)
    {
        // Delete images
        if ($property->images) {
            foreach ($property->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $property->delete();

        return redirect()->back()->with('success', 'Imóvel excluído com sucesso!');
    }
}
