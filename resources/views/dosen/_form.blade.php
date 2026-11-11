<!-- NAMA    : HARY RISTANTO 
KELAS   : TIF-5C
NIM     : 3202416102 -->
<div class="mb-3">
    <x-form-input label="NIDN" name="nidn" :value="$dosen->nidn"
        maxlength="20" required autofocus />
</div>

<div class="mb-3">
    <x-form-input label="Nama Dosen" name="nama" :value="$dosen->nama"
        maxlength="120" required />
</div>

<div class="mb-3">
    <label for="jabatan_fungsional" class="form-label">Jabatan Fungsional</label>
    <select id="jabatan_fungsional" name="jabatan_fungsional"
        @class(['form-select', 'is-invalid' => $errors->has('jabatan_fungsional')])>
        <option value="">-- Pilih Jabatan Fungsional --</option>
        @foreach (['Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Guru Besar'] as $jabatan)
            <option value="{{ $jabatan }}"
                {{ old('jabatan_fungsional', $dosen->jabatan_fungsional) === $jabatan ? 'selected' : '' }}>
                {{ $jabatan }}
            </option>
        @endforeach
    </select>
    @error('jabatan_fungsional')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <x-form-input label="Email" name="email" type="email" :value="$dosen->email"
        maxlength="120" required />
</div>

<div class="mb-3">
    <x-form-input label="Telepon" name="telepon" :value="$dosen->telepon"
        maxlength="20" />
</div>

<div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <textarea id="alamat" name="alamat" rows="3" maxlength="500"
        @class(['form-control', 'is-invalid' => $errors->has('alamat')])
    >{{ old('alamat', $dosen->alamat) }}</textarea>
    @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>