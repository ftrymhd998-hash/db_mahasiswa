@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner"><h3>{{ $jumlah['mahasiswa'] }}</h3><p>Mahasiswa</p></div>
            <div class="icon"><i class="fas fa-users"></i></div>
            <a href="{{ route('mahasiswa.index') }}" class="small-box-footer">Lihat data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner"><h3>{{ $jumlah['prodi'] }}</h3><p>Prodi</p></div>
            <div class="icon"><i class="fas fa-university"></i></div>
            <a href="{{ route('prodi.index') }}" class="small-box-footer">Lihat data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner"><h3>{{ $jumlah['mataKuliah'] }}</h3><p>Mata Kuliah</p></div>
            <div class="icon"><i class="fas fa-book"></i></div>
            <a href="{{ route('mata-kuliah.index') }}" class="small-box-footer">Lihat data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner"><h3>{{ $jumlah['krs'] }}</h3><p>Data KRS</p></div>
            <div class="icon"><i class="fas fa-clipboard-list"></i></div>
            <a href="{{ route('krs.index') }}" class="small-box-footer">Lihat data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Mahasiswa per Prodi</h3></div>
            <div class="card-body">
                @if (array_sum($chart['prodi']['data']) > 0)
                    <div style="height:260px"><canvas id="chartProdi"></canvas></div>
                @else
                    <p class="text-muted mb-0">Belum ada data mahasiswa.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Jumlah Mahasiswa per Prodi (tabel)</h3></div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead><tr><th>Prodi</th><th style="width:150px">Jumlah Mahasiswa</th></tr></thead>
                    <tbody>
                        @foreach ($perProdi as $p)
                            <tr><td>{{ $p->kode_prodi }} - {{ $p->nama_prodi }}</td><td>{{ $p->mahasiswa_count }}</td></tr>
                        @endforeach
                        <tr class="text-muted"><td>Belum memilih prodi</td><td>{{ $tanpaProdi }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Distribusi Nilai KRS</h3></div>
            <div class="card-body">
                @if (array_sum($chart['nilai']['data']) > 0)
                    <div style="height:260px"><canvas id="chartNilai"></canvas></div>
                @else
                    <p class="text-muted mb-0">Belum ada data KRS.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Peminat per Mata Kuliah (maks. 10)</h3></div>
            <div class="card-body">
                @if (array_sum($chart['mk']['data']) > 0)
                    <div style="height:260px"><canvas id="chartMk"></canvas></div>
                @else
                    <p class="text-muted mb-0">Belum ada data KRS.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    const chart = @json($chart);
    const warna = ['#17a2b8', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#fd7e14', '#20c997', '#6c757d', '#007bff', '#e83e8c'];
    const opsiBar = (horizontal) => ({
        indexAxis: horizontal ? 'y' : 'x',
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: { [horizontal ? 'x' : 'y']: { beginAtZero: true, ticks: { precision: 0 } } }
    });

    const cProdi = document.getElementById('chartProdi');
    if (cProdi) {
        new Chart(cProdi, {
            type: 'doughnut',
            data: { labels: chart.prodi.labels, datasets: [{ data: chart.prodi.data, backgroundColor: warna }] },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'right' } } }
        });
    }

    const cNilai = document.getElementById('chartNilai');
    if (cNilai) {
        new Chart(cNilai, {
            type: 'bar',
            data: { labels: chart.nilai.labels, datasets: [{ label: 'Jumlah', data: chart.nilai.data,
                    backgroundColor: ['#28a745', '#17a2b8', '#ffc107', '#fd7e14', '#dc3545', '#adb5bd'] }] },
            options: opsiBar(false)
        });
    }

    const cMk = document.getElementById('chartMk');
    if (cMk) {
        new Chart(cMk, {
            type: 'bar',
            data: { labels: chart.mk.labels, datasets: [{ label: 'Jumlah mahasiswa', data: chart.mk.data, backgroundColor: '#007bff' }] },
            options: opsiBar(true)
        });
    }
</script>
@endpush
