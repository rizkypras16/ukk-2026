/*
| Toggle tema gelap/terang lewat tombol #themeToggle. Ikon bulan/matahari
| diganti lewat CSS (lihat nb-navbar.css) mengikuti [data-bs-theme], jadi di
| sini cukup ganti atribut & simpan pilihannya.
|
| Pemilihan awal (sebelum file ini dimuat) sudah diterapkan lewat script
| kecil di <head> supaya tidak ada flash warna -- lihat layouts/app.sakuci.php.
*/
(function () {
    var STORAGE_KEY = 'sakuci-theme';
    var root = document.documentElement;

    document.addEventListener('DOMContentLoaded', function () {
        var button = document.getElementById('themeToggle');

        if (! button) {
            return;
        }

        button.addEventListener('click', function () {
            var next = root.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';

            root.setAttribute('data-bs-theme', next);
            localStorage.setItem(STORAGE_KEY, next);
        });
    });
})();

/* Sarpras Landing — panel "Coba Langsung" dan tab peran.
   Hanya dijalankan kalau elemennya ada (halaman landing). */
document.addEventListener('DOMContentLoaded', function () {

  /* ---------- Panel kondisi barang ---------- */
  var daftar = document.getElementById('sp-list');
  var ringkasan = document.getElementById('sp-sum');

  if (daftar && ringkasan) {
    var kondisi = [['sp-ok', 'Baik'], ['sp-warn', 'Rusak ringan'], ['sp-bad', 'Rusak berat']];
    var barang = [
      ['Proyektor Lab RPL', 0],
      ['AC Ruang Guru', 1],
      ['Kursi Kelas X-2', 2],
      ['Router Lab Jaringan', 0]
    ];

    function gambar() {
      daftar.innerHTML = barang.map(function (b, i) {
        return '<div class="sp-item" data-i="' + i + '">' + b[0] +
               '<span class="sp-pill ' + kondisi[b[1]][0] + '">' + kondisi[b[1]][1] + '</span></div>';
      }).join('');

      var hitung = [0, 0, 0];
      barang.forEach(function (b) { hitung[b[1]]++; });
      ringkasan.innerHTML = kondisi.map(function (k, i) {
        return '<span>' + k[1] + ': ' + hitung[i] + '</span>';
      }).join('');
    }

    daftar.addEventListener('click', function (e) {
      var el = e.target.closest('.sp-item');
      if (!el) return;
      var i = Number(el.dataset.i);
      barang[i][1] = (barang[i][1] + 1) % 3;
      gambar();
    });
    gambar();
  }

  /* ---------- Tab peran ---------- */
  var judulPeran = document.getElementById('sp-role-title');
  var deskPeran = document.getElementById('sp-role-desc');
  var listPeran = document.getElementById('sp-role-list');
  var tabs = document.querySelectorAll('.sp-tab');

  if (judulPeran && deskPeran && listPeran && tabs.length) {
    var peran = {
      admin: ['ADMIN',
        'Pengendali penuh sistem: dari data master sampai keputusan akhir pengadaan.',
        ['Kelola data master', 'Setujui atau tolak pengadaan', 'Lihat seluruh laporan', 'Atur akun pengguna']],
      petugas: ['SISWA',
        'Pengguna utama yang menyampaikan aspirasi dan memantau kondisi fasilitas sekolah.',
        ['Lihat daftar alat dan fasilitas', 'Kirim aspirasi atau laporan', 'Pantau status laporan', 'Lihat tanggapan dari admin']]
    };

    function pilihPeran(k) {
      judulPeran.textContent = peran[k][0];
      deskPeran.textContent = peran[k][1];
      listPeran.innerHTML = peran[k][2].map(function (x) {
        return '<li>' + x + '</li>';
      }).join('');
      tabs.forEach(function (t) { t.classList.toggle('is-on', t.dataset.role === k); });
    }
    tabs.forEach(function (t) {
      t.addEventListener('click', function () { pilihPeran(t.dataset.role); });
    });
    pilihPeran('admin');
  }
});