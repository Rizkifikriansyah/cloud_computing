<?php
// mahasiswa.php
include '../admin/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa - Universitas Muhammadiyah Bima</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <style>
        /* Tambahan CSS khusus untuk halaman mahasiswa */
        .main-content {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .search-filter {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .search-box {
            flex-grow: 1;
        }
        
        .filter-select {
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 5px;
        }
        
        .pagination a, .pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #1a5276;
        }
        
        .pagination a:hover {
            background-color: #1a5276;
            color: white;
        }
        
        .pagination .active {
            background-color: #1a5276;
            color: white;
            border-color: #1a5276;
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
            <a href="mahasiswa.php" class="active">
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
            <input type="text" placeholder="Cari mahasiswa..." id="searchInput">
            <button type="button" onclick="searchMahasiswa()">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="main-content">
        <div class="page-header">
            <h1><i class="fas fa-user-graduate"></i> Data Mahasiswa</h1>
            <div>
                <span class="btn" onclick="printData()"><i class="fas fa-print"></i> Cetak</span>
            </div>
        </div>
        
        <div class="search-filter">
            <div class="search-box">
                <input type="text" placeholder="Cari berdasarkan nama/NIM..." id="tableSearch">
                <button type="button" onclick="filterTable()"><i class="fas fa-search"></i></button>
            </div>
            <select class="filter-select" id="prodiFilter">
                <option value="">Semua Prodi</option>
                <option value="Ilmu Komputer">Ilmu Komputer</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
                <option value="Teknik Komputer">Teknik Komputer</option>
                <option value="Manajemen Informatika">Manajemen Informatika</option>
                <option value="Komputerisasi Akuntansi">Komputerisasi Akuntansi</option>
            </select>
            <select class="filter-select" id="statusFilter">
                <option value="">Semua Status</option>
                <option value="Aktif">Aktif</option>
                <option value="Cuti">Cuti</option>
                <option value="Lulus">Lulus</option>
                <option value="Keluar">Keluar</option>
            </select>
        </div>
        
        <div class="students-section">
            <div class="students-table-container">
                <table class="students-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM mahasiswa";
                        $result = mysqli_query($conn, $sql);
                        $no = 1;
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nim']}</td>
                                <td>{$row['nama_lengkap']}</td>
                                <td>{$row['program_studi']}</td>
                                <td>{$row['angkatan']}</td>
                                <td>
                                    <span class='status-badge status-".strtolower($row['status'])."'>
                                        {$row['status']}
                                    </span>
                                </td>
                                <td>
                                    <a href='detail_mahasiswa.php?id={$row['id']}' class='btn-action' title='Detail'>
                                        <i class='fas fa-eye'></i>
                                    </a>
                                    <a href='edit_mahasiswa.php?id={$row['id']}' class='btn-action' title='Edit'>
                                        <i class='fas fa-edit'></i>
                                    </a>
                                </td>
                            </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <div class="pagination">
                <a href="#">&laquo;</a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">&raquo;</a>
            </div>
        </div>
    </div>

    <script>
        function filterTable() {
            const input = document.getElementById("tableSearch");
            const filter = input.value.toUpperCase();
            const table = document.querySelector(".students-table");
            const tr = table.getElementsByTagName("tr");
            
            for (let i = 1; i < tr.length; i++) {
                const tdNim = tr[i].getElementsByTagName("td")[1];
                const tdNama = tr[i].getElementsByTagName("td")[2];
                
                if (tdNim && tdNama) {
                    const txtValueNim = tdNim.textContent || tdNim.innerText;
                    const txtValueNama = tdNama.textContent || tdNama.innerText;
                    
                    if (txtValueNim.toUpperCase().indexOf(filter) > -1 || 
                        txtValueNama.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        
        function printData() {
            window.print();
        }
        
        // Filter berdasarkan prodi dan status
        document.getElementById("prodiFilter").addEventListener("change", function() {
            filterAll();
        });
        
        document.getElementById("statusFilter").addEventListener("change", function() {
            filterAll();
        });
        
        function filterAll() {
            const prodiFilter = document.getElementById("prodiFilter").value.toUpperCase();
            const statusFilter = document.getElementById("statusFilter").value.toUpperCase();
            const searchFilter = document.getElementById("tableSearch").value.toUpperCase();
            const table = document.querySelector(".students-table");
            const tr = table.getElementsByTagName("tr");
            
            for (let i = 1; i < tr.length; i++) {
                const tdProdi = tr[i].getElementsByTagName("td")[3];
                const tdStatus = tr[i].getElementsByTagName("td")[5];
                const tdNim = tr[i].getElementsByTagName("td")[1];
                const tdNama = tr[i].getElementsByTagName("td")[2];
                
                if (tdProdi && tdStatus) {
                    const txtValueProdi = tdProdi.textContent || tdProdi.innerText;
                    const txtValueStatus = tdStatus.textContent || tdStatus.innerText;
                    const txtValueNim = tdNim.textContent || tdNim.innerText;
                    const txtValueNama = tdNama.textContent || tdNama.innerText;
                    
                    const prodiMatch = prodiFilter === "" || txtValueProdi.toUpperCase() === prodiFilter;
                    const statusMatch = statusFilter === "" || txtValueStatus.toUpperCase() === statusFilter;
                    const searchMatch = searchFilter === "" || 
                                       txtValueNim.toUpperCase().includes(searchFilter) || 
                                       txtValueNama.toUpperCase().includes(searchFilter);
                    
                    if (prodiMatch && statusMatch && searchMatch) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>