<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $query = transaksi::with(['book', 'user'])->latest();

        if (Auth::user()->role === 'member') {
            $query->where('user_id', Auth::id());
        }

        $transactions = $query->get();

        return view('transaksi.index', compact('transactions'));
    }

    public function create()
    {
        return view('transaksi.create', [
            'books' => book::where('dipinjam', false)->get(),
            'users' => User::where('role', 'member')->get(),
        ]);
    }

    // Simpan peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $book = book::findOrFail($request->book_id);

        // cek apakah buku sudah dipinjam
        if ($book->dipinjam) {
            return back()->with('error', 'Buku sedang dipinjam');
        }

        transaksi::create([
            'book_id'        => $book->id,
            'user_id'        => $request->user_id,
            'tanggal_pinjam' => now(),
            'status'         => 'dipinjam',
        ]);

        $book->update([
            'dipinjam' => true,
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Buku berhasil dipinjam');
    }

    public function return(transaksi $transaction)
    {
        if (
            (Auth::user()->role == 'member') &&
            ($transaction->user_id != Auth::id())
        ) {
            abort(403);
        }

        if ($transaction->status === 'dikembalikan') {
            return redirect()
                ->route('transactions.index')
                ->with('error', 'Buku ini sudah dikembalikan');
        }

        $transaction->update([
            'tanggal_kembali' => now(),
            'status'          => 'dikembalikan',
        ]);

        $transaction->book->update([
            'dipinjam' => false,
        ]);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Buku berhasil dikembalikan');
    }
}
