        <!-- ini buat manggil master page nya -->

        @section('judulmain','addjadwalmain')
        <!-- ini untuk judul page nya , bisa di modifikasi -->

        <style>
            .a-table {
                margin-top: 10px;
            }

            .Tiket_Pesawat {
                border-radius: 100px;
                width: 80px;
                height: 50px;
            }

            .a-table1 {
                overflow: auto;
            }

            .pagination li {
                float: left;
                list-style-type: none;
                margin: 5px;
            }
        </style>
        <div class="container">
            <h2 align="center" style="margin: 30px;"> TAMBAH JADWAL</h2>
            <form action="/lihat-jadwal/tambah" method="POST" enctype="multipart/form-data">

                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                </head>

                <body>
                    <Datatable>
                        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
                        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
                        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
                        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                        <title>Add data Jadwal</title>
                        <!- Bootstrap ->
                            <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
                            <!- Font Awesome ->
                                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <form action="{{url('/lihat-jadwal/tambah')}}" method="post" enctype="multipart/form-data">
                                        <form>
                                            <div class="form-group">
                                                <label>List Atlit</label>
                                                <select name="Nama" class="form-control">
                                                    <option value="">- Pilih Atlit -</option>
                                                    @foreach ($cabor as $cbr)
                                                    <option value="{{$cbr->Nama}}">{{$cbr->Nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div Class="form-group">
                                                <label for="Tiket_Pesawat">Tiket Pesawat</label>
                                                <img id="foto_show" class="Tiket_Pesawat" />
                                                <input type="file" name="Tiket_Pesawat" id="Tiket_Pesawat" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="no_kamar">NO.kamar </label>
                                                <input type="text" name="no_kamar" id="no_kamar" class="form-control"></input>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_booking">NO.Booking </label>
                                                <input type="text" name="no_booking" id="no_booking" class="form-control"></input>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Keberangkastan</label>
                                                <!--select id="selectbox2">!-->
                                                <select name="Tanggal_keberangkatan" class="form-control input-lg dynamic" data-dependent="Inventaris_mobil">
                                                    <option value="">- Pilih Tanggal Keberangkatan</option>
                                                    @foreach ($lihatdata as $lihat)
                                                    <option value="{{$lihat->Tanggal_keberangkatan}}">{{$lihat->Tanggal_keberangkatan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Pilh Inventaris</label>
                                                <!---select id="selectbox1">!-->
                                                <select name="Inventaris_mobil" class="form-control input-lg dynamic" data-dependent="Inventaris_mobil">
                                                    <option value="value1">- Pilih Inventaris -</option>
                                                    @foreach ($lihatdata as $lihat)
                                                    <option value="{{$lihat->Inventaris_mobil}}">{{$lihat->Inventaris_mobil}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="submit" class="btn btn-success" value="Add">
                                            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
                                            </input>
                                            <script>
                                                function readURL(input) {
                                                    if (input.files && input.files[0]) {
                                                        var reader = new FileReader();

                                                        reader.onload = function(e) {
                                                            $('#foto_show').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(input.files[0]);
                                                    }
                                                }

                                                $("#Tiket_Pesawat").change(function() {
                                                    readURL(this);
                                                });
                                            </script>
                                            <script>
                                                $('#Tanggal_keberangkatan').change(function() {
                                                    var data = "";
                                                    $.ajax({
                                                        type: "GET",
                                                        url: "Controller mapping",
                                                        data: "Tanggal_keberangkatan_selectedvalue=" + $(this).val(),
                                                        success: function(response) {
                                                            async: false,
                                                            data = response;
                                                            return response;
                                                        },
                                                        error: function() {
                                                            alert('Error occured');
                                                        }
                                                    });
                                                    var string = data.message.split(",");
                                                    var array = string.filter(function(e) {
                                                        return e;
                                                    });
                                                    var select = $('Inventaris_mobil');
                                                    select.empty();
                                                    $.each(array, function(index, value) {
                                                        select.append(
                                                            $('<option></option>').val(value).html(value)
                                                        );
                                                    });
                                                    $('#Inventaris_mobil').show();
                                                });
                                            </script>