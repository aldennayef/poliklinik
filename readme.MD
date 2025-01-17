# TUTORIAL INSTALASI PROJECT

Project **POLIKLINIK** menggunakan bahasa pemrograman PHP dengan framework Code Igniter 3.

Berikut adalah cara penginstalannya :
1. Import sql database (db.sql).
2. Clone github / extract file di directory htdocs/laragon (www).
3. Ganti link **BASE_URL** di application -> config -> config.php . Sesuaikan dengan directory project berada.
4. Sesuaikan database (username, password, dan nama database) di application -> config -> database.php . 

## KEY:
1. JAGA-JAGA RAWAN ERROR -> FOOTER.PHP LINE 1555

GANTI DENGAN :
$(document).on('click', '.add-obat', function() {
    var newObatSelect = `
        <div class="input-group mt-2">
            <select class="form-control obat" name="obat[]">
                <option value="">Pilih Obat</option>
                <?php if(isset($obat) && is_array($obat)) { ?>
                    <?php foreach($obat as $listobat) { ?>
                        <option value="<?=htmlspecialchars($listobat['harga'])?>" data-id="<?=htmlspecialchars($listobat['id'])?>"><?=htmlspecialchars($listobat['nama_obat'])?> - <?=htmlspecialchars($listobat['kemasan'])?> - <?=htmlspecialchars($listobat['harga'])?></option>
                    <?php } ?>
                <?php } else { ?>
                    <option value="">Data obat tidak tersedia</option>
                <?php } ?>
            </select>
            <div class="input-group-append">
                <button type="button" class="btn btn-danger btn-sm remove-obat">-</button>
                <button type="button" class="btn btn-success btn-sm add-obat">+</button>
            </div>
        </div>
    `;
    $('#obat-container').append(newObatSelect);
    updateButtons(); // Perbarui tombol setelah menambah dropdown
    calculateTotal(); // Hitung total setiap kali dropdown ditambah
});

2. Query langsung di controller : 
$comp['produk'] =$this->db->query('SELECT * FROM produk where jenis_produk != "Game" AND server_produk = "VIPayment" ORDER BY brand_produk ASC')->result_array();

atau 

public function index() {
    // Menjalankan query SELECT
    $query = $this->db->query('SELECT * FROM users');

    // Mengecek apakah query menghasilkan data
    if ($query->num_rows() > 0) {
        // Menampilkan hasil query dalam bentuk array
        $data['users'] = $query->result_array();
    } else {
        $data['users'] = [];
    }

    // Memuat view dan mengirimkan data ke view
    $this->load->view('user_list', $data);
}

    1. SELECT
    Fungsi: Digunakan untuk memilih data dari tabel. Hasilnya bisa berupa satu atau lebih baris data.

    Contoh:

    sql
    Salin
    SELECT * FROM employees;
    Menampilkan semua kolom dari tabel employees.

    sql
    Salin
    SELECT name, salary FROM employees WHERE department = 'HR';
    Menampilkan nama dan gaji karyawan yang berada di departemen 'HR'.

    2. INSERT
    Fungsi: Digunakan untuk menyisipkan data baru ke dalam tabel.

    Contoh:

    sql
    Salin
    INSERT INTO employees (name, department, salary)
    VALUES ('John Doe', 'IT', 5000);
    Menyisipkan satu baris data ke dalam tabel employees.

    3. UPDATE
    Fungsi: Digunakan untuk memperbarui data yang ada dalam tabel.

    Contoh:

    sql
    Salin
    UPDATE employees
    SET salary = 6000
    WHERE name = 'John Doe';
    Memperbarui gaji karyawan yang bernama 'John Doe' menjadi 6000.

    4. DELETE
    Fungsi: Digunakan untuk menghapus data dari tabel.

    Contoh:

    sql
    Salin
    DELETE FROM employees WHERE name = 'John Doe';
    Menghapus data karyawan yang bernama 'John Doe' dari tabel employees.

    5. CREATE TABLE
    Fungsi: Digunakan untuk membuat tabel baru di dalam database.

    Contoh:

    sql
    Salin
    CREATE TABLE employees (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        department VARCHAR(50),
        salary DECIMAL(10, 2)
    );
    Membuat tabel baru dengan nama employees yang memiliki kolom id, name, department, dan salary.

    6. ALTER TABLE
    Fungsi: Digunakan untuk mengubah struktur tabel, seperti menambah, menghapus, atau mengubah kolom.

    Contoh:

    sql
    Salin
    ALTER TABLE employees ADD age INT;
    Menambah kolom age bertipe integer ke dalam tabel employees.

    sql
    Salin
    ALTER TABLE employees MODIFY salary DECIMAL(12, 2);
    Mengubah tipe data kolom salary menjadi DECIMAL(12,2).

    7. DROP TABLE
    Fungsi: Digunakan untuk menghapus tabel beserta seluruh datanya.

    Contoh:

    sql
    Salin
    DROP TABLE employees;
    Menghapus tabel employees dari database.

    8. CREATE INDEX
    Fungsi: Digunakan untuk membuat indeks yang meningkatkan kecepatan query pencarian.

    Contoh:

    sql
    Salin
    CREATE INDEX idx_salary ON employees (salary);
    Membuat indeks pada kolom salary dari tabel employees untuk mempercepat pencarian berdasarkan kolom tersebut.

    9. DROP INDEX
    Fungsi: Digunakan untuk menghapus indeks yang telah dibuat.

    Contoh:

    sql
    Salin
    DROP INDEX idx_salary ON employees;
    Menghapus indeks idx_salary pada tabel employees.

    10. GROUP BY
    Fungsi: Digunakan untuk mengelompokkan hasil query berdasarkan satu atau lebih kolom.

    Contoh:

    sql
    Salin
    SELECT department, AVG(salary) AS average_salary
    FROM employees
    GROUP BY department;
    Menampilkan rata-rata gaji karyawan untuk setiap departemen.

    11. HAVING
    Fungsi: Digunakan untuk menyaring hasil yang dikelompokkan setelah GROUP BY.

    Contoh:

    sql
    Salin
    SELECT department, AVG(salary) AS average_salary
    FROM employees
    GROUP BY department
    HAVING AVG(salary) > 5000;
    Menampilkan rata-rata gaji karyawan untuk setiap departemen yang rata-ratanya lebih besar dari 5000.

    12. ORDER BY
    Fungsi: Digunakan untuk mengurutkan hasil query berdasarkan satu atau lebih kolom.

    Contoh:

    sql
    Salin
    SELECT name, salary
    FROM employees
    ORDER BY salary DESC;
    Mengurutkan karyawan berdasarkan gaji dari yang tertinggi ke terendah.

    13. JOIN
    Fungsi: Digunakan untuk menggabungkan dua atau lebih tabel berdasarkan kolom yang saling terkait.

    Contoh:

    sql
    Salin
    SELECT employees.name, departments.name
    FROM employees
    JOIN departments ON employees.department_id = departments.id;
    Menggabungkan tabel employees dan departments berdasarkan department_id.

    14. INNER JOIN
    Fungsi: Menggabungkan dua tabel dan hanya menampilkan baris yang memiliki kecocokan di kedua tabel.

    Contoh:

    sql
    Salin
    SELECT employees.name, departments.name
    FROM employees
    INNER JOIN departments ON employees.department_id = departments.id;
    Menggabungkan tabel employees dan departments hanya untuk karyawan yang memiliki kecocokan dengan departemen.

    15. LEFT JOIN (LEFT OUTER JOIN)
    Fungsi: Menggabungkan dua tabel dan menampilkan semua baris dari tabel sebelah kiri (tabel pertama), dan baris yang cocok dari tabel sebelah kanan.

    Contoh:

    sql
    Salin
    SELECT employees.name, departments.name
    FROM employees
    LEFT JOIN departments ON employees.department_id = departments.id;
    Menampilkan semua karyawan, termasuk yang tidak memiliki departemen yang sesuai.

    16. RIGHT JOIN (RIGHT OUTER JOIN)
    Fungsi: Menggabungkan dua tabel dan menampilkan semua baris dari tabel sebelah kanan (tabel kedua), dan baris yang cocok dari tabel sebelah kiri.

    Contoh:

    sql
    Salin
    SELECT employees.name, departments.name
    FROM employees
    RIGHT JOIN departments ON employees.department_id = departments.id;
    Menampilkan semua departemen, termasuk yang tidak memiliki karyawan yang sesuai.

    17. UNION
    Fungsi: Digunakan untuk menggabungkan hasil dari dua atau lebih query SELECT.

    Contoh:

    sql
    Salin
    SELECT name FROM employees WHERE department = 'HR'
    UNION
    SELECT name FROM employees WHERE department = 'IT';
    Menggabungkan nama karyawan yang berada di departemen 'HR' dan 'IT'.

    18. DISTINCT
    Fungsi: Digunakan untuk menghilangkan duplikat dari hasil query.

    Contoh:

    sql
    Salin
    SELECT DISTINCT department FROM employees;
    Menampilkan hanya departemen yang unik, tanpa duplikasi.

    19. LIMIT
    Fungsi: Digunakan untuk membatasi jumlah hasil yang ditampilkan.

    Contoh:

    sql
    Salin
    SELECT * FROM employees LIMIT 5;
    Menampilkan hanya 5 baris pertama dari tabel employees.

    20. LIKE
    Fungsi: Digunakan untuk mencocokkan pola dalam pencarian string.

    Contoh:

    sql
    Salin
    SELECT * FROM employees WHERE name LIKE 'John%';
    Menampilkan semua karyawan yang namanya dimulai dengan 'John'.

    21. IN
    Fungsi: Digunakan untuk mencocokkan nilai dengan daftar yang diberikan.

    Contoh:

    sql
    Salin
    SELECT * FROM employees WHERE department IN ('HR', 'IT');
    Menampilkan karyawan yang bekerja di departemen 'HR' atau 'IT'.

    22. BETWEEN
    Fungsi: Digunakan untuk memilih nilai yang berada di antara dua nilai tertentu.

    Contoh:

    sql
    Salin
    SELECT * FROM employees WHERE salary BETWEEN 3000 AND 5000;
    Menampilkan karyawan dengan gaji antara 3000 dan 5000.

3. Template page :

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Poliklinik Sehat Bersama</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?=base_url('')?>">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-5">

                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

4. Jika error ketika import database (unknown_collocation_utfmb4_0900_ai_ci):
    * Buka file db.sql
    * Bagian CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;  diganti menjadi CHARSET=utf8 COLLATE=utf8_general_ci;
    * atau CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci; diganti menjadi CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;