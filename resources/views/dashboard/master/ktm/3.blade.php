<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/idCard.css') }}">
    <title>ID Card</title>
<!--     
    So lets start -->
</head>
<body>
        <div class="container">
            <div class="padding">
                <div class="font">
                    <div class="top">
                        <img src={{ Storage::url($data['foto']) }} alt="">
                    </div>
                    <div class="bottom">
                        <p>{{ $data['nama'] }}</p>
                        <p class="desi">{{ $data['prodi'] }}</p>
                        <div class="barcode">
                            <img src={{ asset('assets/images/6.png') }} alt="">
                        </div>
                        <br>
                        <p class="no">{{ $data['nama'] }}</p>
                        <p class="no">{{ $data['prodi'] }}</p>
                    </div>
                </div>
            </div>
            <div class="back" style="margin-top: -19rem;">
                <h1 class="Details">information</h1>
                <hr class="hr">
                <div class="details-info">
                    <p><b>Nama : </b></p>
                    <p>{{ $data['nama'] }}</p>
                    <p><b>Nim: </b></p>
                    <p>{{ $data['nim'] }}</p>
                    <p><b>Prodi:</b></p>
                    <p>{{ $data['prodi'] }}</p>
                    </div>
                    <div class="logo">
                        {{-- <img src="barcode.PNG"> --}}
                    </div>

                    
                    <hr>
                </div>
            </div>
        </div>
</body>
</html>