<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Data Mahasiswa') | AdminLTE</title>

    <!-- Font Awesome, AdminLTE 3 (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/dashboard" class="brand-link">
            <i class="fas fa-user-graduate brand-image pl-3" style="font-size:1.6rem;opacity:.8"></i>
            <span class="brand-text font-weight-light">Admin Mahasiswa</span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('mahasiswa.index') }}" class="nav-link {{ request()->is('mahasiswa*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i><p>Mahasiswa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('prodi.index') }}" class="nav-link {{ request()->is('prodi*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-university"></i><p>Prodi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('mata-kuliah.index') }}" class="nav-link {{ request()->is('mata-kuliah*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i><p>Mata Kuliah</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('krs.index') }}" class="nav-link {{ request()->is('krs*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clipboard-list"></i><p>KRS</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/about" class="nav-link {{ request()->is('about') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-info-circle"></i><p>About</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/logout" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1>@yield('title', 'Data Mahasiswa')</h1>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </section>
    </div>

    <footer class="main-footer">
        <strong>Muhammad Fitri</strong> &mdash; NPM 2410010204
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function () {
        // Pencarian, urutan, dan pagination otomatis untuk semua tabel ber-class "datatable"
        $('.datatable').DataTable({
            pageLength: 10,
            columnDefs: [{ orderable: false, targets: -1 }],
            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                infoEmpty: 'Tidak ada data',
                infoFiltered: '(disaring dari _MAX_ data)',
                zeroRecords: 'Data tidak ditemukan',
                emptyTable: 'Belum ada data',
                paginate: { first: 'Awal', last: 'Akhir', next: 'Berikutnya', previous: 'Sebelumnya' }
            }
        });
    });
</script>
@stack('scripts')
</body>
</html>
