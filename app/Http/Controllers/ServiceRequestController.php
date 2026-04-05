<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'email' => ['required', 'email'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $service = Service::findOrFail($validated['service_id']);
        $user = $request->user();

        ServiceRequest::create([
            'user_id' => $user?->id,
            'service_id' => $service->id,
            'email' => $validated['email'],
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'] ?: null,
            'phone' => $validated['phone'] ?: null,
            'description' => $validated['description'],
        ]);

        return redirect()
            ->route('services')
            ->with('success', __('services.request_success'));
    }

    public function index()
    {
        $serviceRequests = ServiceRequest::with(['service', 'user'])
            ->orderByDesc('id')
            ->paginate(15);

        return view('admin.service-request.index', compact('serviceRequests'));
    }

    public function show(ServiceRequest $serviceRequest)
    {
        $serviceRequest->load(['service', 'user']);

        return view('admin.service-request.show', compact('serviceRequest'));
    }
}
