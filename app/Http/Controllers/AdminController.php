<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\Measurement;
use App\Models\User;
use App\Models\Puskesmas;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ChildrenExport;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalChildren = Child::count();
        $totalMeasurements = Measurement::count();
        $totalPetugas = User::where('role', 'petugas')->count();
        $stuntedChildren = Measurement::whereIn('status', ['Sangat Pendek', 'Pendek'])->count();

        return view('admin.dashboard', compact('totalChildren', 'totalMeasurements', 'totalPetugas', 'stuntedChildren'));
    }

    public function children(Request $request)
    {
        $query = Child::with('measurements');

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
        }

        $children = $query->paginate(15);

        return view('admin.children.index', compact('children'));
    }

    public function showChild(Child $child)
    {
        $measurements = $child->measurements()->orderBy('measurement_date', 'desc')->get();
        return view('admin.children.show', compact('child', 'measurements'));
    }

    public function measurements(Request $request)
    {
        $query = Measurement::with(['child', 'user']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->date_from) {
            $query->whereDate('measurement_date', '>=', $request->date_from);
        }

        if ($request->date_to) {
            $query->whereDate('measurement_date', '<=', $request->date_to);
        }

        $measurements = $query->orderBy('measurement_date', 'desc')->paginate(15);

        return view('admin.measurements.index', compact('measurements'));
    }

    public function petugas()
    {
        $petugas = User::where('role', 'petugas')->paginate(15);
        return view('admin.petugas.index', compact('petugas'));
    }

    public function createPetugas()
    {
        return view('admin.petugas.create');
    }

    public function storePetugas(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas',
        ]);

        return redirect()->route('admin.petugas')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function editPetugas(User $user)
    {
        return view('admin.petugas.edit', compact('user'));
    }

    public function updatePetugas(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.petugas')->with('success', 'Petugas berhasil diupdate');
    }

    public function destroyPetugas(User $user)
    {
        $user->delete();
        return redirect()->route('admin.petugas')->with('success', 'Petugas berhasil dihapus');
    }

    public function puskesmas()
    {
        $puskesmas = Puskesmas::first();
        return view('admin.puskesmas.edit', compact('puskesmas'));
    }

    public function updatePuskesmas(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'schedule' => 'required|string',
        ]);

        $puskesmas = Puskesmas::first();

        if ($puskesmas) {
            $puskesmas->update($request->all());
        } else {
            Puskesmas::create($request->all());
        }

        return redirect()->route('admin.puskesmas')->with('success', 'Profil Puskesmas berhasil diupdate');
    }

    public function export()
    {
        $filename = 'children_data.xlsx';

        // Simpan file dulu ke storage
        Excel::store(new ChildrenExport, 'exports/' . $filename);

        // Baru kemudian di-download
        return response()->download(storage_path('app/exports/' . $filename));
    }
}
