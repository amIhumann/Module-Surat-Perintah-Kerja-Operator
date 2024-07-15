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
                <h3 class="card-title">CREATE PRODUCT</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        
                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold">SUB CATEGORY</label>
                        <input type="text" class="form-control @error('sub_category') is-invalid @enderror" name="sub_category" value="{{ old('sub_category') }}" placeholder="Masukkan Sub Category">
                    
                        <!-- error message untuk sub_category -->
                        @error('sub_category')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">SERIAL NO</label>
                        <input type="number" class="form-control @error('serial_no') is-invalid @enderror" name="serial_no" value="{{ old('serial_no') }}" placeholder="Masukkan Serial No">
                    
                        <!-- error message untuk serial_no -->
                        @error('serial_no')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">DESCRIPTION</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Masukkan Description">{{ old('description') }}</textarea>
                    
                        <!-- error message untuk description -->
                        @error('description')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">CARAT</label>
                        <input type="text" class="form-control @error('carat') is-invalid @enderror" name="carat" value="{{ old('carat') }}" placeholder="Masukkan Carat">
                    
                        <!-- error message untuk carat -->
                        @error('carat')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                    <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    <a href="{{ route('products.index') }}" class="btn btn-md btn-danger">KEMBALI</a>

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