<div class="card-body">
    <div class="form-group">
        <label for="kode_prodi">Kode Prodi</label>
        <input type="text" name="kode_prodi" id="kode_prodi" class="form-control @error('kode_prodi') is-invalid @enderror"
               value="{{ old('kode_prodi', $prodi->kode_prodi ?? '') }}">
        @error('kode_prodi') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="nama_prodi">Nama Prodi</label>
        <input type="text" name="nama_prodi" id="nama_prodi" class="form-control @error('nama_prodi') is-invalid @enderror"
               value="{{ old('nama_prodi', $prodi->nama_prodi ?? '') }}">
        @error('nama_prodi') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
    <a href="{{ route('prodi.index') }}" class="btn btn-secondary">Batal</a>
</div>
