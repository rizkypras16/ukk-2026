@extends('layouts.app')

@section('title', config('app.name') . ($isAdmin ? ' -- Tanggapi Aspirasi' : ' -- Edit Aspirasi'))

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Archivo+Black&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/sarpras-landing.css">
    <link rel="stylesheet" href="/css/sarpras-pages.css">

    <div class="container py-4">
        <div class="sp">

            <header class="sp-pagehead">
                <div>
                    @if($isAdmin)
                        <span class="sp-sticker">★ PANEL ADMINISTRATOR</span>
                        <h1 class="sp-title">Tanggapi <span>Aspirasi</span></h1>
                    @else
                        <span class="sp-sticker">★ LAPORAN SAYA</span>
                        <h1 class="sp-title">Edit <span>Aspirasi</span></h1>
                    @endif
                </div>
                <a href="{{ $isAdmin ? route('admin.aspirasi.index') : route('aspirasi.index') }}" class="sp-btn sp-btn--white">← Kembali</a>
            </header>

            @if($isAdmin)

                {{-- ===== TAMPILAN ADMIN: rincian laporan + status + tanggapan ===== --}}
                <div class="sp-box" style="margin-top:26px;overflow:hidden">
                    <table class="sp-info">
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $aspirasi->kategori->kategori ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>{{ $aspirasi->judul }}</td>
                        </tr>
                        @if($alat)
                            <tr>
                                <th>Alat</th>
                                <td>{{ $alat->nama_alat }}</td>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <td>{{ $alat->lokasi ?? '-' }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $aspirasi->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lapor</th>
                            <td>{{ date('d M Y', strtotime($aspirasi->created_at)) }}</td>
                        </tr>
                        @if($aspirasi->foto)
                            <tr>
                                <th>Foto Bukti</th>
                                <td>
                                    <a href="{{ asset('uploads/aspirasi/' . $aspirasi->foto) }}" target="_blank">
                                        <img class="sp-thumb" src="{{ asset('uploads/aspirasi/' . $aspirasi->foto) }}" alt="Foto Bukti">
                                    </a>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>

                <div class="sp-box sp-formbox">
                    <form action="{{ route('admin.aspirasi.update', ['id_aspirasi' => $aspirasi->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @php $statusSaatIni = strtolower($aspirasi->status); @endphp

                        <div class="sp-field">
                            <label for="status">Status</label>
                            <select name="status" id="status" required>
                                <option value="pending" {{ $statusSaatIni == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ $statusSaatIni == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $statusSaatIni == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="ditolak" {{ $statusSaatIni == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            @error('status')
                                <div class="sp-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sp-field">
                            <label for="tanggapan">Tanggapan (opsional)</label>
                            <textarea id="tanggapan" name="tanggapan" rows="5" placeholder="Tulis tanggapan untuk siswa...">{{ old('tanggapan', $aspirasi->tanggapan) }}</textarea>
                        </div>

                        <div class="sp-field">
                            <label for="foto_hasil">Foto Hasil Perbaikan (opsional)</label>
                            @if($aspirasi->foto_hasil)
                                <a href="{{ asset('uploads/aspirasi/' . $aspirasi->foto_hasil) }}" target="_blank" style="display:inline-block;margin-bottom:10px">
                                 <img class="sp-thumb" src="{{ asset('uploads/aspirasi/' . $aspirasi->foto_hasil) }}" alt="Foto Hasil Saat Ini">
                                </a>
                                @endif
                                <input type="file" id="foto_hasil" name="foto_hasil" accept="image/*">
                                    <div class="sp-muted" style="margin-top:6px">Unggah foto setelah barang selesai diperbaiki. Kosongkan jika tidak ingin mengganti.</div>
                                    @error('foto_hasil')
                                <div class="sp-error">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="sp-formactions">
                            <button type="submit" class="sp-btn">Simpan</button>
                            <a href="{{ route('admin.aspirasi.index') }}" class="sp-btn sp-btn--white">Kembali</a>
                        </div>
                    </form>
                </div>

            @else

                {{-- ===== TAMPILAN SISWA: ubah laporan sendiri ===== --}}
                <div class="sp-box sp-formbox">
                    <form action="{{ route('aspirasi.update', ['id_aspirasi' => $aspirasi->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="sp-field">
                            <label for="id_kategori">Kategori *</label>
                            <select name="id_kategori" id="id_kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id_kategori }}" {{ old('id_kategori', $aspirasi->id_kategori) == $kat->id_kategori ? 'selected' : '' }}>
                                        {{ $kat->kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <div class="sp-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sp-field">
                            <label for="judul">Judul Aspirasi *</label>
                            <input type="text" id="judul" name="judul" value="{{ old('judul', $aspirasi->judul) }}" placeholder="Masukkan judul aspirasi..." required>
                            @error('judul')
                                <div class="sp-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sp-field">
                            <label for="deskripsi">Deskripsi Detail *</label>
                            <textarea id="deskripsi" name="deskripsi" rows="5" placeholder="Jelaskan secara rinci permasalahan..." required>{{ old('deskripsi', $aspirasi->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="sp-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sp-field">
                            <label for="foto">Foto Bukti Pendukung</label>
                            @if($aspirasi->foto)
                                <a href="{{ asset('uploads/aspirasi/' . $aspirasi->foto) }}" target="_blank" style="display:inline-block;margin-bottom:10px">
                                    <img class="sp-thumb" src="{{ asset('uploads/aspirasi/' . $aspirasi->foto) }}" alt="Foto Bukti Saat Ini">
                                </a>
                            @endif
                            <input type="file" id="foto" name="foto" accept="image/*">
                            <div class="sp-muted" style="margin-top:6px">Biarkan kosong jika tidak ingin mengganti foto bukti.</div>
                            @error('foto')
                                <div class="sp-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sp-formactions">
                            <button type="submit" class="sp-btn">Simpan Perubahan</button>
                            <a href="{{ route('aspirasi.index') }}" class="sp-btn sp-btn--white">Batal</a>
                        </div>
                    </form>
                </div>

            @endif

        </div>
    </div>

@endsection