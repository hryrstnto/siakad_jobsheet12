<!-- NAMA    : HARY RISTANTO 
KELAS   : TIF-5C
NIM     : 3202416102 -->

<div class="mb-3">
    <x-form-input label="Kode Mata Kuliah" name="kode_mk" :value="$mata_kuliah->kode_mk"
        maxlength="10" required autofocus placeholder="Contoh: TIF123" />
</div>

<div class="mb-3">
    <x-form-input label="Nama Mata Kuliah" name="nama_mk" :value="$mata_kuliah->nama_mk"
        maxlength="100" required placeholder="Contoh: Pemrograman Web" />
</div>

<div class="mb-3">
    <x-form-input label="Jumlah SKS" name="sks" type="number" :value="$mata_kuliah->sks"
        min="1" max="8" required placeholder="Contoh: 3" />
</div>
