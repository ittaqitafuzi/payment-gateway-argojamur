<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Agro Jamur Pabuwaran</title>
  <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>
<body>
  <header class="site-header">
    <div class="container header-inner">
      <img src="{{ asset('image/logo agro.png') }}" alt="Logo Agro" class="brand">
      <nav class="main-nav">
        <a href="#">Beranda</a>
        <a href="#produk">Produk</a>
        <a href="#tentang">Tentang Kami</a>
        <a href="{{ route('mushrooms.index') }}">Jenis Jamur</a>
        <a href="#kontak">Kontak</a>
        <a button class="btn-chart" href="/chart">Keranjang</a>
        <a button class="btn-login" href="/login">Masuk</a>
      </nav>
    </div>
  </header>

  <section class="hero">
    <div class="hero-overlay">
      <div class="container hero-content">
        <h1>AGRO JAMUR PABUWARAN</h1>
        <p class="lead">Agro Jamur adalah penyedia jamur segar berkualitas tinggi yang dipanen langsung dari budidaya modern dan higienis.</p>
        <a href="#produk" class="btn-cta">Lihat Jamur</a>
      </div>
    </div>
    <img src="{{ asset('image/background fix.jpg') }}" alt="Kebun Jamur" class="backgpround fix">
  </section>

  <main class="container">
    <section id="why" class="why">
      <img src="{{ asset('image/logo agro.png') }}" class="why-logo" alt="Logo">
      <h2>Mengapa Memilih Agro Jamur Pabuwaran?</h2>
      <p class="why-lead">Jamur kami dibudidayakan dengan teknologi modern dan standar kebersihan tinggi.</p>

      <div class="why-grid">
        <div class="card-small">
          <h3>100% Organik & Alami</h3>
          <p>Dibudidayakan tanpa pestisida dan bahan kimia berbahaya.</p>
        </div>
        <div class="card-small">
          <h3>Kualitas Terjamin & Bersertifikat</h3>
          <p>Memiliki sertifikat BPOM dan Halal MUI untuk setiap batch.</p>
        </div>
        <div class="card-small">
          <h3>Segar Langsung dari Kebun</h3>
          <p>Dipanen setiap hari dan langsung dikirim agar tetap segar.</p>
        </div>
        <div class="card-small">
          <h3>Tinggi Protein & Nutrisi</h3>
          <p>Kaya akan protein nabati, serat, dan vitamin.</p>
        </div>
      </div>
    </section>

    <section id="produk" class="products">
      <h2>Produk Unggulan Kami</h2>
      <p class="sub">Jamur Segar Pilihan Langsung dari Kebun Pabuwaran</p>

      <div class="products-grid">
        @forelse($produkList as $p)
        <article class="product">
          <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->nama }}"
               onerror="this.src='{{ asset('image/logo agro.png') }}'">
          <h4>{{ $p->nama }}</h4>
          <p>{{ $p->harga_formatted }} / kg</p>
          <p style="font-size:0.8rem;color:#888;">Stok: {{ $p->stok }}</p>
          <button class="product-btn" onclick="openBuyNow({{ $p->id }}, '{{ $p->nama }}', {{ $p->harga }}, {{ $p->stok }})">
            BUY NOW
          </button>
        </article>
        @empty
        <p style="text-align:center;color:#888;grid-column:1/-1;">Belum ada produk tersedia.</p>
        @endforelse
      </div>
    </section>

    <section class="testimonials">
      <h2>Hasil Nyata, Orang Nyata. Baca Cerita Mereka.</h2>
      <div class="test-grid">
        <div class="test-card">Jamur Kancing Fresh - pelanggan puas</div>
        <div class="test-card">Jamur Kuping Premium - testimoni</div>
        <div class="test-card">Jamur Tiram Putih Fresh - cerita</div>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container footer-inner">
      <div class="brand-foot">
        <img src="{{ asset('image/logo agro.png') }}" alt="Logo" class="brand-small">
        <p>Agro Jamur Pabuwaran</p>
      </div>
      <div class="footer-links">
        <p>Kontak kami</p>
        <p>0821-xxxx-xxxx</p>
      </div>
    </div>
  </footer>

  <!-- ===== MODAL BUY NOW ===== -->
  <div id="buyNowModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.55);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:white;border-radius:20px;padding:36px;max-width:460px;width:92%;box-shadow:0 20px 60px rgba(0,0,0,0.3);position:relative;">
      <button onclick="closeBuyNow()" style="position:absolute;top:14px;right:18px;background:none;border:none;font-size:1.5rem;cursor:pointer;color:#666;line-height:1;">✕</button>

      <h3 style="font-size:1.25rem;font-weight:800;color:#1b4332;margin:0 0 4px;">🛒 Beli Sekarang</h3>
      <p id="modalProdukNama" style="color:#52b788;font-weight:600;margin:0 0 20px;font-size:0.95rem;"></p>

      <form id="buyNowForm" action="/pesanan/buy-now" method="POST">
        @csrf
        <input type="hidden" name="produk_id" id="modalProdukId">
        <input type="hidden" name="jumlah" id="formJumlah" value="1">

        <!-- Jumlah -->
        <div style="margin-bottom:16px;">
          <label style="display:block;font-weight:700;color:#333;margin-bottom:8px;font-size:0.9rem;">Jumlah</label>
          <div style="display:flex;align-items:center;gap:14px;">
            <button type="button" onclick="modalDecr()" style="width:38px;height:38px;border-radius:10px;border:2px solid #52b788;background:white;font-size:1.2rem;font-weight:700;cursor:pointer;color:#2d6a4f;">−</button>
            <span id="modalQtyDisplay" style="font-size:1.3rem;font-weight:800;color:#1b4332;min-width:28px;text-align:center;">1</span>
            <button type="button" onclick="modalIncr()" style="width:38px;height:38px;border-radius:10px;border:2px solid #52b788;background:white;font-size:1.2rem;font-weight:700;cursor:pointer;color:#2d6a4f;">+</button>
            <span id="modalStokInfo" style="color:#aaa;font-size:0.82rem;"></span>
          </div>
        </div>

        <!-- Alamat -->
        <div style="margin-bottom:20px;">
          <label style="display:block;font-weight:700;color:#333;margin-bottom:8px;font-size:0.9rem;">📍 Alamat Pengiriman</label>
          <textarea name="alamat_pengiriman" rows="3" required placeholder="Masukkan alamat lengkap..."
            style="width:100%;border:2px solid #e0e0e0;border-radius:10px;padding:12px;font-size:0.88rem;resize:none;outline:none;box-sizing:border-box;"
            onfocus="this.style.borderColor='#52b788'" onblur="this.style.borderColor='#e0e0e0'"></textarea>
        </div>

        <!-- Total -->
        <div style="background:#d8f3dc;border-radius:12px;padding:12px 18px;display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
          <span style="font-weight:700;color:#2d6a4f;font-size:0.9rem;">Total Bayar</span>
          <span id="modalTotal" style="font-weight:800;color:#1b4332;font-size:1.1rem;"></span>
        </div>

        <!-- Submit -->
        <button type="submit"
          style="width:100%;padding:14px;background:linear-gradient(135deg,#2d6a4f,#52b788);color:white;border:none;border-radius:12px;font-size:1rem;font-weight:700;cursor:pointer;box-shadow:0 4px 15px rgba(45,106,79,0.4);transition:0.3s;"
          onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
          💳 Lanjut ke Pembayaran
        </button>
      </form>
    </div>
  </div>

  <script>
    let modalHarga = 0;
    let modalQty   = 1;
    let modalMaxQty = 1;

    function openBuyNow(id, nama, harga, stok) {
      modalHarga  = harga;
      modalQty    = 1;
      modalMaxQty = stok;
      document.getElementById('modalProdukId').value       = id;
      document.getElementById('modalProdukNama').textContent = nama;
      document.getElementById('modalStokInfo').textContent  = 'Stok: ' + stok;
      document.getElementById('modalQtyDisplay').textContent = 1;
      document.getElementById('formJumlah').value            = 1;
      updateTotal();
      const m = document.getElementById('buyNowModal');
      m.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    }

    function closeBuyNow() {
      document.getElementById('buyNowModal').style.display = 'none';
      document.body.style.overflow = '';
    }

    function modalIncr() {
      if (modalQty < modalMaxQty) {
        modalQty++;
        document.getElementById('modalQtyDisplay').textContent = modalQty;
        document.getElementById('formJumlah').value = modalQty;
        updateTotal();
      }
    }

    function modalDecr() {
      if (modalQty > 1) {
        modalQty--;
        document.getElementById('modalQtyDisplay').textContent = modalQty;
        document.getElementById('formJumlah').value = modalQty;
        updateTotal();
      }
    }

    function updateTotal() {
      const total = modalQty * modalHarga;
      document.getElementById('modalTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    // Tutup jika klik luar modal
    document.getElementById('buyNowModal').addEventListener('click', function(e) {
      if (e.target === this) closeBuyNow();
    });
  </script>
</body>
</html>
