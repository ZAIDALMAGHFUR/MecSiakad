@extends('layouts.landing')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@section('content')


<!--home section start-->
<section class="section-py-space mt-0 pt-0" style="min-height: 100vh;">
    <div class="w-100 my-5"
        style="padding-top: 100px !important; background-image: url({{ asset('images/1.jpg') }}); background-position: center; background-size: cover; background-attachment: fixed;">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <h2 class="fw-bold h1">Sejarah Akademi Teknik Indonesia Cut Meutia </h2>
                    <hr style="width: 30px; height: 3px;" class="mx-auto mt-3 mb-5 d-block">
                </div>
            </div>
        </div>
    </div>

    <div style="display: flex; justify-content: center;">
        <img src="{{ asset('images/sejarah.png') }}" alt="">
    </div>
    <div class="mt-5 container">
        <p style="text-indent: 40px">Yayasan Cut Meutia didirikan berdasarkan akte notaris Hasan Gelar Soetan Paroehoem dengan nomor 54 tahun 1953, tanggal 16 September tahun 1953 dengan nama Yayasan Asrama Puteri Islam bertempat di Kutaradja. Yayasan ini merupakan salah satu yayasan tertua di Provinsi Nanggroe Aceh Darussalam (NAD). Berdasarkan akte notaris Mula Pangihutan Tamboenan dengan nomor 1 tahun 1962, tanggal 1 Desember 1962 (tambahan Berita Negara R.I nomor 22 tanggal 15 Maret 1963). Yayasan Asrama Puteri Islam berubah nama menjadi Yayasan Tjut Meutia dengan Ketua Yayasan adalah Tgk. Hj. Ainul Mardiah Ali.</p>

        <p style="text-indent: 40px">Sesuai dengan tujuan yayasan ini, yaitu unuk memajukan pendidikan yang berazakan Islam dan Pancasila, maka pada tahun 1963, Yayasan Cut Meutia membuka Sekolah Guru Taman Kanak Kanak (SGTK) Cut Meutia. Untuk kelancaran proses pendidikan SGTK, maka yayasan ini membangun dua unit gedung berlantai dua yang peresmiannya dilakukan oleh Ny. Hartini Soekarno pada tanggal 13 Maret 1963. Pada tahun 1968 Yayasan Cut Meutia mendirikan taman kanak-kanak disamping untuk memnuhi kebutuhan masyarakat terhadap lembaga pendidikan taman kanak kanak juga sebagai sekolah latihan bagi siswa SGTK. Selanjutnya pada tahun 1974 Yayasan Cut Meutia membuka Sekolah Pendidikan Guru (SPG) yang merupakan salah satu sekolah pendidikan guru yang paling populer di Aceh pada saat itu. Tujuan pembukaan SPG adalah sebagai upaya membantu pemerintah untuk memenuhi kebutuhan guru sekolah dasar. Kemudian secara berturut-turut pada tahun 1987 Yayasan Cut Meutia membuka SMP dan SMA Cut Meutia sebagai upaya membantu langsung dalam peningkatan SDM yang dimaksud sesuai dengan visi dan misi yayasan.</p>

        <p style="text-indent: 40px">            Pada sisi lain, menurunnya mutu pendidikan di Provinsi NAD dalam beberapa tahun terakhir ini sebagai dampak langsung dari situasi konflik telah menimbulkan keterbatasan penyediaan SDM yang terampil dan berkualitas dalam mengelola dan mengembangkan aset-aset pembangunan dalam berbagai bidang. Tahun 1989 Yayasan Cut Meutia mendirikan Perguruan Tinggi yang bernama Akademi Teknologi Industri Cut Meutia  dengan 2 (dua) Jurusan yaitu Jurusan/Program Studi Teknik dan Manajemen Industri,  dan Jurusan/Program Studi Teknik Kimia sesuai dengan SK Mendikbud RI Nomor 0838/O/D/1989 tanggal 16 Desember 1989. Sejak berdiri hingga saat ini telah meluluskan 18 angkatan dengan jumlah alumni 567 orang. </p>

        <p style="text-indent: 40px">Peristiwa Bencana Alam Tsunami (gelombang besar) pada akhir tahun 2004. Terjadi porak poranda dan kehilangan tenaga-tenaga yang terampil serta mahasiswa/i yang meninggal dunia. Hal ini cepat atau lambat akan menimbulkan permasalahan yang serius sehingga sesegera mungkin harus dilakukan langkah-langkah antisipasi yang tepat. Untuk mencari solusi terhadap permasalahan tersebut, maka pihak Pembina dan Ketua Yayasan Cut Meutia Banda Aceh pada tanggal 19 Mei 2010 mengadakan rapat (terlampir Surat Pernyataan, Surat Kuasa, Notulen Rapat Badan Pengurus Yayasan Cut Meutia Banda Aceh) dan disyahkan oleh Notaris Sabaruddin Salam, SH dengan Nomor 5054/SS/W/VI/Th.2010 tanggal 25 Juni 2010. </p>


        <p style="text-indent: 40px">Pihak Yayasan Cut Meutia Banda Aceh menyetujui Pengalihan Kepengurusan atau Kepemilikan Akademi Teknologi Industri Yayasan Cut Meutia di Banda Aceh  ke YAYASAN FADIRA ALAM MANDIRI yang berkedudukan di Medan.  Dan dalam hal ini Pihak Yayasan Fadira Alam Mandiri dan berupaya dengan manajemen yang baru untuk mengembangkan Akademi Teknologi Industri Cut Meutia agar dapat berkembang lebih maju lagi sebagaimana mestinya dan eksis didunia pendidikan tinggi dan disepakati memindahkan alamat perguruan tinggi ini dari Banda Aceh ke Medan dengan alamat kampus di Medan </p>
    </div>


</section>


<!--home section end-->
@endsection

@push('scripts')
<!-- Plugins JS start-->
<script src="{{ asset('vendor/fslightbox/fslightbox.js') }}"></script>
<!-- Plugins JS Ends-->

@endpush
