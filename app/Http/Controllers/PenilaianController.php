<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PenilaianController extends Controller
{
    public function hitungKaryawanTerbaik()
    {
        $penilaian = Penilaian::with('user')->get();

        if ($penilaian->isEmpty()) {
            return redirect()->route('penilaian.index')->with('error', 'Belum ada data penilaian.');
        }

        $csvFilePath = storage_path('app/penilaian_data.csv');
        $csvFile = fopen($csvFilePath, 'w');
        fputcsv($csvFile, ['user_id', 'kedisiplinan', 'kinerja', 'sikap_kerja', 'keahlian', 'total_nilai']);

        foreach ($penilaian as $p) {
            fputcsv($csvFile, [$p->user_id, $p->kedisiplinan, $p->kinerja, $p->sikap_kerja, $p->keahlian, $p->total_nilai]);
        }
        fclose($csvFile);

        $pythonScript = base_path('app/python/random_forest.py');
        $process = new Process(['C:\\Python311\\python.exe', $pythonScript, $csvFilePath]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $bestEmployeeId = trim($process->getOutput());
        $bestEmployee = User::find($bestEmployeeId);

        if ($bestEmployee) {
            return view('penilaian.karyawanTerbaik', compact('bestEmployee'));
        } else {
            return redirect()->route('penilaian.index')->with('error', 'Karyawan terbaik tidak ditemukan.');
        }
    }

    public function index()
    {
        $penilaian = Penilaian::with('user')->get();

        return view('admin.penilaian.penilaianIndex', compact('penilaian'));
    }

    public function create()
    {
        $karyawans = User::where('role', 'karyawan')->get();

        return view('admin.penilaian.penilaianCreate', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kedisiplinan' => 'required|integer|min:1|max:4',
            'kinerja' => 'required|integer|min:1|max:4',
            'sikap_kerja' => 'required|integer|min:1|max:4',
            'keahlian' => 'required|integer|min:1|max:4',
        ]);

        $total_nilai =
            ($request->kedisiplinan * 0.4) +
            ($request->kinerja * 0.3) +
            ($request->sikap_kerja * 0.15) +
            ($request->keahlian * 0.15);

        Penilaian::create([
            'user_id' => $request->user_id,
            'kedisiplinan' => $request->kedisiplinan,
            'kinerja' => $request->kinerja,
            'sikap_kerja' => $request->sikap_kerja,
            'keahlian' => $request->keahlian,
            'total_nilai' => $total_nilai,
        ]);

        return redirect()->route('penilaian.create')->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function getBestEmployee()
    {
        $penilaians = Penilaian::with('user')->get();

        if ($penilaians->isEmpty()) {
            return redirect()->route('penilaian.index')->with('error', 'Belum ada data penilaian.');
        }

        $bestEmployees = [];
        $highestScore = 0;

        foreach ($penilaians as $penilaian) {
            $total_nilai =
                ($penilaian->kedisiplinan * 0.4) +
                ($penilaian->kinerja * 0.3) +
                ($penilaian->sikap_kerja * 0.15) +
                ($penilaian->keahlian * 0.15);

            if ($total_nilai > $highestScore) {
                $highestScore = $total_nilai;
                $bestEmployees = [$penilaian->user];
            } elseif ($total_nilai == $highestScore) {
                $bestEmployees[] = $penilaian->user;
            }
        }

        if (count($bestEmployees) > 1) {
            $bestEmployee = $bestEmployees[array_rand($bestEmployees)];
        } else {
            $bestEmployee = $bestEmployees[0];
        }

        return view('admin.penilaian.karyawanTerbaik', compact('bestEmployee', 'highestScore'));
    }

    public function karyawanGetBestEmployee()
    {
        if (auth()->user()->role != 'karyawan') {
            return redirect()->route('home')->with('error', 'Akses ditolak.');
        }

        $penilaians = Penilaian::with('user')->get();

        if ($penilaians->isEmpty()) {
            return redirect()->route('home')->with('error', 'Belum ada data penilaian.');
        }

        $bestEmployee = null;
        $highestScore = 0;

        foreach ($penilaians as $penilaian) {
            $total_nilai =
                ($penilaian->kedisiplinan * 0.4) +
                ($penilaian->kinerja * 0.3) +
                ($penilaian->sikap_kerja * 0.15) +
                ($penilaian->keahlian * 0.15);

            if ($total_nilai > $highestScore) {
                $highestScore = $total_nilai;
                $bestEmployee = $penilaian->user;
            }
        }

        if ($bestEmployee) {
            return view('karyawan.dashboard', compact('bestEmployee', 'highestScore'));
        } else {
            return redirect()->route('karyawan.best-employee')->with('error', 'Tidak ada data karyawan terbaik.');
        }
    }

    public function personalPenilaian()
    {
        $user = auth()->user();

        $penilaians = Penilaian::where('user_id', $user->id)->get();

        if ($penilaians->isEmpty()) {
            return redirect()->route('penilaian.index')->with('error', 'Belum ada data penilaian untuk Anda.');
        }

        foreach ($penilaians as $penilaian) {
            $penilaian->kedisiplinan_label = $this->getPenilaianLabel($penilaian->kedisiplinan);
            $penilaian->kinerja_label = $this->getPenilaianLabel($penilaian->kinerja);
            $penilaian->sikap_kerja_label = $this->getPenilaianLabel($penilaian->sikap_kerja);
            $penilaian->keahlian_label = $this->getPenilaianLabel($penilaian->keahlian);
        }

        return view('karyawan.personalPenilaian', compact('penilaians'));
    }

    private function getPenilaianLabel($nilai)
    {
        switch ($nilai) {
            case 1:
                return 'Tidak Bagus';
            case 2:
                return 'Cukup Bagus';
            case 3:
                return 'Bagus';
            case 4:
                return 'Sangat Bagus';
            default:
                return 'Tidak Dikenal';
        }
    }

    public function hrdGetBestEmployee()
    {
        if (auth()->user()->role != 'hrd') {
            return redirect()->route('home')->with('error', 'Akses ditolak.');
        }

        $penilaians = Penilaian::with('user')->get();

        if ($penilaians->isEmpty()) {
            return redirect()->route('penilaian.index')->with('error', 'Belum ada data penilaian.');
        }

        $bestEmployee = null;
        $highestScore = 0;

        foreach ($penilaians as $penilaian) {
            $total_nilai =
                ($penilaian->kedisiplinan * 0.4) +
                ($penilaian->kinerja * 0.3) +
                ($penilaian->sikap_kerja * 0.15) +
                ($penilaian->keahlian * 0.15);

            if ($total_nilai > $highestScore) {
                $highestScore = $total_nilai;
                $bestEmployee = $penilaian->user;
            }
        }

        if ($bestEmployee) {
            return view('manager.data.karyawanTerbaik', compact('bestEmployee', 'highestScore'));
        } else {
            return redirect()->route('penilaian.index')->with('error', 'Tidak ada data karyawan terbaik.');
        }
    }

    public function edit($id)
    {
        $penilaian = Penilaian::findOrFail($id);

        $karyawans = User::where('role', 'karyawan')->get();

        return view('admin.penilaian.penilaianEdit', compact('penilaian', 'karyawans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kedisiplinan' => 'required|integer|min:1|max:4',
            'kinerja' => 'required|integer|min:1|max:4',
            'sikap_kerja' => 'required|integer|min:1|max:4',
            'keahlian' => 'required|integer|min:1|max:4',
        ]);

        $penilaian = Penilaian::findOrFail($id);

        $total_nilai =
            ($request->kedisiplinan * 0.4) +
            ($request->kinerja * 0.3) +
            ($request->sikap_kerja * 0.15) +
            ($request->keahlian * 0.15);

        $penilaian->update([
            'user_id' => $request->user_id,
            'kedisiplinan' => $request->kedisiplinan,
            'kinerja' => $request->kinerja,
            'sikap_kerja' => $request->sikap_kerja,
            'keahlian' => $request->keahlian,
            'total_nilai' => $total_nilai,
        ]);

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);

        $penilaian->delete();

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil dihapus.');
    }

}
