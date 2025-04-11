Hello, {{$pengajuan->nrp}} - {{$pengajuan->mahasiswa->nama}}!
<br>
<br>
Proses pengajuan {{$pengajuan->jenis_surat}} ({{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d-m-Y') }}) anda telah selesai, 
silahkan mendownload surat pada website.
<br>
<br>
LetterGO.