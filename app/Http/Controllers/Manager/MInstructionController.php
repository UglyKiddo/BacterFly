<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MInstructionController extends Controller
{
    public function index()
    {
        $instructions = DB::table('instructions')->orderByDesc('id')->get();
        return view('manager.instruksi.index', compact('instructions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'division' => 'required|string',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        DB::table('instructions')->insert([
            'division' => $request->division,
            'title' => $request->title,
            'content' => $request->content,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('manager.instruksi')->with('success', 'Instruksi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        DB::table('instructions')->where('id', $id)->delete();
        return redirect()->route('manager.instruksi')->with('success', 'Instruksi dihapus.');
    }

    public function markAsDone($id)
    {
    if (!is_numeric($id) || $id <= 0) {
        return redirect()->route('manager.instruksi')->with('error', 'ID tidak valid.');
    }

    try {
        DB::table('instructions')->where('id', $id)->update(['status' => 'done']);
        return redirect()->route('manager.instruksi')->with('success', 'Instruksi ditandai sebagai selesai.');
    } catch (\Exception $e) {
        \Log::error('Gagal update status instruksi: ' . $e->getMessage());
        return redirect()->route('manager.instruksi')->with('error', 'Gagal memperbarui status.');
    }   
    }

    public function show($id)
    {
    $instruksi = DB::table('instructions')->where('id', $id)->first();

    if (!$instruksi) {
        return redirect()->route('manager.instruksi')->with('error', 'Instruksi tidak ditemukan.');
    }

    return view('manager.instruksi.detail', compact('instruksi'));
    }

    public function edit($id)
    {
    $instruksi = DB::table('instructions')->where('id', $id)->first();

    if (!$instruksi) {
        return redirect()->route('manager.instruksi')->with('error', 'Instruksi tidak ditemukan.');
    }

    return view('manager.instruksi.edit', compact('instruksi'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'division' => 'required|string',
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    DB::table('instructions')->where('id', $id)->update([
        'division' => $request->division,
        'title' => $request->title,
        'content' => $request->content,
        'updated_at' => now(),
    ]);

    return redirect()->route('manager.instruksi')->with('success', 'Instruksi berhasil diperbarui.');
    }

}