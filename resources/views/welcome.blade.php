<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        td,
        th {
            font-size: 11px;
        }

    </style>


    <title>TES - Venturo Camp Tahap 2</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card" style="margin: 2rem 0rem;">
            <div class="card-header">
                Venturo - Laporan penjualan tahunan per menu -- Aftiyan
            </div>
            <div class="card-body">
                <form action="{{ route('menu.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <select id="my-select" class="form-control" name="tahun">
                                    <option value="" {{ isset($tahun)? '' : 'selected' }}>Pilih Tahun</option>
                                    <option value="2021" @isset($tahun){{ $tahun == 2021? 'selected' : '' }}@endisset>2021</option>
                                    <option value="2022" @isset($tahun){{ $tahun == 2022? 'selected' : '' }}@endisset>2022</option>
                                </select>   
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">
                                Tampilkan
                            </button>
                        </div>
                    </div>
                </form>
                <hr>
                @isset($data)

                <div class="table-responsive">
                    <table class="table table-hover table-bordered" style="margin: 0;">
                        <thead>
                            <tr class="table-dark">
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">Menu</th>
                                <th colspan="12" style="text-align: center;">Periode Pada {{ $tahun }}
                                </th>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total</th>
                            </tr>
                            <tr class="table-dark">
                                <th style="text-align: center;width: 75px;">Jan</th>
                                <th style="text-align: center;width: 75px;">Feb</th>
                                <th style="text-align: center;width: 75px;">Mar</th>
                                <th style="text-align: center;width: 75px;">Apr</th>
                                <th style="text-align: center;width: 75px;">Mei</th>
                                <th style="text-align: center;width: 75px;">Jun</th>
                                <th style="text-align: center;width: 75px;">Jul</th>
                                <th style="text-align: center;width: 75px;">Ags</th>
                                <th style="text-align: center;width: 75px;">Sep</th>
                                <th style="text-align: center;width: 75px;">Okt</th>
                                <th style="text-align: center;width: 75px;">Nov</th>
                                <th style="text-align: center;width: 75px;">Des</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                            </tr>
                            @foreach($data as $d)
                            @if($d->kategori == 'makanan')
                            <tr>
                                <td>{{ $d->menu }}</td>      
                                    @for($i = 1; $i <= 12; $i++)
                                        <td class="text-end">{{ $result[$d->menu][$i] == 0? '': $result[$d->menu][$i] }}</td>                                        
                                    @endfor                           
                                <td class="fw-bold text-end">{{ $totalmenu[$d->menu] }}</td>
                            </tr>
                            @endif
                            @endforeach
                            <tr class="table-primary    ">
                                <td><b>Total penjualan makanan</b></td>
                                @for ($i = 1; $i <= 12; $i++)
                                <td class="text-end fw-bold">{{ $makan[$i] }}</td>
                                @endfor
                                <td class="text-end fw-bold">{{ $tm }}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                            </tr>
                            @foreach($data as $d)
                            <tr>
                                @if($d->kategori == 'minuman')
                                <td>{{ $d->menu }}</td>
                                    @for($i = 1; $i <= 12; $i++)
                                        <td class="text-end">{{ $result[$d->menu][$i] == 0? '': $result[$d->menu][$i] }}</td>                                        
                                    @endfor                                
                                    <td class="fw-bold text-end">{{ $totalmenu[$d->menu] }}</td>
                                @endif
                            </tr>
                            @endforeach
                            <tr class="table-primary">
                                <td><b>Total penjualan minuman</b></td>
                                @for ($i = 1; $i <= 12; $i++)
                                <td class="text-end fw-bold">{{ $minum[$i] }}</td>
                                @endfor
                                <td class="text-end fw-bold">{{ $tmn }}</td>
                            </tr>
                            <tr class="table-dark">
                                <td><b>Total</b></td>
                                @for ($i = 1; $i <= 12; $i++)
                                <td class="text-end fw-bold">{{ $hasil[$i] }}</td>
                                @endfor
                                <td class="text-end fw-bold">{{ $tt }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endisset
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>
