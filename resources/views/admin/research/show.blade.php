{{-- Menggunakan layout utama --}}
@extends('layouts.app')

{{-- Judul Halaman --}}
@section('title', 'Detail Riset')

{{-- Konten Halaman --}}
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            {{-- Card Header --}}
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bi bi-file-earmark-text-fill me-2"></i>
                    Detail Riset Mahasiswa
                </h4>
                {{-- Tombol Aksi --}}
                <div>
                    <a href="{{ route('researchrequest.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                    <a href="{{ route('researchrequest.edit', $research->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </a>
                </div>
            </div>

            {{-- Card Body --}}
            <div class="card-body">
                {{-- Judul Riset sebagai heading utama --}}
                <h3 class="card-title border-bottom pb-2 mb-3">{{ $research->research_title }}</h3>

                {{-- Detail lainnya --}}
                <dl class="row">
                    <dt class="col-sm-4">Nama Mahasiswa</dt>
                    <dd class="col-sm-8">{{ $research->student_name }}</dd>

                    <dt class="col-sm-4">Instansi Tujuan</dt>
                    <dd class="col-sm-8">{{ $research->target_institution }}</dd>

                    <dt class="col-sm-4">Tanggal Pengajuan</dt>
                    <dd class="col-sm-8">{{ $research->created_at->format('d F Y H:i') }}</dd>

                    <dt class="col-sm-4">Pembaruan Terakhir</dt>
                    <dd class="col-sm-8">{{ $research->updated_at->format('d F Y H:i') }}</dd>
                </dl>

                <hr>

                {{-- Bagian Dokumen --}}
                <h5><i class="bi bi-paperclip me-2"></i>Dokumen Terlampir</h5>
                @if ($research->document_file)
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $research->document_file) }}" target="_blank" class="btn btn-success">
                            <i class="bi bi-download me-2"></i>
                            Unduh / Lihat Dokumen
                        </a>
                    </div>
                @else
                    <div class="alert alert-warning mt-2" role="alert">
                        Tidak ada dokumen yang diunggah.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection