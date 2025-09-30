<?php
// detail_mahasiswa.php
include '../admin/db.php';

// Ambil ID mahasiswa dari parameter URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mendapatkan data mahasiswa
$query = "SELECT * FROM mahasiswa WHERE id = $id";
$result = mysqli_query($conn, $query);
$mahasiswa = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan
if (!$mahasiswa) {
    header("Location: mahasiswa.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Mahasiswa - Universitas Muhammadiyah Bima</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <style>
        /* Tambahan CSS khusus untuk halaman detail */
        .main-content {
            padding: 20px;
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .back-button {
            display: inline-block;
            padding: 8px 15px;
            background-color: #1a5276;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .back-button:hover {
            background-color: #154360;
        }
        
        .detail-container {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .photo-section {
            flex: 0 0 250px;
            text-align: center;
        }
        
        .student-photo {
            width: 200px;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
            border: 3px solid #1a5276;
            margin-bottom: 15px;
        }
        
        .info-section {
            flex: 1;
        }
        
        .detail-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 20px;
        }
        
        .detail-title {
            color: #1a5276;
            margin-bottom: 20px;
            font-size: 20px;
            border-bottom: 2px solid #1a5276;
            padding-bottom: 10px;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 15px;
        }
        
        .detail-label {
            flex: 0 0 200px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .detail-value {
            flex: 1;
            color: #34495e;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">
            <img alt="Universitas Muhammadiyah Bima" height="40" src="../img/logo.jpg" width="40"/>
            <span>UNIVERSITAS MUHAMMADIYAH BIMA</span>
        </div>
        <div class="nav">
            <a href="../index.php">
                <i class="fas fa-home"></i> Home
            </a>
            <a href="mahasiswa.php">
                <i class="fas fa-user-graduate"></i> Data Mahasiswa
            </a>
            <a href="dosen.php">
                <i class="fas fa-chalkboard-teacher"></i> Data Dosen
            </a>
            <a href="../admin/login.php">
                <i class="fas fa-user-shield"></i> Admin
            </a>
        </div>
        <div class="search-box">
            <input type="text" placeholder="Cari..." id="searchInput">
            <button type="button" onclick="searchData()">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="main-content">
        <a href="mahasiswa.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Mahasiswa
        </a>
        
        <h1><i class="fas fa-user-graduate"></i> Detail Mahasiswa</h1>
        
        <div class="detail-container">
            <div class="photo-section">
                <img src="../uploads/mahasiswa/<?php echo $mahasiswa['foto'] ?: 'default.jpg'; ?>" alt="Foto Mahasiswa" class="student-photo">
                <div class="status-badge status-<?php echo strtolower($mahasiswa['status']); ?>">
                    <?php echo $mahasiswa['status']; ?>
                </div>
            </div>
            
            <div class="info-section">
                <div class="detail-card">
                    <h3 class="detail-title">Informasi Pribadi</h3>
                    
                    <div class="detail-row">
                        <div class="detail-label">NIM</div>
                        <div class="detail-value"><?php echo $mahasiswa['nim']; ?></div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-label">Nama Lengkap</div>
                        <div class="detail-value"><?php echo $mahasiswa['nama_lengkap']; ?></div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-label">Jenis Kelamin</div>
                        <div class="detail-value"><?php echo $mahasiswa['jenis_kelamin']; ?></div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-label">Tempat, Tanggal Lahir</div>
                        <div class="detail-value">
                            <?php echo $mahasiswa['tempat_lahir']; ?>, <?php echo date('d F Y', strtotime($mahasiswa['tanggal_lahir'])); ?>
                        </div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-label">Alamat</div>
                        <div class="detail-value"><?php echo $mahasiswa['alamat']; ?></div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-label">No. Telepon</div>
                        <div class="detail-value"><?php echo $mahasiswa['no_telepon']; ?></div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-label">Email</div>
                        <div class="detail-value"><?php echo $mahasiswa['email']; ?></div>
                    </div>
                </div>
                
                <div class="detail-card">
                    <h3 class="detail-title">Informasi Akademik</h3>
                    
                    <div class="detail-row">
                        <div class="detail-label">Program Studi</div>
                        <div class="detail-value"><?php echo $mahasiswa['program_studi']; ?></div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-label">Angkatan</div>
                        <div class="detail-value"><?php echo $mahasiswa['angkatan']; ?></div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            <span class="status-badge status-<?php echo strtolower($mahasiswa['status']); ?>">
                                <?php echo $mahasiswa['status']; ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-label">Tanggal Registrasi</div>
                        <div class="detail-value">
                            <?php echo date('d F Y H:i', strtotime($mahasiswa['created_at'])); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function searchData() {
            const searchValue = document.getElementById("searchInput").value.toLowerCase();
            if (searchValue) {
                window.location.href = "mahasiswa.php?search=" + encodeURIComponent(searchValue);
            }
        }
    </script>
</body>
</html>