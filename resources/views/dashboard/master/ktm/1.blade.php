<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ktm.css') }}"> --}}
    <link rel="stylesheet" href="{{ public_path() . 'assets/ktm.css' }}">
    <title>ID Card</title>
   
</head>
<body>
    <div>
        
        <div class="container">
            
            <div class="padding"> 
            <div class="font">
            <img src={{ asset('assets/images/6.png') }} alt="" style="margin-top: 1rem;  width: 35%;">
                <div class="companyname" style="font-weight: bold;">Aticutmeutia<br><span class="tab"></span></div>
                <div class="top" >
                    <img src={{ Storage::url($data['foto']) }} alt="" style="margin-top: 4rem">
                </div>
                <div class="">
                    <div class="ename" style="margin-top: 4rem">
                    <p class="p1" style="color: black"><b>{{ $data['nama'] }}</b></p>
                    <p style="color: black; ">{{ $data['prodi'] }}</p>
                    </div>
                    <div class="edetails" style="margin-top: 4rem">
                        <P><b>Nama  :</b> {{ $data['nama'] }}</P>
                        <p style=""><b>Nim   <a style="margin-left: 8px;">:</a></b> {{ $data['nim'] }}</p>
                        <p style=""><b>Prodi  :</b> {{ $data['prodi'] }}</p>
                        
                    </div>
    
                    <div class="signature">
                    </div>
    
                    <div class="barcode">
                    </div>
                    <div class="qr">
                    </div>
    
              
                </div>
            </div>
        </div>
           
        </div>
    
        <div class="container1" style="margin-top: 1px">
            <div class="padding">
                <div class="font">
                    <div class="companyname" style="display: flex; justify-content: center;">Tata Tertib<br><span class="tab"></span></div>
                    <div class="top">
                    </div>
                    <div style="margin: 10px;">
                        <p style="font-family: 'Courier New', Courier, monospace; font-size: 15px; font-style: oblique; font-weight: bold;">1.Jika hilang harap kembalikan ke pemilik yang tertera.</p>
                        <p style="font-family: 'Courier New', Courier, monospace; font-size: 15px; font-style: oblique; font-weight: bold; margin-top: 8px;">2.Kehilangan kartu bukan tanggung jawab Kampus.</p>
                        <p style="font-family: 'Courier New', Courier, monospace; font-size: 15px; font-style: oblique; font-weight: bold; margin-top: 8px;">3.Segera lapor jika kehilangan kartu.</p>
                        <p style="font-family: 'Courier New', Courier, monospace; font-size: 15px; font-style: oblique; font-weight: bold; margin-top: 8px;">4.Kartu ini sebagai tanda sah Mahasiswa.</p>
                    </div>
                    <div class="">
                        <div class="ename">
                        </div>
                        <div class="edetails">
                        </div>
        
                        <div class="signature">
                        </div>
                        <div class="barcode">
                        </div>
                        <div class="qr">
                        </div>
        
                  
                    </div>
                </div>
            </div>
               
           
        </div>
    </div>
    

</body>
</html>
