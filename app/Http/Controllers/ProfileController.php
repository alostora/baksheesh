<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateProfileRequest;
use App\Models\UpdateProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('Client/Profile/profile');
    }

    public function updateProfileRequest(CreateUpdateProfileRequest $request)
    {
        $validated = $request->validated();

        $validated['client_id'] = auth()->id();

        UpdateProfileRequest::create($validated);

        return back();
    }
}
