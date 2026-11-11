<!-- NAMA    : HARY RISTANTO 
KELAS   : TIF-5C
NIM     : 3202416102 -->

<div class="mb-3">
    <x-form-input label="NIM" name="nim" :value="$mahasiswa->nim"
        maxlength="20" required autofocus />
</div>

<div class="mb-3">
    <x-form-input label="Nama Mahasiswa" name="nama" :value="$mahasiswa->nama"
        maxlength="120" required />
</div>

<div class="mb-3">
    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
    <select id="jenis_kelamin" name="jenis_kelamin"
        @class(['form-select', 'is-invalid' => $errors->has('jenis_kelamin')])>
        <option value="">-- Pilih Jenis Kelamin --</option>
        <option value="L" {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) === 'L' ? 'selected' : '' }}>
            Laki-laki
        </option>
        <option value="P" {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) === 'P' ? 'selected' : '' }}>
            Perempuan
        </option>
    </select>
    @error('jenis_kelamin')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <x-form-input label="Email" name="email" type="email" :value="$mahasiswa->email"
        maxlength="120" required />
</div>

<div class="mb-3">
    <x-form-input label="Angkatan" name="angkatan" :value="$mahasiswa->angkatan"
        maxlength="10" placeholder="Contoh: 2024" />
</div>

<div class="mb-3">
    <x-form-input label="Program Studi" name="program_studi" :value="$mahasiswa->program_studi"
        maxlength="50" placeholder="Contoh: Teknik Informatika" />
</div>
