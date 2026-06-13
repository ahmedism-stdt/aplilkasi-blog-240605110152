<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistem Manajemen Blog (CMS)</title>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; color: #333; min-height: 100vh; }

  /* HEADER */
  .header {
    background: #fff;
    border-bottom: 1px solid #dde1e7;
    padding: 12px 24px;
    display: flex;
    align-items: center;
    gap: 10px;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 6px rgba(0,0,0,.06);
  }
  .header-icon { font-size: 22px; color: #4f46e5; }
  .header h1 { font-size: 17px; font-weight: 700; color: #1a1a2e; }
  .header small { font-size: 12px; color: #888; }
  .header-link {
    margin-left: auto;
    padding: 8px 13px;
    border-radius: 6px;
    background: #eef2ff;
    color: #4338ca;
    border: 1px solid #c7d2fe;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
  }

  /* LAYOUT */
  .layout { display: flex; min-height: calc(100vh - 56px); }

  /* SIDEBAR */
  .sidebar {
    width: 220px;
    background: #fff;
    border-right: 1px solid #dde1e7;
    padding: 20px 0;
    flex-shrink: 0;
  }
  .sidebar .menu-label {
    font-size: 11px;
    font-weight: 700;
    color: #aaa;
    letter-spacing: .08em;
    padding: 0 20px 10px;
    text-transform: uppercase;
  }
  .nav-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 14px;
    color: #555;
    border-left: 3px solid transparent;
    transition: all .2s;
  }
  .nav-item:hover { background: #f5f3ff; color: #4f46e5; }
  .nav-item.active { background: #f0eeff; color: #4f46e5; font-weight: 600; border-left-color: #4f46e5; }
  .nav-item .icon { font-size: 16px; width: 20px; text-align: center; }

  /* CONTENT */
  .content { flex: 1; padding: 28px; overflow-x: auto; }
  .content-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 1px 4px rgba(0,0,0,.07);
    padding: 24px;
  }
  .content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }
  .content-header h2 { font-size: 16px; font-weight: 700; }

  /* BUTTONS */
  .btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    transition: opacity .2s, transform .1s;
  }
  .btn:hover { opacity: .88; }
  .btn:active { transform: scale(.97); }
  .btn-primary  { background: #4f46e5; color: #fff; }
  .btn-success  { background: #22c55e; color: #fff; }
  .btn-warning  { background: #f59e0b; color: #fff; }
  .btn-danger   { background: #ef4444; color: #fff; }
  .btn-secondary{ background: #e5e7eb; color: #374151; }
  .btn-sm { padding: 5px 11px; font-size: 12px; }

  /* TABLE */
  table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
  thead th {
    background: #f8f9fa;
    padding: 10px 14px;
    text-align: left;
    font-size: 12px;
    font-weight: 700;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: .05em;
    border-bottom: 2px solid #e5e7eb;
  }
  tbody td { padding: 12px 14px; border-bottom: 1px solid #f0f0f0; vertical-align: middle; }
  tbody tr:last-child td { border-bottom: none; }
  tbody tr:hover { background: #fafafa; }
  .foto-thumb {
    width: 44px; height: 44px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e5e7eb;
    background: #eee;
  }
  .foto-thumb-rect {
    width: 56px; height: 44px;
    border-radius: 6px;
    object-fit: cover;
    border: 2px solid #e5e7eb;
    background: #eee;
  }
  .badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    background: #e0e7ff;
    color: #4f46e5;
  }
  .pwd-mask { font-family: monospace; color: #aaa; letter-spacing: .1em; }
  .action-group { display: flex; gap: 6px; }
  .tanggal-cell { font-size: 12px; color: #666; white-space: nowrap; }
  .empty-msg { text-align: center; padding: 40px; color: #aaa; font-size: 14px; }

  /* MODAL */
  .modal-overlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(0,0,0,.45);
    z-index: 500;
    align-items: center;
    justify-content: center;
  }
  .modal-overlay.open { display: flex; }
  .modal-box {
    background: #fff;
    border-radius: 12px;
    padding: 28px;
    width: 480px;
    max-width: 95vw;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,.2);
    animation: popIn .2s ease;
  }
  @keyframes popIn { from { transform: scale(.92); opacity: 0; } to { transform: scale(1); opacity: 1; } }
  .modal-title { font-size: 16px; font-weight: 700; margin-bottom: 20px; }
  .modal-delete { text-align: center; }
  .modal-delete .del-icon { font-size: 44px; color: #ef4444; margin-bottom: 12px; }
  .modal-delete h3 { font-size: 16px; font-weight: 700; margin-bottom: 6px; }
  .modal-delete p { font-size: 13px; color: #888; margin-bottom: 20px; }
  .modal-delete .btn-group { display: flex; gap: 10px; justify-content: center; }

  /* FORM */
  .form-row { display: flex; gap: 14px; }
  .form-row .form-group { flex: 1; }
  .form-group { margin-bottom: 14px; }
  .form-group label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 5px; }
  .form-group input,
  .form-group select,
  .form-group textarea {
    width: 100%;
    padding: 9px 12px;
    border: 1.5px solid #d1d5db;
    border-radius: 7px;
    font-size: 13.5px;
    font-family: inherit;
    transition: border-color .2s;
    background: #fff;
    color: #333;
  }
  .form-group input:focus,
  .form-group select:focus,
  .form-group textarea:focus { outline: none; border-color: #4f46e5; }
  .form-group textarea { resize: vertical; min-height: 90px; }
  .form-hint { font-size: 11.5px; color: #9ca3af; margin-top: 3px; }
  .form-footer { display: flex; justify-content: flex-end; gap: 10px; margin-top: 6px; }

  /* ALERT */
  .alert {
    padding: 10px 14px;
    border-radius: 7px;
    font-size: 13px;
    margin-bottom: 14px;
    display: none;
  }
  .alert.show { display: block; }
  .alert-danger  { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
  .alert-success { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }

  /* LOADING */
  .spinner {
    width: 32px; height: 32px;
    border: 3px solid #e5e7eb;
    border-top-color: #4f46e5;
    border-radius: 50%;
    animation: spin .7s linear infinite;
    margin: 40px auto;
    display: block;
  }
  @keyframes spin { to { transform: rotate(360deg); } }

  .welcome {
    text-align: center;
    padding: 60px 20px;
    color: #9ca3af;
  }
  .welcome .w-icon { font-size: 56px; margin-bottom: 12px; }
  .welcome h3 { font-size: 18px; color: #6b7280; margin-bottom: 8px; }
  .welcome p { font-size: 13px; }
</style>
</head>
<body>

<!-- HEADER -->
<div class="header">
  <span class="header-icon">&#9741;</span>
  <div>
    <h1>Sistem Manajemen Blog (CMS)</h1>
    <small>Blog Admin</small>
  </div>
  <a class="header-link" href="/" target="_blank">Halaman Pengunjung</a>
</div>

<!-- LAYOUT -->
<div class="layout">

  <!-- SIDEBAR -->
  <nav class="sidebar">
    <div class="menu-label">Menu Utama</div>
    <div class="nav-item" id="nav-penulis" onclick="showSection('penulis')">
      <span class="icon">&#128100;</span> Kelola Penulis
    </div>
    <div class="nav-item" id="nav-artikel" onclick="showSection('artikel')">
      <span class="icon">&#128196;</span> Kelola Artikel
    </div>
    <div class="nav-item" id="nav-kategori" onclick="showSection('kategori')">
      <span class="icon">&#128193;</span> Kelola Kategori
    </div>
  </nav>

  <!-- CONTENT -->
  <main class="content">
    <div class="content-card" id="main-content">
      <div class="welcome">
        <div class="w-icon">&#128196;</div>
        <h3>Selamat Datang di Blog CMS</h3>
        <p>Pilih menu di sebelah kiri untuk mulai mengelola konten.</p>
      </div>
    </div>
  </main>

</div>

<!-- ===================== MODAL PENULIS ===================== -->
<!-- TAMBAH PENULIS -->
<div class="modal-overlay" id="modal-tambah-penulis">
  <div class="modal-box">
    <div class="modal-title">Tambah Penulis</div>
    <div class="alert alert-danger" id="err-tambah-penulis"></div>
    <div class="form-row">
      <div class="form-group"><label>Nama Depan</label><input type="text" id="tp-nama-depan" placeholder="Ahmad"></div>
      <div class="form-group"><label>Nama Belakang</label><input type="text" id="tp-nama-belakang" placeholder="Fauzi"></div>
    </div>
    <div class="form-group"><label>Username</label><input type="text" id="tp-username" placeholder="ahmad_f"></div>
    <div class="form-group"><label>Password</label><input type="password" id="tp-password" placeholder="••••••••••••"></div>
    <div class="form-group"><label>Foto Profil</label><input type="file" id="tp-foto" accept="image/*"></div>
    <div class="form-footer">
      <button class="btn btn-secondary" onclick="closeModal('modal-tambah-penulis')">Batal</button>
      <button class="btn btn-primary" onclick="simpanPenulis()">Simpan Data</button>
    </div>
  </div>
</div>

<!-- EDIT PENULIS -->
<div class="modal-overlay" id="modal-edit-penulis">
  <div class="modal-box">
    <div class="modal-title">Edit Penulis</div>
    <div class="alert alert-danger" id="err-edit-penulis"></div>
    <input type="hidden" id="ep-id">
    <div class="form-row">
      <div class="form-group"><label>Nama Depan</label><input type="text" id="ep-nama-depan"></div>
      <div class="form-group"><label>Nama Belakang</label><input type="text" id="ep-nama-belakang"></div>
    </div>
    <div class="form-group"><label>Username</label><input type="text" id="ep-username"></div>
    <div class="form-group">
      <label>Password Baru <small style="color:#aaa">(kosongkan jika tidak diganti)</small></label>
      <input type="password" id="ep-password" placeholder="••••••••••••">
    </div>
    <div class="form-group">
      <label>Foto Profil <small style="color:#aaa">(kosongkan jika tidak diganti)</small></label>
      <input type="file" id="ep-foto" accept="image/*">
    </div>
    <div class="form-footer">
      <button class="btn btn-secondary" onclick="closeModal('modal-edit-penulis')">Batal</button>
      <button class="btn btn-primary" onclick="updatePenulis()">Simpan Perubahan</button>
    </div>
  </div>
</div>

<!-- HAPUS PENULIS -->
<div class="modal-overlay" id="modal-hapus-penulis">
  <div class="modal-box">
    <div class="modal-delete">
      <div class="del-icon">&#128465;</div>
      <input type="hidden" id="hp-id">
      <h3>Hapus data ini?</h3>
      <p>Data yang dihapus tidak dapat dikembalikan.</p>
      <div class="alert alert-danger" id="err-hapus-penulis"></div>
      <div class="btn-group">
        <button class="btn btn-secondary" onclick="closeModal('modal-hapus-penulis')">Batal</button>
        <button class="btn btn-danger" onclick="hapusPenulis()">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>

<!-- ===================== MODAL ARTIKEL ===================== -->
<!-- TAMBAH ARTIKEL -->
<div class="modal-overlay" id="modal-tambah-artikel">
  <div class="modal-box">
    <div class="modal-title">Tambah Artikel</div>
    <div class="alert alert-danger" id="err-tambah-artikel"></div>
    <div class="form-group"><label>Judul</label><input type="text" id="ta-judul" placeholder="Judul artikel..."></div>
    <div class="form-row">
      <div class="form-group">
        <label>Penulis</label>
        <select id="ta-penulis"><option value="">-- Pilih Penulis --</option></select>
      </div>
      <div class="form-group">
        <label>Kategori</label>
        <select id="ta-kategori"><option value="">-- Pilih Kategori --</option></select>
      </div>
    </div>
    <div class="form-group"><label>Isi Artikel</label><textarea id="ta-isi" placeholder="Tulis isi artikel di sini..."></textarea></div>
    <div class="form-group"><label>Gambar</label><input type="file" id="ta-gambar" accept="image/*"></div>
    <div class="form-footer">
      <button class="btn btn-secondary" onclick="closeModal('modal-tambah-artikel')">Batal</button>
      <button class="btn btn-primary" onclick="simpanArtikel()">Simpan Data</button>
    </div>
  </div>
</div>

<!-- EDIT ARTIKEL -->
<div class="modal-overlay" id="modal-edit-artikel">
  <div class="modal-box">
    <div class="modal-title">Edit Artikel</div>
    <div class="alert alert-danger" id="err-edit-artikel"></div>
    <input type="hidden" id="ea-id">
    <div class="form-group"><label>Judul</label><input type="text" id="ea-judul"></div>
    <div class="form-row">
      <div class="form-group">
        <label>Penulis</label>
        <select id="ea-penulis"><option value="">-- Pilih Penulis --</option></select>
      </div>
      <div class="form-group">
        <label>Kategori</label>
        <select id="ea-kategori"><option value="">-- Pilih Kategori --</option></select>
      </div>
    </div>
    <div class="form-group"><label>Isi Artikel</label><textarea id="ea-isi"></textarea></div>
    <div class="form-group">
      <label>Gambar <small style="color:#aaa">(kosongkan jika tidak diganti)</small></label>
      <input type="file" id="ea-gambar" accept="image/*">
    </div>
    <div class="form-footer">
      <button class="btn btn-secondary" onclick="closeModal('modal-edit-artikel')">Batal</button>
      <button class="btn btn-primary" onclick="updateArtikel()">Simpan Perubahan</button>
    </div>
  </div>
</div>

<!-- HAPUS ARTIKEL -->
<div class="modal-overlay" id="modal-hapus-artikel">
  <div class="modal-box">
    <div class="modal-delete">
      <div class="del-icon">&#128465;</div>
      <input type="hidden" id="ha-id">
      <h3>Hapus data ini?</h3>
      <p>Data yang dihapus tidak dapat dikembalikan.</p>
      <div class="alert alert-danger" id="err-hapus-artikel"></div>
      <div class="btn-group">
        <button class="btn btn-secondary" onclick="closeModal('modal-hapus-artikel')">Batal</button>
        <button class="btn btn-danger" onclick="hapusArtikel()">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>

<!-- ===================== MODAL KATEGORI ===================== -->
<!-- TAMBAH KATEGORI -->
<div class="modal-overlay" id="modal-tambah-kategori">
  <div class="modal-box">
    <div class="modal-title">Tambah Kategori</div>
    <div class="alert alert-danger" id="err-tambah-kategori"></div>
    <div class="form-group"><label>Nama Kategori</label><input type="text" id="tk-nama" placeholder="Nama kategori..."></div>
    <div class="form-group"><label>Keterangan</label><textarea id="tk-keterangan" placeholder="Deskripsi kategori..."></textarea></div>
    <div class="form-footer">
      <button class="btn btn-secondary" onclick="closeModal('modal-tambah-kategori')">Batal</button>
      <button class="btn btn-primary" onclick="simpanKategori()">Simpan Data</button>
    </div>
  </div>
</div>

<!-- EDIT KATEGORI -->
<div class="modal-overlay" id="modal-edit-kategori">
  <div class="modal-box">
    <div class="modal-title">Edit Kategori</div>
    <div class="alert alert-danger" id="err-edit-kategori"></div>
    <input type="hidden" id="ek-id">
    <div class="form-group"><label>Nama Kategori</label><input type="text" id="ek-nama"></div>
    <div class="form-group"><label>Keterangan</label><textarea id="ek-keterangan"></textarea></div>
    <div class="form-footer">
      <button class="btn btn-secondary" onclick="closeModal('modal-edit-kategori')">Batal</button>
      <button class="btn btn-primary" onclick="updateKategori()">Simpan Perubahan</button>
    </div>
  </div>
</div>

<!-- HAPUS KATEGORI -->
<div class="modal-overlay" id="modal-hapus-kategori">
  <div class="modal-box">
    <div class="modal-delete">
      <div class="del-icon">&#128465;</div>
      <input type="hidden" id="hk-id">
      <h3>Hapus data ini?</h3>
      <p>Data yang dihapus tidak dapat dikembalikan.</p>
      <div class="alert alert-danger" id="err-hapus-kategori"></div>
      <div class="btn-group">
        <button class="btn btn-secondary" onclick="closeModal('modal-hapus-kategori')">Batal</button>
        <button class="btn btn-danger" onclick="hapusKategori()">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>

<script>
/* ============================================================
   UTILITIES
   ============================================================ */
function esc(str) {
  if (str === null || str === undefined) return '';
  return String(str)
    .replace(/&/g,'&amp;').replace(/</g,'&lt;')
    .replace(/>/g,'&gt;').replace(/"/g,'&quot;')
    .replace(/'/g,'&#039;');
}

function openModal(id) {
  document.getElementById(id).classList.add('open');
}
function closeModal(id) {
  document.getElementById(id).classList.remove('open');
}
function showAlert(id, msg, type = 'danger') {
  const el = document.getElementById(id);
  el.className = `alert alert-${type} show`;
  el.textContent = msg;
}
function hideAlert(id) {
  document.getElementById(id).classList.remove('show');
}
function setContent(html) {
  document.getElementById('main-content').innerHTML = html;
}
function setActive(section) {
  document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
  document.getElementById('nav-' + section)?.classList.add('active');
}

/* Close modal on overlay click */
document.querySelectorAll('.modal-overlay').forEach(overlay => {
  overlay.addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('open');
  });
});

/* ============================================================
   SECTION ROUTER
   ============================================================ */
function showSection(section) {
  setActive(section);
  if (section === 'penulis')  loadPenulis();
  if (section === 'artikel')  loadArtikel();
  if (section === 'kategori') loadKategori();
}

/* ============================================================
   ██████  PENULIS
   ============================================================ */
function loadPenulis() {
  setContent('<div class="content-header"><h2>Data Penulis</h2><div></div></div><span class="spinner"></span>');
  fetch('ambil_penulis.php')
    .then(r => r.json())
    .then(data => renderPenulis(data))
    .catch(() => setContent('<p style="color:red;padding:20px">Gagal memuat data penulis.</p>'));
}

function renderPenulis(data) {
  let rows = '';
  if (data.length === 0) {
    rows = '<tr><td colspan="5" class="empty-msg">Belum ada data penulis.</td></tr>';
  } else {
    data.forEach(p => {
      const fotoSrc = 'uploads_penulis/' + esc(p.foto);
      rows += `
        <tr>
          <td><img src="${fotoSrc}" class="foto-thumb" onerror="this.src='uploads_penulis/default.png'" alt="foto"></td>
          <td>${esc(p.nama_depan)} ${esc(p.nama_belakang)}</td>
          <td>${esc(p.user_name)}</td>
          <td><span class="pwd-mask">${esc(p.password).substring(0,12)}...</span></td>
          <td>
            <div class="action-group">
              <button class="btn btn-warning btn-sm" onclick="openEditPenulis(${p.id})">Edit</button>
              <button class="btn btn-danger btn-sm" onclick="openHapusPenulis(${p.id})">Hapus</button>
            </div>
          </td>
        </tr>`;
    });
  }
  setContent(`
    <div class="content-header">
      <h2>Data Penulis</h2>
      <button class="btn btn-primary" onclick="openTambahPenulis()">+ Tambah Penulis</button>
    </div>
    <table>
      <thead><tr><th>FOTO</th><th>NAMA</th><th>USERNAME</th><th>PASSWORD</th><th>AKSI</th></tr></thead>
      <tbody>${rows}</tbody>
    </table>`);
}

function openTambahPenulis() {
  document.getElementById('tp-nama-depan').value = '';
  document.getElementById('tp-nama-belakang').value = '';
  document.getElementById('tp-username').value = '';
  document.getElementById('tp-password').value = '';
  document.getElementById('tp-foto').value = '';
  hideAlert('err-tambah-penulis');
  openModal('modal-tambah-penulis');
}

function simpanPenulis() {
  hideAlert('err-tambah-penulis');
  const fd = new FormData();
  fd.append('nama_depan',    document.getElementById('tp-nama-depan').value.trim());
  fd.append('nama_belakang', document.getElementById('tp-nama-belakang').value.trim());
  fd.append('user_name',     document.getElementById('tp-username').value.trim());
  fd.append('password',      document.getElementById('tp-password').value);
  const foto = document.getElementById('tp-foto').files[0];
  if (foto) fd.append('foto', foto);

  fetch('simpan_penulis.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      if (res.status === 'success') { closeModal('modal-tambah-penulis'); loadPenulis(); }
      else showAlert('err-tambah-penulis', res.message);
    }).catch(() => showAlert('err-tambah-penulis', 'Terjadi kesalahan jaringan.'));
}

function openEditPenulis(id) {
  hideAlert('err-edit-penulis');
  fetch('ambil_satu_penulis.php?id=' + id)
    .then(r => r.json())
    .then(p => {
      document.getElementById('ep-id').value          = p.id;
      document.getElementById('ep-nama-depan').value  = p.nama_depan;
      document.getElementById('ep-nama-belakang').value = p.nama_belakang;
      document.getElementById('ep-username').value    = p.user_name;
      document.getElementById('ep-password').value    = '';
      document.getElementById('ep-foto').value        = '';
      openModal('modal-edit-penulis');
    });
}

function updatePenulis() {
  hideAlert('err-edit-penulis');
  const fd = new FormData();
  fd.append('id',            document.getElementById('ep-id').value);
  fd.append('nama_depan',    document.getElementById('ep-nama-depan').value.trim());
  fd.append('nama_belakang', document.getElementById('ep-nama-belakang').value.trim());
  fd.append('user_name',     document.getElementById('ep-username').value.trim());
  fd.append('password',      document.getElementById('ep-password').value);
  const foto = document.getElementById('ep-foto').files[0];
  if (foto) fd.append('foto', foto);

  fetch('update_penulis.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      if (res.status === 'success') { closeModal('modal-edit-penulis'); loadPenulis(); }
      else showAlert('err-edit-penulis', res.message);
    }).catch(() => showAlert('err-edit-penulis', 'Terjadi kesalahan jaringan.'));
}

function openHapusPenulis(id) {
  document.getElementById('hp-id').value = id;
  hideAlert('err-hapus-penulis');
  openModal('modal-hapus-penulis');
}

function hapusPenulis() {
  hideAlert('err-hapus-penulis');
  const fd = new FormData();
  fd.append('id', document.getElementById('hp-id').value);
  fetch('hapus_penulis.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      if (res.status === 'success') { closeModal('modal-hapus-penulis'); loadPenulis(); }
      else showAlert('err-hapus-penulis', res.message);
    }).catch(() => showAlert('err-hapus-penulis', 'Terjadi kesalahan jaringan.'));
}

/* ============================================================
   ██████  ARTIKEL
   ============================================================ */
function loadArtikel() {
  setContent('<div class="content-header"><h2>Data Artikel</h2><div></div></div><span class="spinner"></span>');
  fetch('ambil_artikel.php')
    .then(r => r.json())
    .then(data => renderArtikel(data))
    .catch(() => setContent('<p style="color:red;padding:20px">Gagal memuat data artikel.</p>'));
}

function renderArtikel(data) {
  let rows = '';
  if (data.length === 0) {
    rows = '<tr><td colspan="6" class="empty-msg">Belum ada data artikel.</td></tr>';
  } else {
    data.forEach(a => {
      const imgSrc = 'uploads_artikel/' + esc(a.gambar);
      rows += `
        <tr>
          <td><img src="${imgSrc}" class="foto-thumb-rect" onerror="this.src=''" alt="gambar"></td>
          <td>${esc(a.judul)}</td>
          <td><span class="badge">${esc(a.nama_kategori)}</span></td>
          <td>${esc(a.nama_penulis)}</td>
          <td class="tanggal-cell">${esc(a.hari_tanggal)}</td>
          <td>
            <div class="action-group">
              <button class="btn btn-warning btn-sm" onclick="openEditArtikel(${a.id})">Edit</button>
              <button class="btn btn-danger btn-sm" onclick="openHapusArtikel(${a.id})">Hapus</button>
            </div>
          </td>
        </tr>`;
    });
  }
  setContent(`
    <div class="content-header">
      <h2>Data Artikel</h2>
      <button class="btn btn-primary" onclick="openTambahArtikel()">+ Tambah Artikel</button>
    </div>
    <table>
      <thead><tr><th>GAMBAR</th><th>JUDUL</th><th>KATEGORI</th><th>PENULIS</th><th>TANGGAL</th><th>AKSI</th></tr></thead>
      <tbody>${rows}</tbody>
    </table>`);
}

function populateDropdowns(penulisSel, kategoriSel, selPenulis = '', selKategori = '') {
  return Promise.all([
    fetch('ambil_penulis.php').then(r => r.json()),
    fetch('ambil_kategori.php').then(r => r.json())
  ]).then(([penulis, kategori]) => {
    penulisSel.innerHTML = '<option value="">-- Pilih Penulis --</option>';
    penulis.forEach(p => {
      const opt = document.createElement('option');
      opt.value = p.id;
      opt.textContent = p.nama_depan + ' ' + p.nama_belakang;
      if (p.id == selPenulis) opt.selected = true;
      penulisSel.appendChild(opt);
    });
    kategoriSel.innerHTML = '<option value="">-- Pilih Kategori --</option>';
    kategori.forEach(k => {
      const opt = document.createElement('option');
      opt.value = k.id;
      opt.textContent = k.nama_kategori;
      if (k.id == selKategori) opt.selected = true;
      kategoriSel.appendChild(opt);
    });
  });
}

function openTambahArtikel() {
  document.getElementById('ta-judul').value = '';
  document.getElementById('ta-isi').value = '';
  document.getElementById('ta-gambar').value = '';
  hideAlert('err-tambah-artikel');
  populateDropdowns(
    document.getElementById('ta-penulis'),
    document.getElementById('ta-kategori')
  );
  openModal('modal-tambah-artikel');
}

function simpanArtikel() {
  hideAlert('err-tambah-artikel');
  const fd = new FormData();
  fd.append('judul',       document.getElementById('ta-judul').value.trim());
  fd.append('id_penulis',  document.getElementById('ta-penulis').value);
  fd.append('id_kategori', document.getElementById('ta-kategori').value);
  fd.append('isi',         document.getElementById('ta-isi').value.trim());
  const gambar = document.getElementById('ta-gambar').files[0];
  if (gambar) fd.append('gambar', gambar);

  fetch('simpan_artikel.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      if (res.status === 'success') { closeModal('modal-tambah-artikel'); loadArtikel(); }
      else showAlert('err-tambah-artikel', res.message);
    }).catch(() => showAlert('err-tambah-artikel', 'Terjadi kesalahan jaringan.'));
}

function openEditArtikel(id) {
  hideAlert('err-edit-artikel');
  fetch('ambil_satu_artikel.php?id=' + id)
    .then(r => r.json())
    .then(a => {
      document.getElementById('ea-id').value    = a.id;
      document.getElementById('ea-judul').value = a.judul;
      document.getElementById('ea-isi').value   = a.isi;
      document.getElementById('ea-gambar').value = '';
      populateDropdowns(
        document.getElementById('ea-penulis'),
        document.getElementById('ea-kategori'),
        a.id_penulis, a.id_kategori
      );
      openModal('modal-edit-artikel');
    });
}

function updateArtikel() {
  hideAlert('err-edit-artikel');
  const fd = new FormData();
  fd.append('id',          document.getElementById('ea-id').value);
  fd.append('judul',       document.getElementById('ea-judul').value.trim());
  fd.append('id_penulis',  document.getElementById('ea-penulis').value);
  fd.append('id_kategori', document.getElementById('ea-kategori').value);
  fd.append('isi',         document.getElementById('ea-isi').value.trim());
  const gambar = document.getElementById('ea-gambar').files[0];
  if (gambar) fd.append('gambar', gambar);

  fetch('update_artikel.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      if (res.status === 'success') { closeModal('modal-edit-artikel'); loadArtikel(); }
      else showAlert('err-edit-artikel', res.message);
    }).catch(() => showAlert('err-edit-artikel', 'Terjadi kesalahan jaringan.'));
}

function openHapusArtikel(id) {
  document.getElementById('ha-id').value = id;
  hideAlert('err-hapus-artikel');
  openModal('modal-hapus-artikel');
}

function hapusArtikel() {
  hideAlert('err-hapus-artikel');
  const fd = new FormData();
  fd.append('id', document.getElementById('ha-id').value);
  fetch('hapus_artikel.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      if (res.status === 'success') { closeModal('modal-hapus-artikel'); loadArtikel(); }
      else showAlert('err-hapus-artikel', res.message);
    }).catch(() => showAlert('err-hapus-artikel', 'Terjadi kesalahan jaringan.'));
}

/* ============================================================
   ██████  KATEGORI
   ============================================================ */
function loadKategori() {
  setContent('<div class="content-header"><h2>Data Kategori Artikel</h2><div></div></div><span class="spinner"></span>');
  fetch('ambil_kategori.php')
    .then(r => r.json())
    .then(data => renderKategori(data))
    .catch(() => setContent('<p style="color:red;padding:20px">Gagal memuat data kategori.</p>'));
}

function renderKategori(data) {
  let rows = '';
  if (data.length === 0) {
    rows = '<tr><td colspan="3" class="empty-msg">Belum ada data kategori.</td></tr>';
  } else {
    data.forEach(k => {
      rows += `
        <tr>
          <td><span class="badge">${esc(k.nama_kategori)}</span></td>
          <td>${esc(k.keterangan)}</td>
          <td>
            <div class="action-group">
              <button class="btn btn-warning btn-sm" onclick="openEditKategori(${k.id})">Edit</button>
              <button class="btn btn-danger btn-sm" onclick="openHapusKategori(${k.id})">Hapus</button>
            </div>
          </td>
        </tr>`;
    });
  }
  setContent(`
    <div class="content-header">
      <h2>Data Kategori Artikel</h2>
      <button class="btn btn-primary" onclick="openTambahKategori()">+ Tambah Kategori</button>
    </div>
    <table>
      <thead><tr><th>NAMA KATEGORI</th><th>KETERANGAN</th><th>AKSI</th></tr></thead>
      <tbody>${rows}</tbody>
    </table>`);
}

function openTambahKategori() {
  document.getElementById('tk-nama').value = '';
  document.getElementById('tk-keterangan').value = '';
  hideAlert('err-tambah-kategori');
  openModal('modal-tambah-kategori');
}

function simpanKategori() {
  hideAlert('err-tambah-kategori');
  const fd = new FormData();
  fd.append('nama_kategori', document.getElementById('tk-nama').value.trim());
  fd.append('keterangan',    document.getElementById('tk-keterangan').value.trim());
  fetch('simpan_kategori.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      if (res.status === 'success') { closeModal('modal-tambah-kategori'); loadKategori(); }
      else showAlert('err-tambah-kategori', res.message);
    }).catch(() => showAlert('err-tambah-kategori', 'Terjadi kesalahan jaringan.'));
}

function openEditKategori(id) {
  hideAlert('err-edit-kategori');
  fetch('ambil_satu_kategori.php?id=' + id)
    .then(r => r.json())
    .then(k => {
      document.getElementById('ek-id').value          = k.id;
      document.getElementById('ek-nama').value        = k.nama_kategori;
      document.getElementById('ek-keterangan').value  = k.keterangan;
      openModal('modal-edit-kategori');
    });
}

function updateKategori() {
  hideAlert('err-edit-kategori');
  const fd = new FormData();
  fd.append('id',            document.getElementById('ek-id').value);
  fd.append('nama_kategori', document.getElementById('ek-nama').value.trim());
  fd.append('keterangan',    document.getElementById('ek-keterangan').value.trim());
  fetch('update_kategori.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      if (res.status === 'success') { closeModal('modal-edit-kategori'); loadKategori(); }
      else showAlert('err-edit-kategori', res.message);
    }).catch(() => showAlert('err-edit-kategori', 'Terjadi kesalahan jaringan.'));
}

function openHapusKategori(id) {
  document.getElementById('hk-id').value = id;
  hideAlert('err-hapus-kategori');
  openModal('modal-hapus-kategori');
}

function hapusKategori() {
  hideAlert('err-hapus-kategori');
  const fd = new FormData();
  fd.append('id', document.getElementById('hk-id').value);
  fetch('hapus_kategori.php', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
      if (res.status === 'success') { closeModal('modal-hapus-kategori'); loadKategori(); }
      else showAlert('err-hapus-kategori', res.message);
    }).catch(() => showAlert('err-hapus-kategori', 'Terjadi kesalahan jaringan.'));
}
</script>
</body>
</html>
