<!-- NAMA    : HARY RISTANTO 
KELAS   : TIF-5C
NIM     : 3202416102 -->

<div class="mb-3">
    <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
    <select id="mahasiswa_id" name="mahasiswa_id"
        @class(['form-select', 'is-invalid' => $errors->has('mahasiswa_id')]) required autofocus>
        <option value="">-- Pilih Mahasiswa --</option>
        @foreach ($mahasiswa as $mhs)
            <option value="{{ $mhs->id }}" {{ old('mahasiswa_id', $krs->mahasiswa_id) == $mhs->id ? 'selected' : '' }}>
                {{ $mhs->nim }} - {{ $mhs->nama }}
            </option>
        @endforeach
    </select>
    @error('mahasiswa_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <x-form-input label="Tahun Akademik" name="tahun_akademik" :value="$krs->tahun_akademik"
        maxlength="9" required placeholder="Contoh: 2024/2025" />
</div>

<div class="mb-3">
    <label for="semester" class="form-label">Semester</label>
    <select id="semester" name="semester"
        @class(['form-select', 'is-invalid' => $errors->has('semester')]) required>
        <option value="">-- Pilih Semester --</option>
        <option value="Ganjil" {{ old('semester', $krs->semester) === 'Ganjil' ? 'selected' : '' }}>
            Ganjil
        </option>
        <option value="Genap" {{ old('semester', $krs->semester) === 'Genap' ? 'selected' : '' }}>
            Genap
        </option>
    </select>
    @error('semester')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select id="status" name="status"
        @class(['form-select', 'is-invalid' => $errors->has('status')]) required>
        <option value="">-- Pilih Status --</option>
        <option value="draft" {{ old('status', $krs->status) === 'draft' ? 'selected' : '' }}>
            Draft
        </option>
        <option value="diajukan" {{ old('status', $krs->status) === 'diajukan' ? 'selected' : '' }}>
            Diajukan
        </option>
        <option value="disetujui" {{ old('status', $krs->status) === 'disetujui' ? 'selected' : '' }}>
            Disetujui
        </option>
        <option value="ditolak" {{ old('status', $krs->status) === 'ditolak' ? 'selected' : '' }}>
            Ditolak
        </option>
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Tambahan: Pilihan Mata Kuliah (Detail KRS) -->
<div class="mb-3">
    <label class="form-label fw-semibold">Pilih Mata Kuliah (Detail KRS)</label>
    @error('mata_kuliah_ids')
        <div class="text-danger small mb-2">{{ $message }}</div>
    @enderror

    <div @class(['card p-3', 'border-danger' => $errors->has('mata_kuliah_ids')]) style="max-height: 250px; overflow-y: auto;">
        @php
            $selectedMk = old('mata_kuliah_ids', isset($selectedMataKuliah) ? $selectedMataKuliah : []);
        @endphp
        @forelse ($mataKuliah as $mk)
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="mata_kuliah_ids[]" 
                       value="{{ $mk->id }}" id="mk_{{ $mk->id }}"
                       {{ is_array($selectedMk) && in_array($mk->id, $selectedMk) ? 'checked' : '' }}>
                <label class="form-check-label" for="mk_{{ $mk->id }}">
                    <strong>{{ $mk->kode ?? $mk->kode_mk }}</strong> - {{ $mk->nama ?? $mk->nama_mk }} ({{ $mk->sks }} SKS)
                </label>
            </div>
        @empty
            <p class="text-muted mb-0">Belum ada data mata kuliah yang tersedia.</p>
        @endforelse
    </div>
</div>