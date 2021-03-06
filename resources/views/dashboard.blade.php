@extends('layouts.template')
@section('content')
    <div class="row mt-4">
        <div class="col">
            <div class="alert alert-primary font-weight-bold">Selamat Datang Di Aplikasi Analisa Kredit</div>
        </div>
    </div>
    {{-- @if (auth()->user()->level == 'Administrator' || auth()->user()->level == 'Admin' || auth()->user()->level == 'Kasat') --}}
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card bg-rgb-primary border border-primary">
                <div class="card-body py-4">
                    <span class="fa fa-calendar-check sticky-fa-card"></span>
                    <div class="row align-items-center">
                        <div class="col-md-8 pr-0 font-weight-bold">
                            Pengajuan Telah Ditinjak Lanjuti
                        </div>
                        <div class="col-md-4 pr-0 text-center">
                            <h1>{{ \App\Models\PengajuanModel::where('posisi', 'Selesai')->count() }}</h1>
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('pengajuan-kredit.index') }}" class="btn btn-primary-detail btn-sm b-radius-3 px-3">Lihat
                        Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-rgb-danger border border-danger">
                <div class="card-body py-4">
                    <i class="fa fa-ban sticky-fa-card"></i>
                    <div class="row font-weight-bold">
                        <div class="col-md-8 pr-0">
                            Pengajuan Belum Ditindak Lanjuti
                        </div>
                        <div class="col-md-4 pl-0 text-center">
                            <h1>{{ \App\Models\PengajuanModel::where('posisi', 'Review Penyelia')->OrWhere('posisi','Proses Input Data')->count() }}</h1>
                            {{-- <h1>{{ \App\Models\Penugasan::where('status', 'Batal')->count() }}</h1> --}}
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('pengajuan-kredit.index') }}" class="btn btn-danger btn-sm b-radius-3 px-3">Lihat
                        Detail</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <h5 class="color-darkBlue font-weight-bold">Pengajuan Belum Ditindak Lanjuti</h5>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover table-custom">
                    <thead>
                        <tr class="table-primary">
                            <th>#</th>
                            <th>Nama Lengkap</th>
                            <th>Sektor Kredit</th>
                            <th>Jenis Usaha</th>
                            <th>Jumlah Kredit yang diminta</th>
                            <th>Tanggal Pengajuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jenis_usaha }}</td>
                                <td>{{ $item->sektor_kredit }}</td>
                                <td>Rp.{{ number_format($item->jumlah_kredit, 2, '.', ',') }}</td>
                                <td>{{ date('d-m-Y',strtotime( $item->tanggal ) ) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center" style="background: rgba(71, 145,254,0.05) !important">Data Kosong</td>
                            </tr>

                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    {{-- @endif --}}
    {{-- <div class="row">
        <div class="col-md-6">
            <h5 class="font-weight-bold color-darkBlue">Kegiatan Penugasan Hari Ini</h5>
        </div>
        <div class="col-md-6 text-right">
            <a href="#">Lihat Semua Analisis</a>
        </div>
    </div>
    <hr class="mt-2"> --}}
@endsection
