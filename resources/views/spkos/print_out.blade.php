<!DOCTYPE html>
<html>
<head>
	<title>Surat Perintah Kerja Operator (SPKO)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
    <div class="card mb-3" style="background: #d4f7f7">
        <div class="card-body">
            <h5><b>Surat Perintah Kerja Operator</b></h5>
            
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>ID Operator</td>
                    <td> : </td>
                    <td>{{ $spko->id_operator }}</td>
                    <td>No. SPKO</td>
                    <td> : </td>
                    <td>{{ $spko->no_spko }}</td>
                </tr>
                <tr>
                    <td>Nama Operator</td>
                    <td> : </td>
                    <td>{{ $spko->operator }}</td>
                    <td>Proses</td>
                    <td> : </td>
                    <td>{{ $spko->process }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td> : </td>
                    <td>{{ $spko->trans_date }}</td>
                    <td>Catatan</td>
                    <td> : </td>
                    <td>{{ $spko->remarks }}</td>
                </tr>
            </table>
        </div>
    </div>
    
 
	<table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">No.</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Carat</th>
            <th scope="col">SKU</th>
            <th scope="col">Qty</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($spko_items as $key => $value)
        <tr>
            <td>{{ ($key + 1) }}</td>
            <td>{{ $value->description }}</td>
            <td>{{ $value->carat }}</td>
            <td>{{ $value->sku }}</td>
            <td>{{ $value->qty }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>  
 
</body>
</html>