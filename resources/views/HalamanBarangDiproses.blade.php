@extends('template')

@section('content')
<div class="content">
    <form action="/cariBarangDiproses" method="GET" style="width: 500px">
        <div class="input-group no-border">
            <input type="text" name="search" class="form-control" placeholder="Cari data barang diproses...">
            <div class="input-group-append">
                <button type="submit" class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                </button>
            </div>
        </div>  
    </form>

    <div class="table-responsive">
        <a href="/inputBarangDiproses" type="button" class="btn btn-success">Input Data</a>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Diproses</th>
                    <th>Tanggal Diproses</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($barangDiproses as $x)
                <tbody>
                   <tr>
                        <td class="py-1">
                            {{$x->id_proses}}
                        </td>
                        <td>
                            {{$x->nama_barang}}
                        </td>
                        <td>
                            {{$x->jumlah_diproses}}
                        </td> 
                        <td>              
                            {{$x->tanggal_proses}}
                        </td>
                        <td>
                            {{$x->status}}
                        </td>
                        <td>
                            <a href="/ubahBarangDiproses/{{ $x->id_proses }}" type="button" class="btn btn-primary">Edit</a>
                            <a href="/hapusBarangDiproses/{{ $x->id_proses }}" type="button" class="btn btn-danger">Hapus</a>
                        </td>
                   </tr> 
                </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection
