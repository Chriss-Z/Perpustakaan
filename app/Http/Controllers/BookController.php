<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // 15
    public function index()
    {
        $books = Book::latest()->get();
        return view('Book.index', compact('books'));
    }

    public function create()
    {
        return view('Book.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_buku'   => 'required|string|max:50|unique:books,kd_buku',
            'judul'     => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit'  => 'required|string|max:255',
            'tahun'     => 'required|digits:4',
        ]);

        book::create($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(book $book)
    {
        // 
        return view('Book.edit', compact('book'));
    }

    public function update(Request $request, book $book)
    {
        $request->validate([
            'kd_buku'   => 'required|string|max:50',
            'judul'     => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit'  => 'required|string|max:255',
            'tahun'     => 'required|digits:4',
        ]);

        $book->update($request->only([
            'kd_buku',
            'judul',
            'pengarang',
            'penerbit',
            'tahun',
        ]));

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    public function borrow(book $book)
    {
        // Cek apakah buku sedang dipinjam
        if ($book->dipinjam) {
            return back()->with('error', 'Buku sedang dipinjam');
        }

        transaksi::create([
            'user_id'          => Auth::id(),
            'book_id'          => $book->id, // sesuai model kamu
            'tanggal_pinjam'   => now(),
            'status'           => 'dipinjam',
        ]);

        $book->update(['dipinjam' => true]);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dipinjam');
    }

    public function destroy(book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}
