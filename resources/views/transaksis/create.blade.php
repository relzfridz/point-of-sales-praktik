@extends('transaksis.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data transaksi</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('transaksis.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('transaksis.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Barang:</strong>
                    <select name="nama_barang" id="" class="form-control">
                        <option value="">Pilih Barang</option>
                        @foreach ($barang as $id)
                            <option value="{{ $id->nama_barang }}">{{ $id->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Harga Barang:</strong>
                    <select name="harga_barang" id="" class="form-control">
                        <option value="">Harga Barang</option>
                        @foreach ($barang as $id)
                            <option value="{{ $id->harga_barang }}">{{ $id->harga_barang }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Total Barang:</strong>
                    <input type="text" name="total_barang" id="total_barang" class="form-control" placeholder="Total_barang">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Total Harga:</strong>
                    <input type="text" name="total_harga" id="total_harga"  class="form-control"
                    placeholder="Total Harga">
                </div>
            <!--<div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Total Harga:</strong>
                        <input type="integer" name="total_harga" class="form-control" placeholder="Total Harga">
                    </div>
                </div>-->

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Total Bayar:</strong>
                    <input type="integer" name="total_bayar" class="form-control" placeholder="Total_bayar">
                </div>
            </div>
            <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Kembalian:</strong>
                                <input type="integer" name="kembalian" class="form-control" placeholder="Kembalian">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Tanggal Beli:</strong>
                                <input type="date" name="tanggal_beli" class="form-control" placeholder="Tanggal Beli">
                            </div>
                        </div>-->
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Oke</button>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function(){
            $('#harga_barang').on('change', function () {
                var harga = this.value;
                $('#total_barang').keyup(function () {
                    var jumlah = this.value;
                    var total = parseInt(jumlah) * parseInt(harga);
                    $('#total_harga').val(total);
                })
            })
        });
    </script>
@endsection
