<?php

namespace App\Http\Controllers;

use App\Models\RecyclingCenter;
use Illuminate\Http\Request;

class AdminRecyclingCenterController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_unless(auth()->check() && auth()->user()->is_admin, 403);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $query = RecyclingCenter::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('address', 'like', '%' . $request->search . '%');
            });
        }

        $centers = $query->latest()->paginate(15);
        return view('admin.recycling-centers.index', compact('centers'));
    }

    public function create()
    {
        return view('admin.recycling-centers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'address'            => 'required|string',
            'latitude'           => 'required|numeric|between:-90,90',
            'longitude'          => 'required|numeric|between:-180,180',
            'accepted_materials' => 'nullable|array',
        ]);

        RecyclingCenter::create([
            'name'               => $request->name,
            'address'            => $request->address,
            'latitude'           => $request->latitude,
            'longitude'          => $request->longitude,
            'accepted_materials' => $request->accepted_materials ?? [],
        ]);

        return redirect()->route('admin.recycling-centers.index')->with('success', 'Bank sampah baru berhasil ditambahkan ke peta.');
    }

    public function edit(RecyclingCenter $recyclingCenter)
    {
        return view('admin.recycling-centers.edit', compact('recyclingCenter'));
    }

    public function update(Request $request, RecyclingCenter $recyclingCenter)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'address'            => 'required|string',
            'latitude'           => 'required|numeric|between:-90,90',
            'longitude'          => 'required|numeric|between:-180,180',
            'accepted_materials' => 'nullable|array',
        ]);

        $recyclingCenter->update([
            'name'               => $request->name,
            'address'            => $request->address,
            'latitude'           => $request->latitude,
            'longitude'          => $request->longitude,
            'accepted_materials' => $request->accepted_materials ?? [],
        ]);

        return redirect()->route('admin.recycling-centers.index')->with('success', 'Data bank sampah berhasil diperbarui.');
    }

    public function destroy(RecyclingCenter $recyclingCenter)
    {
        $recyclingCenter->delete();
        return back()->with('success', 'Bank sampah berhasil dihapus dari sistem.');
    }
}
