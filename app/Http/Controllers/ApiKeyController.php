<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $keys = ApiKey::all();
        return view('admin.api_keys.index', compact('keys'));
    }

    public function create()
    {
        return view('admin.api_keys.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:api_keys,name',
        ]);

        $key = ApiKey::create([
            'name' => $request->name,
            'key' => Str::random(32),
        ]);

        return redirect()->route('admin.api_keys.index')->with('success', 'API Key created successfully. Key: ' . $key->key);
    }

    public function destroy(ApiKey $apiKey)
    {
        $apiKey->delete();
        return redirect()->route('admin.api_keys.index')->with('success', 'API Key deleted successfully.');
    }
}
