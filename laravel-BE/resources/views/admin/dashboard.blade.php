@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
    <div class="cards">
        <div class="card">
            <div>
                <p>Total Buku</p>
                <h2>1.250</h2>
            </div>
            <i class="fa-solid fa-book"></i>
        </div>
        <div class="card">
            <div>
                <p>Peminjaman</p>
                <h2>215</h2>
            </div>
            <i class="fa-solid fa-book-open-reader"></i>
        </div>
        <div class="card">
            <div>
                <p>Member</p>
                <h2>542</h2>
            </div>
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="card">
            <div>
                <p>Denda</p>
                <h2>Rp350K</h2>
            </div>
            <i class="fa-solid fa-wallet"></i>
        </div>
    </div>

    <div class="content-grid">
        <div class="activity">
            <h3>Aktivitas Terbaru</h3>
            <div class="item">
                <div class="circle blue"></div>
                <p>Andi meminjam buku Algoritma Dasar</p>
            </div>
            <div class="item">
                <div class="circle green"></div>
                <p>Siti mengembalikan buku Basis Data</p>
            </div>
            <div class="item">
                <div class="circle orange"></div>
                <p>Budi terlambat mengembalikan buku</p>
            </div>
            <div class="item">
                <div class="circle blue"></div>
                <p>Rina menambahkan buku baru</p>
            </div>
        </div>

        <div class="quick">
            <h3>Quick Action</h3>
            <button>Tambah Buku</button>
            <button>Tambah Member</button>
            <button>Cetak Laporan</button>
        </div>
    </div>
@endsection