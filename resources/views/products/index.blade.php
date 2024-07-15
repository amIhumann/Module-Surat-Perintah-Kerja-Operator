@include('template.header')

@include('template.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PRODUCTS</h1>
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
                <h3 class="card-title">LIST PRODUCT</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="{{ route('products.create') }}" class="btn btn-md btn-success mb-3"><i class="fas fa-plus"></i> TAMBAH PRODUCT</a>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th scope="col">NO</th>
                        <th scope="col">SUB CATEGORY</th>
                        <th scope="col">SERIAL NO</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">CARAT</th>
                        <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value->sub_category }}</td>
                            <td>{{ $value->serial_no }}</td>
                            <td>{!! $value->description !!}</td>
                            <td>{{ $value->carat }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('products.destroy', $value->id) }}" method="POST">
                                    <a href="{{ route('products.edit', $value->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> HAPUS</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Product belum Tersedia.
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
