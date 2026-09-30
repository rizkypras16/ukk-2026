<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use PDO;
use PDOException;

class AlatController extends Controller
{
    private function getDB()
    {
        $envPath = __DIR__ . '/../../.env';
        $host = 'localhost';
        $dbname = 'db_db_rizky';
        $username = 'root';
        $password = '';

        if (file_exists($envPath)) {
            $env = parse_ini_file($envPath);
            $host = $env['DB_HOST'] ?? 'localhost';
            $dbname = $env['DB_DATABASE'] ?? 'db_db_rizky';
            $username = $env['DB_USERNAME'] ?? 'root';
            $password = $env['DB_PASSWORD'] ?? '';
        }

        try {
            return new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        } catch (PDOException $e) {
            die("Koneksi Database Gagal: " . $e->getMessage());
        }
    }

    public function index(Request $request)
{
    $pdo = $this->getDB();
    $stmt = $pdo->query("SELECT * FROM alat ORDER BY id_alat DESC");
    $data = $stmt->fetchAll();

    return $this->view('alat.index', compact('data'));
}

    public function create(Request $request)
    {
        $pdo = $this->getDB();
        $stmt = $pdo->query("SELECT * FROM kategori");
        $kategoris = $stmt->fetchAll();

        return $this->view('alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori'  => 'required|string',
            'jumlah'    => 'required|numeric',
            'kondisi'   => 'required|string',
        ]);

        $pdo = $this->getDB();
        $stmt = $pdo->query("SELECT kode_alat FROM alat ORDER BY id_alat DESC LIMIT 1");
        $terakhir = $stmt->fetch();
        
        $nomorUrut = ($terakhir && isset($terakhir->kode_alat)) 
            ? ((int) substr($terakhir->kode_alat, 3)) + 1 
            : 1;
        $kodeOtomatis = 'ALT' . sprintf("%03d", $nomorUrut);

        $sql = "INSERT INTO alat (kode_alat, nama_alat, kategori, jumlah, kondisi) VALUES (:kode, :nama, :kategori, :jumlah, :kondisi)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'kode'     => $kodeOtomatis,
            'nama'     => $request->input('nama_alat'),
            'kategori' => $request->input('kategori'),
            'jumlah'   => $request->input('jumlah'),
            'kondisi'  => $request->input('kondisi'),
        ]);

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil ditambahkan.');
    }

    public function edit($id_alat)
    {
        $pdo = $this->getDB();
        $stmt = $pdo->prepare("SELECT * FROM alat WHERE id_alat = ?");
        $stmt->execute([$id_alat]);
        $alat = $stmt->fetch();

        $stmtKat = $pdo->query("SELECT * FROM kategori");
        $kategoris = $stmtKat->fetchAll();

        return $this->view('alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, $id_alat)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori'  => 'required|string',
            'jumlah'    => 'required|numeric',
            'kondisi'   => 'required|string',
        ]);

        $pdo = $this->getDB();
        $sql = "UPDATE alat SET nama_alat = :nama, kategori = :kategori, jumlah = :jumlah, kondisi = :kondisi WHERE id_alat = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nama'     => $request->input('nama_alat'),
            'kategori' => $request->input('kategori'),
            'jumlah'   => $request->input('jumlah'),
            'kondisi'  => $request->input('kondisi'),
            'id'       => $id_alat
        ]);

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil diperbarui.');
    }

    public function destroy($id_alat)
    {
        $pdo = $this->getDB();
        $stmt = $pdo->prepare("DELETE FROM alat WHERE id_alat = ?");
        $stmt->execute([$id_alat]);

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil dihapus.');
    }
}