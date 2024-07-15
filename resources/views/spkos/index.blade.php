@include('template.header')

@include('template.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Surat Perintah Kerja Operator (SPKO)</h1>
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
                <h3 class="card-title">LIST SPKO</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="{{ route('spkos.create') }}" class="btn btn-md btn-success mb-3"><i class="fas fa-plus"></i> TAMBAH SPKO</a>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th scope="col">NO SPKO</th>
                        <th scope="col">OPERATOR</th>
                        <th scope="col">TRANS DATE</th>
                        <th scope="col">PROCESS</th>
                        <th scope="col">SW</th>
                        <th scope="col">REMARKS</th>
                        <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($spkos as $key => $value)
                        <tr>
                            <td>{{ $value->no_spko }}</td>
                            <td>{{ $value->operator }}</td>
                            <td>{{ $value->trans_date }}</td>
                            <td>{{ $value->process }}</td>
                            <td>{{ $value->sw }}</td>
                            <td>{{ $value->remarks }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('spkos.destroy', $value->id) }}" method="POST">
                                    <a href="{{ route('spkos.edit', $value->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> HAPUS</button>
                                    <a href="{{ route('spkos.print_out', $value->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-print"></i> PRINT</a>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Surat Perintah Kerja Operator belum Tersedia.
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
    @if(session()->has('success'))
        
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
  });
</script>

@include('template.footer')
