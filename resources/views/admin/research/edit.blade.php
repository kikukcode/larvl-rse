@extends('layouts.app')

@section('title', 'Edit Data Riset')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-fill me-2"></i>
                        Edit Formulir Riset
                    </h4>
                </div>
                <div class="card-body">
                    {{-- Arahkan action ke route update dengan menyertakan ID --}}
                    <form action="{{ route('researchrequest.update', $research->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- ... (input untuk nama, judul, dan instansi tetap sama) ... --}}

                        {{-- Input: Nama Mahasiswa --}}
                        <div class="mb-3">
                            <label for="student_name" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="student_name" name="student_name"
                                value="{{ $research->student_name }}" required>
                        </div>

                        {{-- Input: Judul Riset --}}
                        <div class="mb-3">
                            <label for="research_title" class="form-label">Judul Riset</label>
                            <input type="text" class="form-control" id="research_title" name="research_title"
                                value="{{ $research->research_title }}" required>
                        </div>

                        {{-- Input: Instansi Tujuan --}}
                        <div class="mb-3">
                            <label for="target_institution" class="form-label">Instansi Tujuan</label>
                            <input type="text" class="form-control" id="target_institution" name="target_institution"
                                value="{{ $research->target_institution }}" required>
                        </div>

                        {{-- === BAGIAN YANG DIUBAH === --}}
                        {{-- Input: File Dokumen --}}
                        <div class="mb-4">
                            <label for="document_file" class="form-label">Dokumen</label>

                            {{-- Tampilkan file yang sudah ada JIKA ada --}}
                            @if ($research->document_file)
                                <div class="alert alert-light p-2 mb-2">
                                    <strong>Dokumen Saat Ini:</strong>
                                    <a href="{{ asset('storage/' . $research->document_file) }}" target="_blank"
                                        class="btn btn-outline-info btn-sm">
                                        <i class="bi bi-eye-fill me-1"></i>
                                        Lihat Dokumen
                                    </a>
                                </div>
                            @endif

                            {{-- Input untuk upload file baru --}}
                            <input class="form-control" type="file" id="document_file" name="document_file"
                                accept=".pdf,.doc,.docx,.jpg,.png">
                            <div class="form-text">
                                <strong>Upload file baru untuk menggantinya.</strong> Kosongkan jika tidak ingin mengubah
                                dokumen.
                            </div>
                        </div>
                        {{-- Preview Dokumen --}}
                        <div id="preview-container" class="mt-3">
                            <strong>Preview:</strong>
                            <div id="file-preview" class="border rounded p-2"></div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('researchrequest.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save-fill me-2"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById('document_file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('file-preview');
            preview.innerHTML = ''; // bersihkan preview lama

            if (!file) return;

            const fileType = file.type;

            if (fileType.startsWith('image/')) {
                // Preview Gambar
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-fluid rounded shadow-sm';
                    img.style.maxHeight = '300px';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            } else if (fileType === 'application/pdf') {
                // Preview PDF
                const pdf = document.createElement('iframe');
                pdf.src = URL.createObjectURL(file);
                pdf.width = '100%';
                pdf.height = '400px';
                pdf.className = 'border';
                preview.appendChild(pdf);
            } else {
                // File selain gambar/pdf
                preview.textContent = `File terpilih: ${file.name}`;
            }
        });
    </script>
@endpush
