<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agro Jamur Pabuwaran - Tentang Kami</title>
    <link rel="stylesheet" href="{{ asset('css/tentangkami.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('image/logo agro.png') }}" alt="Logo">
        </div>
        <ul class="nav-menu">
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="#produk">Produk</a></li>
            <li><a href="#tentang">Tentang Kami</a></li>
            <li><a href="#kontak">Kontak</a></li>
        </ul>
        <div class="nav-actions">
            <a href="#" class="cart-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                    <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                </svg>
            </a>
            <button class="login-btn">Login</button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>TENTANG KAMI</h1>
            <h2>AGRO JAMUR PABUWARAN</h2>
            <p>Kami adalah usaha agro jamur yang berfokus pada budidaya jamur segar berkualitas dengan proses higienis dan ramah lingkungan. Setiap tahap produksi kami lakukan secara terkontrol untuk menghasilkan jamur yang sehat, bergizi, dan siap konsumsi. Ini adalah cara kami untuk mendapatkan jamur dengan kualitas terbaik!</p>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process-section">
        <div class="container">
            <div class="process-grid">
                <!-- Pembibitan Jamur -->
                <div class="process-item">
                    <div class="process-image">
                        <img src="image/pembibitan.jpeg" alt="Pembibitan Jamur">
                    </div>
                    <div class="process-text">
                        <h3>Pembibitan Jamur</h3>
                        <p>Proses pembiblitan jamur dilakukan menggunakan bibit unggul dalam kondisi steril. Tahap ini menjadi awal penting untuk menghasilkan jamur yang sehat dan berkualitas.</p>
                    </div>
                </div>

                <!-- Pengepakan Baglog -->
                <div class="process-item">
                    <div class="process-image">
                        <img src="image/pengepakan.jpeg" alt="Pengepakan Baglog">
                    </div>
                    <div class="process-text">
                        <h3>Pengepakan Baglog</h3>
                        <p>Baglog yang telah siap kemudian dikemas dengan rapi dan higienis. Pengemasan dilakukan agar baglog mudah didistribusikan dan siap digunakan.</p>
                    </div>
                </div>

                <!-- Sterilisasi Baglog -->
                <div class="process-item">
                    <div class="process-image">
                        <img src="image/sterilisasi.jpeg" alt="Sterilisasi Baglog">
                    </div>
                    <div class="process-text">
                        <h3>Sterilisasi Baglog</h3>
                        <p>Baglog disterilisasi melalui suhu tinggi untuk menghilangkan bakteri dan jamur pengganggu. Proses ini menjaga media tanam tetap bersih dan aman.</p>
                    </div>
                </div>

                <!-- Jamur Mulai Tumbuh -->
                <div class="process-item">
                    <div class="process-image">
                        <img src="image/jamurt.jpeg" alt="Jamur Mulai Tumbuh">
                    </div>
                    <div class="process-text">
                        <h3>Jamur Mulai Tumbuh</h3>
                        <p>Jamur mulai tumbuh dari baglog dalam kondisi lingkungan yang terkontrol. Kelembapan dan sirkulasi udara dijaga agar pertumbuhan optimal.</p>
                    </div>
                </div>

                <!-- Panen Jamur -->
                <div class="process-item">
                    <div class="process-image">
                        <img src="image/panen.jpeg" alt="Panen Jamur">
                    </div>
                    <div class="process-text">
                        <h3>Panen Jamur</h3>
                        <p>Jamur dipanen pada waktu yang tepat untuk menjaga kualitas dan kesegarannya. Proses panen dilakukan secara hati-hati agar jamur tidak rusak.</p>
                    </div>
                </div>

                <!-- Pengemasan Jamur -->
                <div class="process-item">
                    <div class="process-image">
                        <img src="image/pengemasan.jpeg" alt="Pengemasan Jamur">
                    </div>
                    <div class="process-text">
                        <h3>Pengemasan Jamur</h3>
                        <p>Jamur segar dikemas dengan baik untuk menjaga kebersihan dan kualitas produk. Setelah itu, jamur siap diantar ke konsumen.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Tertarik Coba Jamur Dengan Kualitas Terbaik?</h2>
            <div class="mushroom-image">
                <img src="image/tiram putih.png" alt="Jamur Tiram">
            </div>
            <a href="#" class="cta-button">
                beli sekarang
                <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
                    <path d="M7 7h10v2H7zm0 4h10v2H7z"/>
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                </svg>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-left">
                    <div class="footer-logo">
                        <img src="{{ asset('image/logo agro.png') }}" alt="Logo">
                    </div>
                    <div class="footer-info">
                        <h3>Agro Jamur Pabuwaran</h3>
                        <p><strong>Marketing :</strong> Jl. Gn. Merapi No.RT. 02/ 02, Pabuwaran, Pabuwaran, Kec. Purwokerto Utara, Kabupaten Banyumas, Jawa Tengah, Indonesia</p>
                        <p><strong>Operational :</strong> Jl. Raya Pabuwaran-Purwanegara, Purwokerto Timur, Kabupaten Banyumas, Jawa Tengah, Indonesia</p>
                    </div>
                </div>
                <div class="footer-right">
                    <h3>Kontak Kami</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                            <span>0821-3848-7484</span>
                        </div>
                        <div class="contact-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
                                <path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8 1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3z"/>
                            </svg>
                            <span>@agrojamurpabuwaran</span>
                        </div>
                        <div class="contact-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
                                <path d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z"/>
                            </svg>
                            <span>@agrojamur</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 Agro Jamur Pabuwaran. Hak Cipta Dilindungi Oleh Telkom University Purwokerto</p>
        </div>
    </footer>
</body>
</html>