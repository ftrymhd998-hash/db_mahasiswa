<div class="card-body">
    <div class="form-group">
        <label for="kode_mk">Kode MK</label>
        <input type="text" name="kode_mk" id="kode_mk" class="form-control @error('kode_mk') is-invalid @enderror"
               value="{{ old('kode_mk', $mataKuliah->kode_mk ?? '') }}">
        @error('kode_mk') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="nama_mk">Nama Mata Kuliah</label>
        <input type="text" name="nama_mk" id="nama_mk" class="form-control @error('nama_mk') is-invalid @enderror"
               value="{{ old('nama_mk', $mataKuliah->nama_mk ?? '') }}">
        @error('nama_mk') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="sks">SKS</label>
        <input type="number" name="sks" id="sks" min="1" max="6" class="form-control @error('sks') is-invalid @enderror"
               value="{{ old('sks', $mataKuliah->sks ?? '') }}">
        @error('sks') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
    <a href="{{ route('mata-kuliah.index') }}" class="btn btn-secondary">Batal</a>
</div>
