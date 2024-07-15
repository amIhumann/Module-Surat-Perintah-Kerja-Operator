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
                <h3 class="card-title">EDIT SPKO</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('spkos.update', $spko->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="font-weight-bold">Operator</label>
                        <select class="form-control @error('employee') is-invalid @enderror" name="employee">
                            @foreach ($employees as $key => $value) 
                                <option {{ old('employee', $spko->employee) == $value->id ? "selected" : "" }} value="{{ $value->id }}">{{ $value->nama }}</option>
                            @endforeach
                        </select>

                        <!-- error message untuk employee -->
                        @error('employee')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">TRANS DATE</label>
                        <input type="date" class="form-control @error('trans_date') is-invalid @enderror" name="trans_date" value="{{ old('trans_date', $spko->trans_date) }}" placeholder="Masukkan Serial No">
                    
                        <!-- error message untuk trans_date -->
                        @error('trans_date')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="card border-0 shadow rounded form-group">
                        <div class="card-body">
                            <div class="action_button my-2 float-right">
                                <button class="btn btn-sm btn-success" id="add_item">Add</button>
                                <button class="btn btn-sm btn-danger" id="delete_item">Delete</button>
                            </div>
                            <table class="table table-bordered" id="table_items">
                                <thead>
                                    <tr>
                                        <th scope="col">PRODUCT</th>
                                        <th scope="col">QTY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($spko_items as $item)
                                        <tr>
                                            <td>
                                                <select class="form-control" name="product[]">
                                                    @foreach ($products as $key => $value) 
                                                        <option {{ old('product.' . $item->idm, $item->id_product) == $value->id ? "selected" : "" }} value="{{ $value->id }}">{{ $value->description }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="qty[]" value="{{ old('qty.' . $item->idm, $item->qty) }}" placeholder="Masukkan Quantity">
                                            </td>
                                        </tr>      
                                    @empty
                                        <tr>
                                            <td>
                                                <select class="form-control" name="product[]">
                                                    @foreach ($products as $key => $value) 
                                                        <option value="{{ $value->id }}">{{ $value->description }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="qty[]" placeholder="Masukkan Quantity">
                                            </td>
                                        </tr>       
                                    @endforelse
                                </tbody>
                            </table>  
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">PROCESS</label>
                        <select class="form-control @error('process') is-invalid @enderror" name="process">
                            <option {{ old('process', $spko->process) == "Cor" ? "selected" : "" }} value="Cor">Cor</option>
                            <option {{ old('process', $spko->process) == "Brush" ? "selected" : "" }} value="Brush">Brush</option>
                            <option {{ old('process', $spko->process) == "Bombing" ? "selected" : "" }} value="Bombing">Bombing</option>
                            <option {{ old('process', $spko->process) == "Slep" ? "selected" : "" }} value="Slep">Slep</option>
                        </select>

                        <!-- error message untuk process -->
                        @error('process')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="font-weight-bold">SW</label>
                        <input type="text" class="form-control @error('sw') is-invalid @enderror" name="sw" value="{{ old('sw', $spko->sw) }}" placeholder="Masukkan Serial No">
                    
                        <!-- error message untuk sw -->
                        @error('sw')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">REMARKS</label>
                        <textarea class="form-control @error('remarks') is-invalid @enderror" name="remarks" placeholder="Masukkan Catatan">{{ old('remarks', $spko->remarks) }}</textarea>
                    
                        <!-- error message untuk remarks -->
                        @error('remarks')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                    <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    <a href="{{ route('spkos.index') }}" class="btn btn-md btn-danger">KEMBALI</a>

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

  
<script>
  $(function () {
    $('#add_item').on('click', function(e) {
        e.preventDefault();

        let last_tr = $('#table_items tbody tr').last()[0].outerHTML;

        $('#table_items tbody').append(last_tr);
    });

    $('#delete_item').on('click', function(e) {
        e.preventDefault();

        if($('#table_items tbody tr').length <= 1) return false;

        $('#table_items tbody tr').last().remove();
    });
  });
</script>

@include('template.footer')