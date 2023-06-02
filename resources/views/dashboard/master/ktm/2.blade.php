<!DOCTYPE html>
<html>
<head>

    <title>Planics solution</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <style>
        *{
            box-sizing: border-box;
        
        }
        .container{
            position: absolute;
            left: 25%;
            top:20%;
        }
        .card{
            height: 3.375in;
            width: 2.275in;
            padding: 1.3rem 0 1.3rem 0;
            box-shadow: 0 0 5px #b4b4b4;
            background-image: url("data:image/png;base64,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");
            /* background-image:url('../images/ecardbgfinal.png'); */
            background-repeat: no-repeat;
            background-size: 218.4px 324px;
            border-radius: 20px;
        }
        .companyname{
            position: absolute;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 1.09rem;
            margin-top: .5rem;
            top: 4.3%;
            left: 3%;
            color: oldlace;
        }
        .company-img{
            position: absolute;
            top: 15%;
            left: 29%;
            max-width: 85px;
        }
        .profile-img{
            position: absolute;
            top: 40%;
            left: 28%;
            width: 96px;
            height: 96px;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, .2);
        }
        .profile-name{
            position: absolute;
            top: 250px;
            text-transform:capitalize;
            font-size: 15px;
            text-emphasis: spacing;
            margin-left: 5px;
            color: darkblue;
        }
        .profile-username{
            position: absolute;
            top: 270px;
            text-transform:capitalize;
            font-size: 15px;
            text-emphasis: spacing;
            margin-left: 5px;
            color: navy;
        }
        .squre-qr{
            position: absolute;
            align-items: center;
            top: 20%;
            left: 30%;
            height: 80px;
            width: 80px;
            box-shadow: 0 0 100px #b4b4b4;
        }
        .dt{
            top: 50%;
            position: absolute;
            font-weight: 400;
            font-size: 1.0rem;
            margin-top: .5rem;
            color: darkblue;
            left: 4%;
        }
        .dt1{
            top: 60%;
            position: absolute;
            font-weight: 400;
            font-size: 1.0rem;
            margin-top: .5rem;
            color: darkblue;
            left: 4%;
        }
        .dt2{
            top: 69%;
            position: absolute;
            font-weight: 400;
            font-size: 1.0rem;
            margin-top: .5rem;
            color: darkblue;
            left: 4%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="text-xenter">
                        <div class="pp">
                            <h4 class="companyname">Aticutmeutia</h4>
                            <img class="company-img" src={{ asset('assets/images/6.png') }} alt="" >
                            <img class="profile-img"  src={{ Storage::url($data['foto']) }} alt="">
                        </div>
                        <div class="names">
                            <h2 class="profile-name">{{ $data['nama'] }}</h2>
                            <h4 class="profile-username">{{ $data['prodi'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="pp">
                        <h4 class="companyname">Aticutmeutia</h4>
                        {{-- <img class="squre-qr" src="qr sample.png" alt=""> --}}
                    </div>
                    <div class="details">
                        <h4 class="dt"><b>Nama :</b> {{ $data['nama'] }}</h4>
                        <h4 class="dt1"><b>Nim :</b> {{ $data['nim'] }}</h4>
                        <h4 class="dt2"><b>Prodi :</b>{{ $data['prodi'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>