{{-- Menggunakan layout utama --}}
@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Form Pengajuan Riset Baru')

{{-- Mengisi konten halaman --}}
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="bi bi-file-earmark-text-fill me-2"></i>
                    Formulir Pengajuan Riset
                </h4>
            </div>
            <div class="card-body">
                <p class="card-text text-muted">Silakan isi data di bawah ini dengan lengkap dan benar.</p>

                <form action="{{ route('researchrequest.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Input: Nama Mahasiswa --}}
                    <div class="mb-3">
                        <label for="student_name" class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="student_name" name="student_name" placeholder="Masukkan nama lengkap Anda" required>
                    </div>

                    {{-- Input: Judul Riset --}}
                    <div class="mb-3">
                        <label for="research_title" class="form-label">Judul Riset</label>
                        <input type="text" class="form-control" id="research_title" name="research_title" placeholder="Masukkan judul riset yang diajukan" required>
                    </div>

                    {{-- Input: Instansi Tujuan --}}
                    <div class="mb-3">
                        <label for="target_institution" class="form-label">Instansi Tujuan</label>
                        <input type="text" class="form-control" id="target_institution" name="target_institution" placeholder="Contoh: PT. Teknologi Maju" required>
                    </div>

                    {{-- Input: File Dokumen --}}
                    <div class="mb-4">
                        <label for="document_file" class="form-label">Upload Dokumen (Proposal)</label>
                        <input class="form-control" type="file" id="document_file" name="document_file" accept=".pdf,.doc,.docx,.jpg,.png" required>
                        <div class="form-text">
                            Format yang diterima: PDF, DOC, DOCX, JPG, PNG. Ukuran maks: 5MB.
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-send-fill me-2"></i>
                            Kirim Pengajuan
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection