@include('template.header')

@include('template.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>EMPLOYEES</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">LIST EMPLOYEE</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="{{ route('employees.create') }}" class="btn btn-md btn-success mb-3"><i class="fas fa-plus"></i> TAMBAH EMPLOYEE</a>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th scope="col">NO</th>
                        <th scope="col">ENTRY DATE</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">RANK</th>
                        <th scope="col">GENDER</th>
                        <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value->entry_date }}</td>
                            <td>{!! $value->nama !!}</td>
                            <td>{{ $value->rank }}</td>
                            <td>{{ $value->gender }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('employees.destroy', $value->id) }}" method="POST">
                                    <a href="{{ route('employees.edit', $value->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> HAPUS</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Employee belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  
<script>
  $(function () {
    //message with toastr
    @if(session()->has('success'))
        
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
  });
</script>

@include('template.footer')
