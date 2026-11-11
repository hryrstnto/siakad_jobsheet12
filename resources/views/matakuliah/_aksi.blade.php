<!-- NAMA    : HARY RISTANTO
KELAS   : TIF-5C
NIM     : 3202416102 -->
<div class="btn-group btn-group-sm" role="group">
    <a href="{{ route('mata_kuliah.show', $mata_kuliah) }}" class="btn btn-outline-info"
        title="Detail" aria-label="Detail {{ $mata_kuliah->nama }}">
        <i class="bi bi-eye"></i>
    </a>
    @if (Auth::user()->role === 'admin')
        <a href="{{ route('mata_kuliah.edit', $mata_kuliah) }}" class="btn btn-outline-warning"
            title="Ubah" aria-label="Ubah {{ $mata_kuliah->nama }}">
            <i class="bi bi-pencil-square"></i>
        </a>
        <button type="button" class="btn btn-outline-danger btn-hapus"
            data-url="{{ route('mata_kuliah.destroy', $mata_kuliah, false) }}"
            data-nama="{{ $mata_kuliah->nama }}" title="Hapus"
            aria-label="Hapus {{ $mata_kuliah->nama }}">
            <i class="bi bi-trash"></i>
        </button>
    @endif
</div>

