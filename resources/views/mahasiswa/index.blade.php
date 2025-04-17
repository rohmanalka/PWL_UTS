<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>NAMA</th>
        </tr>
        @foreach ($data as $d)
            <tr>
                <th>{{ $d->id_mahasiswa }}</th>
                <th>{{ $d->nim }}</th>
                <th>{{ $d->nama }}</th>
            </tr>
        @endforeach
    </table>
</body>
</html>