<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
          User-Dashboard
        </title>
        
 <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

        <!-- Google Font: Source Sans Pro -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
        />
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css"
        />
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css" />
        <!-- jQuery -->
        <script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
        {{-- Toastr --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />







    </head>

    
    <body class="hold-transition sidebar-mini ">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <nav
                class="main-header navbar navbar-expand navbar-white navbar-light "
            >
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            data-widget="pushmenu"
                            href="#"
                            role="button"
                            ><i class="fas fa-bars"></i
                        ></a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">
                <!-- Brand Logo -->
                <a href="{{ route('user.dashboard') }}" class="brand-link">
                    <img
                        src="{{ asset('/') }}dist/img/Picture1.png"
                        alt="REST API"
                        class="brand-image img-circle"
                        style="opacity: 1;"
                    />
                    <span class="brand-text font-weight-light">REST API</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul
                            class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false"
                        >
                            <li class="nav-item">
                                <a
                                    href="{{ route('user.dashboard')  }}"
                                    class="nav-link"
                                >
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>Beranda</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a
                                    href="{{ route('user.todolist') }}"
                                    class="nav-link"
                                >
                                
                                    <i class="nav-icon fa fa-list-alt"></i>
                                    <p>To Do List</p>
                                </a>
                            </li>

                             
                    <!-- /.sidebar-menu -->

                    <!-- User Panel at the bottom -->
                    <div
                        class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center justify-content-start"
                    >
                         

                        <div class="info">
                            {{-- batasi 10 char --}}
                            <a
                                class="d-block"
                                >{{strlen($student->studentName) > 10 ? substr($student->studentName, 0, 10) . '...' : $student->studentName  }}</a
                            >
                        </div>

                        <div class="info ml-auto">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper px-4 py-2">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        {{-- Judul --}}
                    </div>
                </section>

                <!-- Main content -->
                <section class="content">
                <div class="card mt-5 mb-4">
            <div class="card-body">
                <h1 class="text-center mb-4">To Do List</h1>

                 <!-- Form untuk menambahkan tugas baru -->
<form action="{{ route('user.store') }}" method="POST" class="form-inline">
    @csrf
    <div class="form-group mb-2">
        <input type="text" class="form-control mr-2" name="task" placeholder="Masukkan teks di sini" required>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Tambah</button>
</form>

    

 
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">To Do List</th>
                             
                          
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                         @php $nomor=1; @endphp 
                         @foreach ($todo as $row)

                <tr>
                    <th scope="row">{{ $nomor++ }}</th>
                     @if (!$row->completed)
            <td>{{ $row->todo }}</td>
        @else
            <td style="text-decoration: line-through;">{{ $row->todo }}</td>
        @endif
                     <td class="text-center">
              
                        
                       

                        
                       @if (!$row->is_completed)
            <form action="{{ route('user.tasks.complete', $row) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-warning selesai-btn">Selesai</button>
            </form>
        @else
            <!-- Tombol yang tidak bisa diklik jika sudah selesai -->
            <button type="button" class="btn btn-secondary" disabled>Selesai</button>
        @endif
                       

                        <form action="{{ route('user.tasks.destroy', $row) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger selesai-btn">Hapus</button>
                    </form>
                     
                        </td>
 

                </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    {{-- <b>Version</b> 3.2.0 --}}
                </div>
                
            </footer>
        </div>
        <!-- ./wrapper -->

        
        <!-- Bootstrap 4 -->
        <script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->

        <!-- DataTables  & Plugins -->
<script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('/') }}plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('/') }}plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
 
<!-- Page specific script -->



<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print", "colvis"],
       
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

 

</body>
</html>
