<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Kuliah - Universitas Muhammadiyah Bima</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }
        
        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
            background-color: #fff;
            box-shadow: none;
            border-bottom: 2px solid #3498db;
        }
        
        .title {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }
        
        .title span {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
        }
        
        /* Hide navigation for print */
        .nav {
            display: none;
        }
        
        .full-schedule {
            padding: 1rem;
            max-width: 100%;
            margin: 0 auto;
        }
        
        .schedule-title {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #3498db;
        }
        
        .text-center {
            text-align: center;
            margin-bottom: 1rem;
        }
        
        /* Hide filters when printing */
        @media print {
            .schedule-filter, .back-btn {
                display: none !important;
            }
            
            .full-schedule {
                padding: 0;
            }
            
            .schedule-table-full {
                font-size: 11pt;
            }
            
            .schedule-table-full th {
                background-color: #3498db !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .badge-day {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
        
        .schedule-filter {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .filter-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .filter-group label {
            font-weight: bold;
        }
        
        .filter-group select, 
        .filter-group input {
            padding: 0.5rem;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        
        .btn-print {
            background-color: #2c3e50;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-print:hover {
            background-color: #1a252f;
        }
        
        .schedule-table-full {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }
        
        .schedule-table-full table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .schedule-table-full th {
            background-color: #3498db;
            color: white;
            padding: 0.7rem;
            text-align: left;
            border: 1px solid #ddd;
        }
        
        .schedule-table-full td {
            padding: 0.6rem;
            border: 1px solid #ddd;
        }
        
        .badge-day {
            display: inline-block;
            padding: 0.2rem 0.5rem;
            border-radius: 3px;
            font-size: 0.8rem;
            font-weight: bold;
            color: white;
        }
        
        .badge-senin { background-color: #3498db; }
        .badge-selasa { background-color: #2ecc71; }
        .badge-rabu { background-color: #f39c12; }
        .badge-kamis { background-color: #9b59b6; }
        .badge-jumat { background-color: #e74c3c; }
        .badge-sabtu { background-color: #1abc9c; }
        .badge-minggu { background-color: #7f8c8d; }
        
        .back-btn {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .back-btn:hover {
            background-color: #2980b9;
        }
        
        .watermark {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.8rem;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">
            <img alt="Universitas Muhammadiyah Bima" height="60" src="../img/logo.jpg" width="60"/>
            <span>UNIVERSITAS MUHAMMADIYAH BIMA</span>
        </div>
        <!-- Navigation removed as requested -->
    </div>

    <div class="full-schedule">
        <h1 class="schedule-title">JADWAL KULIAH ILMU KOMPUTER</h1>
        <p class="text-center">Tahun Akademik <?php echo date('Y').'/'.(date('Y')+1); ?></p>
        
        <div class="schedule-filter">
            <div class="filter-group">
                <label for="filter-day">Hari:</label>
                <select id="filter-day">
                    <option value="">Semua Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="filter-semester">Semester:</label>
                <select id="filter-semester">
                    <option value="">Semua Semester</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
            </div>
            
            <button class="btn-print" onclick="window.print()">
                <i class="fas fa-print"></i> Cetak Jadwal
            </button>
        </div>
        
        <?php
        include '../admin/db.php';
        $query = "SELECT j.*, d.nama_lengkap AS nama_dosen 
                  FROM jadwal_kuliah j 
                  LEFT JOIN dosen d ON j.dosen_id = d.id 
                  ORDER BY hari, waktu_mulai";
        $result = mysqli_query($conn, $query);
        ?>
        
        <div class="schedule-table-full">
            <table>
                <thead>
                    <tr>
                        <th>Hari</th>
                        <th>Waktu</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Dosen</th>
                        <th>Ruang</th>
                        <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <span class="badge-day badge-<?php echo strtolower($row['hari']); ?>">
                                <?php echo $row['hari']; ?>
                            </span>
                        </td>
                        <td>
                            <?php echo date('H:i', strtotime($row['waktu_mulai'])); ?> - 
                            <?php echo date('H:i', strtotime($row['waktu_selesai'])); ?>
                        </td>
                        <td><?php echo $row['nama_matkul']; ?></td>
                        <td><?php echo $row['sks']; ?></td>
                        <td><?php echo $row['nama_dosen']; ?></td>
                        <td><?php echo $row['ruangan']; ?></td>
                        <td><?php echo $row['semester']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        
    <div class="watermark">
            © <?php echo date('Y'); ?> Universitas Muhammadiyah Bima - Program Studi Ilmu Komputer
        </div>
    </div>

    <script>
        // Fungsi untuk filter jadwal
        document.addEventListener('DOMContentLoaded', function() {
            const filterDay = document.getElementById('filter-day');
            const filterSemester = document.getElementById('filter-semester');
            const tableRows = document.querySelectorAll('.schedule-table-full tbody tr');
            
            function filterSchedule() {
                const dayValue = filterDay.value.toLowerCase();
                const semesterValue = filterSemester.value;
                
                tableRows.forEach(row => {
                    const rowDay = row.querySelector('td:nth-child(1) span').textContent.toLowerCase();
                    const rowSemester = row.querySelector('td:nth-child(7)').textContent;
                    
                    const dayMatch = dayValue === '' || rowDay === dayValue;
                    const semesterMatch = semesterValue === '' || rowSemester === semesterValue;
                    
                    if (dayMatch && semesterMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
            
            filterDay.addEventListener('change', filterSchedule);
            filterSemester.addEventListener('change', filterSchedule);
        });
    </script>
</body>
</html>