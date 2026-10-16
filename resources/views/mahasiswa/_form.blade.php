<div class="card-body">
    <div class="form-group">
        <label for="prodi_id">Prodi</label>
        <select name="prodi_id" id="prodi_id" class="form-control @error('prodi_id') is-invalid @enderror">
            <option value="">-- Pilih Prodi --</option>
            @foreach ($prodi as $p)
                <option value="{{ $p->id }}" {{ old('prodi_id', $mahasiswa->prodi_id ?? '') == $p->id ? 'selected' : '' }}>{{ $p->kode_prodi }} - {{ $p->nama_prodi }}</option>
            @endforeach
        </select>
        @error('prodi_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="npm">NPM</label>
        <input type="text" name="npm" id="npm" class="form-control @error('npm') is-invalid @enderror"
               value="{{ old('npm', $mahasiswa->npm ?? '') }}">
        @error('npm') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="nama_lengkap">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror"
               value="{{ old('nama_lengkap', $mahasiswa->nama_lengkap ?? '') }}">
        @error('nama_lengkap') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $mahasiswa->alamat ?? '') }}</textarea>
        @error('alamat') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $mahasiswa->email ?? '') }}">
        @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="telpon">Telpon</label>
        <input type="text" name="telpon" id="telpon" class="form-control @error('telpon') is-invalid @enderror"
               value="{{ old('telpon', $mahasiswa->telpon ?? '') }}">
        @error('telpon') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
</div>
