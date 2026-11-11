<!-- NAMA    : HARY RISTANTO
KELAS   : TIF-5C
NIM     : 3202416102 -->
<div class="btn-group btn-group-sm" role="group">
    <a href="{{ route('krs.show', $krs) }}" class="btn btn-outline-info"
        title="Detail" aria-label="Detail {{ $krs->nama }}">
        <i class="bi bi-eye"></i>
    </a>
    @if (Auth::user()->role === 'admin')
        <a href="{{ route('krs.edit', $krs) }}" class="btn btn-outline-warning"
            title="Ubah" aria-label="Ubah {{ $krs->nama }}">
            <i class="bi bi-pencil-square"></i>
        </a>
        <button type="button" class="btn btn-outline-danger btn-hapus"
            data-url="{{ route('krs.destroy', $krs, false) }}"
            data-nama="{{ $krs->nama }}" title="Hapus"
            aria-label="Hapus {{ $krs->nama }}">
            <i class="bi bi-trash"></i>
        </button>
    @endif
</div>
