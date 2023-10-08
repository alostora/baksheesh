<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateProfileRequest;
use App\Http\Requests\UpdatePassword;
use App\Models\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function updatePassword(UpdatePassword $request)
    {
        $validated = $request->validated();

        User::where('id', auth()->id())->update(['password' => Hash::make($validated['password'])]);

        return back();
    }
}
