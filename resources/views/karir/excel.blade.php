<table>
    <tr>
        <td>DAFTAR RIWAYAT HIDUP</td>
    </tr>

    <tr></tr>
    <tr>
        <td>I. DATA PRIBADI</td>
    </tr>
    <tr>
        <td>1. Nama Lengkap</td>
        <td><?= $pegawai->nama ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?= $pegawai->nik ?> / <?= $pegawai->nik_sap ?></td>
    </tr>
    <tr>
        <td>2. Jabatan</td>
        <td><?= $pegawai->nm_jabatan ?></td>
    </tr>
    <tr>
        <td>3. Grade</td>
        <td><?= $pegawai->p_grade ?></td>
    </tr>
    <tr>
        <td>4. Tempat/Tanggal Lahir</td>
        <td><?= $pegawai->tmp_lahir ?> / <?= $pegawai->tgl_lahir ?></td>
    </tr>
    <tr>
        <td>5. Agama</td>
        <td><?= $pegawai->agama ?></td>
    </tr>
    <tr>
        <td>6. Dasar Penerimaan</td>
        <td><?= $pegawai->pendidikan ?></td>
    </tr>
    <tr>
        <td>7. Pendidikan Akhir</td>
        <td><?= $pegawai->jurusan ?> - <?= $pegawai->pend_akhir ?> - <?= $pegawai->institusi ?></td>
    </tr>

    <tr></tr>
    <tr>
        <td>II. RIWAYAT PEKERJAAN</td>
    </tr>
    <tr>
        <td>1. Tanggal mulai bekerja</td>
        <td><?= $pegawai->tgl_masuk ?></td>
    </tr>
    <tr>
        <td>2. Jumlah masa kerja</td>
        <td><?= $pegawai->masa_kerja ?></td>
    </tr>
    <tr>
        <td>3. Mutasi jabatan (struktural/fungsional)</td>
        <td></td>
    </tr>

    @if (count($pegawai->karir_internal) > 0)
        <tr></tr>
        <tr>
            <td>A. Di dalam PT Petrokimia Gresik</td>
        </tr>
        <tr>
            <td>No</td>
            <td>Nama Jabatan</td>
            <td>Nama Unit Kerja</td>
            <td>Tahun</td>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($pegawai->karir_internal as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row['nama_jabatan'] }}</td>
                <td>{{ $row['nama_unitkerja'] }}</td>
                <td>{{ $row['tgl_mulai'] ?? '' }} s.d. {{ $row['tgl_selesai'] ?? '' }}</td>
            </tr>
        @endforeach
    @endif

    @if (count($pegawai->karir_eksternal) > 0)
        <tr></tr>
        <tr>
            <td>B. Di luar PT Petrokimia Gresik</td>
        </tr>
        <tr>
            <td>No</td>
            <td>Nama Jabatan</td>
            <td>Nama Unit Kerja</td>
            <td>Tahun</td>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($pegawai->karir_eksternal as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row['nama_jabatan'] }}</td>
                <td>{{ $row['nama_unitkerja'] }}</td>
                <td>{{ $row['tgl_mulai'] ?? '' }} s.d. {{ $row['tgl_selesai'] ?? '' }}</td>
            </tr>
        @endforeach
    @endif

    @if (count($pegawai->pelatihanDN) > 0 || count($pegawai->pelatihanLN) > 0)
        <tr></tr>
        <tr>
            <td>III. PENDIDIKAN DAN PELATIHAN YANG TELAH DIIKUTI</td>
        </tr>

        @if (count($pegawai->pelatihanDN) > 0)
            <tr></tr>
            <tr>
                <td>A. Dalam Negeri</td>
            </tr>
            <tr>
                <td>No</td>
                <td>Jenis Pendidikan</td>
                <td>Nama/Tempat Penyelenggara</td>
                <td>Tahun</td>
            </tr>
            @php
                $no = 1;
            @endphp
            @foreach ($pegawai->pelatihanDN as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row['jenis_pendidikan'] }}</td>
                    <td>{{ $row['nama_tempat_penyelenggara'] }}</td>
                    <td>{{ $row['tgl_mulai'] ?? '' }} s.d. {{ $row['tgl_selesai'] ?? '' }}</td>
                </tr>
            @endforeach
        @endif

        @if (count($pegawai->pelatihanLN) > 0)
            <tr></tr>
            <tr>
                <td>B. Luar Negeri</td>
            </tr>
            <tr>
                <td>No</td>
                <td>Jenis Pendidikan</td>
                <td>Nama/Tempat Penyelenggara</td>
                <td>Tahun</td>
            </tr>
            @php
                $no = 1;
            @endphp
            @foreach ($pegawai->pelatihanLN as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row['jenis_pendidikan'] }}</td>
                    <td>{{ $row['nama_tempat_penyelenggara'] }}</td>
                    <td>{{ $row['tgl_mulai'] ?? '' }} s.d. {{ $row['tgl_selesai'] ?? '' }}</td>
                </tr>
            @endforeach
        @endif
    @endif
</table>