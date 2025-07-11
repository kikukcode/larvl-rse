{{-- Menggunakan layout utama --}}
@extends('layouts.app')

{{-- Judul Halaman --}}
@section('title', 'Daftar Riset Mahasiswa')

{{-- Konten Halaman --}}
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-table me-2"></i>
                Data Riset Mahasiswa
            </h4>
            {{-- Tombol Create --}}
            <a href="{{ route('researchrequest.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle-fill me-2"></i>
                Tambah Riset Baru
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Judul Riset</th>
                            <th scope="col">Instansi Tujuan</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop data riset (contoh dengan data dummy) --}}
                        {{-- Gantilah @php ... @endphp dengan data dari controller Anda, contoh: @foreach ($researches as $research) --}}
                        

                        @forelse ($researches as $research)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $research->student_name }}</td>
                                <td>{{ $research->research_title }}</td>
                                <td>{{ $research->target_institution }}</td>
                                <td class="text-center">
                                    {{-- Tombol Lihat Dokumen --}}
                                    <a href="{{ route('researchrequest.show', $research->id) }}" class="btn btn-info btn-sm"
                                        title="Lihat Dokumen">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('researchrequest.edit', $research->id) }}"
                                        class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- Tombol Delete --}}
                                    <form action="{{ route('researchrequest.destroy', $research->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Belum ada data riset yang diajukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
