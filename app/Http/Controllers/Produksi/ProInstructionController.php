<?php
namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProInstructionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $instructions = DB::table('instructions')
            ->where('division', $user->division)
            ->orderByDesc('id')
            ->get();

        return view('produksi.proinstruksi.index', compact('instructions', 'user'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $instruction = DB::table('instructions')->where('id', $id)->first();

        if (!$instruction) {
            abort(404, 'Instruksi tidak ditemukan.');
        }

        return view('produksi.proinstruksi.detail', compact('instruction', 'user'));
    }

    public function markAsDone($id)
    {
        $instruction = DB::table('instructions')->where('id', $id)->first();

        if (!$instruction || $instruction->status === 'done') {
            return redirect()->back();
        }

        DB::table('instructions')->where('id', $id)->update([
            'status' => 'done'
        ]);

        return redirect()->back()->with('success', 'Instruksi telah ditandai selesai.');
    }
}
