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
                <h3 class="card-title">EDIT EMPLOYEE</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="font-weight-bold">NAMA</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $employee->nama) }}" placeholder="Masukkan Nama Employee">
                    
                        <!-- error message untuk nama -->
                        @error('nama')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">RANK</label>
                        <input type="text" class="form-control @error('rank') is-invalid @enderror" name="rank" value="{{ old('rank', $employee->rank) }}" placeholder="Masukkan rank Employee">
                    
                        <!-- error message untuk rank -->
                        @error('rank')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">GENDER</label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                            <option {{ old('gender', $employee->gender) == "L" ? "selected" : "" }} value="L">Laki - laki</option>
                            <option {{ old('gender', $employee->gender) == "P" ? "selected" : "" }} value="P">Perempuan</option>
                        </select>

                        <!-- error message untuk gender -->
                        @error('gender')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                    <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-md btn-danger">KEMBALI</a>

                </form> 
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


@include('template.footer')