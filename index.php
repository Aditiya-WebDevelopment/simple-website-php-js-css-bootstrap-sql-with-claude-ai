<!DOCTYPE html>
<html>

<head>
    <title>UNISKA - Penerimaan Mahasiswa Baru</title>
    <link href="css/index.css" rel="stylesheet">

    <!-- <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #FFFFFF;
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            line-height: 1.6;
        }

        /* Header Navigation */
        .header-nav {
            background: #FFFFFF;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            animation: slideInDown 0.8s ease-out;
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            animation: logoGlow 2s ease-in-out infinite alternate;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #000040 0%, #0000AA 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
            box-shadow: 0 4px 15px rgba(0, 0, 64, 0.3);
        }

        .logo-text {
            color: #000040;
            font-size: 1.5rem;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        @keyframes logoGlow {
            from { transform: scale(1); }
            to { transform: scale(1.05); }
        }

        /* Navigation Menu */
        ul {
            display: flex;
            align-items: center;
            animation: slideInLeft 1s ease-out 0.3s both;
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        li {
            list-style: none;
            margin: 0 8px;
        }

        a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 0, 64, 0.1), transparent);
            transition: left 0.5s;
        }

        a:hover::before {
            left: 100%;
        }

        a:hover {
            color: #000040;
            background: rgba(0, 0, 64, 0.05);
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            min-height: 80vh;
        }

        .content-left {
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .breadcrumb {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 20px;
            animation: slideInRight 0.8s ease-out 0.8s both;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(-50px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .breadcrumb::before {
            content: "🏠";
            margin-right: 8px;
        }

        .main-title {
            font-size: 3.5rem;
            color: #333;
            font-weight: bold;
            margin-bottom: 30px;
            line-height: 1.2;
            animation: typeWriter 2s ease-out 1s both;
        }

        @keyframes typeWriter {
            from {
                width: 0;
                opacity: 0;
            }
            to {
                width: 100%;
                opacity: 1;
            }
        }

        .highlight {
            color: #3498db;
            background: linear-gradient(135deg, #3498db, #2980b9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 3s ease-in-out infinite;
        }

        @keyframes gradientShift {
            0%, 100% { filter: hue-rotate(0deg); }
            50% { filter: hue-rotate(20deg); }
        }

        .subtitle {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 40px;
            animation: fadeIn 1s ease-out 1.5s both;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .marquee-modern {
            background: linear-gradient(135deg, #000040 0%, #0000AA 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 25px;
            font-weight: bold;
            box-shadow: 0 8px 25px rgba(0, 0, 64, 0.3);
            animation: pulse 2s ease-in-out infinite, slideInLeft 1s ease-out 2s both;
            overflow: hidden;
            position: relative;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }

        .marquee-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: shine 3s linear infinite;
        }

        @keyframes shine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .marquee-text {
            animation: scroll 15s linear infinite;
        }

        @keyframes scroll {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        /* Right Content */
        .content-right {
            animation: fadeInUp 1s ease-out 0.8s both;
        }

        .image-container {
            position: relative;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .image-container img {
            width: 100%;
            max-width: 400px;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .image-container img:hover {
            transform: scale(1.05) rotate(1deg);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        /* Placeholder images */
        .placeholder-img {
            background: linear-gradient(135deg, #000040 0%, #0000AA 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            text-align: center;
        }

        /* Decorative Elements */
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: -1;
        }

        .shape {
            position: absolute;
            background: rgba(0, 0, 64, 0.05);
            border-radius: 50%;
            animation: floatShapes 20s linear infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 15%;
            animation-delay: -5s;
        }

        .shape:nth-child(3) {
            width: 40px;
            height: 40px;
            top: 80%;
            left: 70%;
            animation-delay: -10s;
        }

        @keyframes floatShapes {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg);
                opacity: 0.3;
            }
            50% { 
                transform: translateY(-30px) rotate(180deg);
                opacity: 0.8;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 20px;
            }
            
            ul {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .main-content {
                grid-template-columns: 1fr;
                gap: 40px;
                padding: 40px 20px;
            }
            
            .main-title {
                font-size: 2.5rem;
            }
            
            .image-container {
                padding: 20px;
            }
        }
    </style> -->
</head>

<body>
    <!-- Floating Shapes Background -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Header Navigation -->
    <header class="header-nav">
        <div class="nav-container">
            <div class="logo">
                <div class="logo-icon">U</div>
                <div class="logo-text">UNISKA</div>
            </div>
            
            <ul id="menu">
                <li><a href="index.php">HOME</a></li>
                <li><a href="data_pendaftar.php">PENDAFTARAN</a></li>
                <li><a href="jurusan.php">JURUSAN</a></li>
                <li><a href="jadwal.php">JADWAL</a></li>
                <li><a href="pendaftaran_pkl.php">PENDAFTARAN PKL</a></li>
                <li><a href="ukm_band.php">UKM BAND</a></li>
                <li><a href="pramuka.php">PRAMUKA</a></li>
            </ul>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-left">
            <div class="breadcrumb">Tahun Akademik 2024/2025</div>
            
            <h1 class="main-title">
                Selamat Datang di
                <span class="highlight">Fortal Akademik</span>
                Universitas Islam Kalimantan Arsyad Al-Banjari
            </h1>
            
            <p class="subtitle">
                Bagi mahasiswa yang memiliki prestasi baik dibidang akademik maupun nonakademik dapat menginputkan datanya ke sistem yang nantinya akan digunakan sebagai dasar pembuatan Surat Keterangan Pendamping Ijasah (SKPI).
            </p>
            
            <div class="marquee-modern">
                <div class="marquee-text">
                    🎓 Penerimaan Mahasiswa Baru Tahun Akademik 2024/2025 🎓
                </div>
            </div>
        </div>
        
        <div class="content-right">
            <div class="image-container">
                <img src="library/download.jpeg" alt="UNISKA Campus" class="placeholder-img" 
                     onerror="this.innerHTML='UNISKA<br>CAMPUS'; this.style.display='flex';">
                <img src="library/images.jpg" alt="UNISKA Logo" class="placeholder-img"
                     onerror="this.innerHTML='UNISKA<br>LOGO'; this.style.display='flex';">
            </div>
        </div>
    </main>
</body>

</html>