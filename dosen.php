<?php
// dosen.php
include '../admin/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Dosen - Universitas Muhammadiyah Bima</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <style>
        /* Tambahan CSS khusus untuk halaman dosen */
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
            flex-wrap: wrap;
        }
        
        .search-box {
            flex-grow: 1;
            min-width: 250px;
        }
        
        .filter-select {
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: white;
        }
        
        .lecturers-table td:last-child {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
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
            color: #154360;
        }
        
        .pagination a:hover {
            background-color: #154360;
            color: white;
        }
        
        .pagination .active {
            background-color: #154360;
            color: white;
            border-color: #154360;
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
            <a href="dosen.php" class="active">
                <i class="fas fa-chalkboard-teacher"></i> Data Dosen
            </a>
            <a href="../admin/login.php">
                <i class="fas fa-user-shield"></i> Admin
            </a>
        </div>
        <div class="search-box">
            <input type="text" placeholder="Cari dosen..." id="searchInput">
            <button type="button" onclick="searchDosen()">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="main-content">
        <div class="page-header">
            <h1><i class="fas fa-chalkboard-teacher"></i> Data Dosen</h1>
        </div>
        
        <div class="search-filter">
            <div class="search-box">
                <input type="text" placeholder="Cari berdasarkan nama/NIDN..." id="tableSearch">
                <button type="button" onclick="filterTable()"><i class="fas fa-search"></i></button>
            </div>
            <select class="filter-select" id="prodiFilter">
                <option value="">Semua Prodi</option>
                <option value="Ilmu Komputer">Ilmu Komputer</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
                <option value="Teknik Komputer">Teknik Komputer</option>
            </select>
            <select class="filter-select" id="pendidikanFilter">
                <option value="">Semua Pendidikan</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
            </select>
        </div>
        
        <div class="lecturers-section">
            <div class="lecturers-table-container">
                <table class="lecturers-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIDN</th>
                            <th>Nama Lengkap</th>
                            <th>Program Studi</th>
                            <th>Pendidikan</th>
                            <th>Jabatan</th>
                            <th>Bidang Keahlian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM dosen";
                        $result = mysqli_query($conn, $sql);
                        $no = 1;
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nidn']}</td>
                                <td>{$row['nama_lengkap']}</td>
                                <td>{$row['program_studi']}</td>
                                <td>{$row['pendidikan_terakhir']}</td>
                                <td>{$row['jabatan']}</td>
                                <td>{$row['bidang_keahlian']}</td>
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
            const table = document.querySelector(".lecturers-table");
            const tr = table.getElementsByTagName("tr");
            
            for (let i = 1; i < tr.length; i++) {
                const tdNidn = tr[i].getElementsByTagName("td")[1];
                const tdNama = tr[i].getElementsByTagName("td")[2];
                
                if (tdNidn && tdNama) {
                    const txtValueNidn = tdNidn.textContent || tdNidn.innerText;
                    const txtValueNama = tdNama.textContent || tdNama.innerText;
                    
                    if (txtValueNidn.toUpperCase().indexOf(filter) > -1 || 
                        txtValueNama.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        
        // Filter berdasarkan prodi dan pendidikan
        document.getElementById("prodiFilter").addEventListener("change", function() {
            filterAll();
        });
        
        document.getElementById("pendidikanFilter").addEventListener("change", function() {
            filterAll();
        });
        
        function filterAll() {
            const prodiFilter = document.getElementById("prodiFilter").value.toUpperCase();
            const pendidikanFilter = document.getElementById("pendidikanFilter").value.toUpperCase();
            const searchFilter = document.getElementById("tableSearch").value.toUpperCase();
            const table = document.querySelector(".lecturers-table");
            const tr = table.getElementsByTagName("tr");
            
            for (let i = 1; i < tr.length; i++) {
                const tdProdi = tr[i].getElementsByTagName("td")[3];
                const tdPendidikan = tr[i].getElementsByTagName("td")[4];
                const tdNidn = tr[i].getElementsByTagName("td")[1];
                const tdNama = tr[i].getElementsByTagName("td")[2];
                
                if (tdProdi && tdPendidikan) {
                    const txtValueProdi = tdProdi.textContent || tdProdi.innerText;
                    const txtValuePendidikan = tdPendidikan.textContent || tdPendidikan.innerText;
                    const txtValueNidn = tdNidn.textContent || tdNidn.innerText;
                    const txtValueNama = tdNama.textContent || tdNama.innerText;
                    
                    const prodiMatch = prodiFilter === "" || txtValueProdi.toUpperCase() === prodiFilter;
                    const pendidikanMatch = pendidikanFilter === "" || txtValuePendidikan.toUpperCase() === pendidikanFilter;
                    const searchMatch = searchFilter === "" || 
                                     txtValueNidn.toUpperCase().includes(searchFilter) || 
                                     txtValueNama.toUpperCase().includes(searchFilter);
                    
                    if (prodiMatch && pendidikanMatch && searchMatch) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        
        function searchDosen() {
            const searchValue = document.getElementById("searchInput").value.toLowerCase();
            if (searchValue) {
                window.location.href = "dosen.php?search=" + encodeURIComponent(searchValue);
            }
        }
    </script>
</body>
</html>