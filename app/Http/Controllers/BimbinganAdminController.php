<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Skripsi;
use App\Models\Subbab;
use Illuminate\Http\Request;

class BimbinganAdminController extends Controller
{
    public function index()
    {
        $bimbingans = Bimbingan::all();

        return view('admin.bimbingan.bimbingan', ['bimbingans' => $bimbingans]);
    }

    public function tambah()
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        $babs = Bab::all();
        $subBabs = Subbab::with('bab')->get();
        return view('admin.bimbingan.tambah', [
            'mahasiswas' => $mahasiswas,
            'dosens' => $dosens,
            'babs' => $babs,
            'subBabs' => $subBabs,
        ]);
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'mahasiswa_id' => 'required',
            'dospem_id' => 'required',
            'bab_id' => 'required',
            'subbab_id' => 'nullable',
            'status' => 'required',
        ]);

        $mahasiswa = Mahasiswa::where('npm', $data['mahasiswa_id'])->first();
        $data['mahasiswa_id'] = $mahasiswa->id;

        $skripsi = Skripsi::where('mahasiswa_id', $data['mahasiswa_id'])->first();
        $data['skripsi_id'] = $skripsi->id;

        $dosen = Dosen::where('nip', $data['dospem_id'])->first();
        $data['dospem_id'] = $dosen->id;

        $newBimbingan = Bimbingan::create($data);

        if ($data['status'] == 'acc') {
            $this->updateSkripsiProgress($skripsi, $data['bab_id'], $data['subbab_id']);
        }

        return redirect(route('bimbingan-admin.index'))->with('success', 'Data Bimbingan berhasil disimpan.');
    }

    private function updateSkripsiProgress($skripsi, $babId, $subbabId)
    {
        // Define the progress values for each bab
        $progressValues = [
            'Abstrak' => 2,
            'Bab 1' => 12,
            'Bab 2' => 8,
            'Bab 3' => 18,
            'Bab 4' => 6,
            'Bab 5' => 4,
        ];

        $bab = Bab::find($babId);

        // If there are subbabs, adjust progress based on the number of subbabs
        if ($subbabId !== null) {
            $numSubbabs = $bab->subbabs->count();
            $progressValues[$bab->nama] = 1 / $numSubbabs * $progressValues[$bab->nama];
        }

        $skripsi->progres += $progressValues[$bab->nama];
        $skripsi->progres = min($skripsi->progres, 100);
        $skripsi->save();
    }

    public function edit(Bimbingan $bimbingan)
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        $babs = Bab::all();
        $subBabs = Subbab::with('bab')->get();
        return view('admin.bimbingan.edit', [
            'bimbingan' => $bimbingan,
            'mahasiswas' => $mahasiswas,
            'dosens' => $dosens,
            'babs' => $babs,
            'subBabs' => $subBabs,
        ]);
    }

    public function update(Request $request, Bimbingan $bimbingan)
    {
        $data = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'mahasiswa_id' => 'required',
            'dospem_id' => 'required',
            'bab_id' => 'required',
            'subbab_id' => 'nullable',
            'status' => 'required',
        ]);

        if ($data['subbab_id'] == 'Pilih Sub Bab') {
            $data['subbab_id'] = null;
        }

        $mahasiswa = Mahasiswa::where('npm', $data['mahasiswa_id'])->first();
        $data['mahasiswa_id'] = $mahasiswa->id;

        $skripsi = Skripsi::where('mahasiswa_id', $data['mahasiswa_id'])->first();
        $data['skripsi_id'] = $skripsi->id;

        $dosen = Dosen::where('nip', $data['dospem_id'])->first();
        $data['dospem_id'] = $dosen->id;

        $previousStatus = $bimbingan->status; // Get the previous status before updating

        $bimbingan->update($data);

        // Check if the updated bimbingan has 'acc' status
        if ($data['status'] == 'acc') {
            $this->updateSkripsiProgress($skripsi, $data['bab_id'], $data['subbab_id']);
        }

        // Check if the previous status was 'acc' and the updated status is now 'revisi' or 'menunggu konfirmasi'
        if ($previousStatus == 'acc' && ($data['status'] == 'revisi' || $data['status'] == 'menunggu konfirmasi')) {
            $this->deductSkripsiProgress($skripsi, $data['bab_id'], $data['subbab_id']);
        }

        return redirect(route('bimbingan-admin.index'))->with('success', 'Data Bimbingan berhasil diperbarui.');
    }

    private function deductSkripsiProgress($skripsi, $babId, $subbabId)
    {
        $progressValues = [
            'Abstrak' => 2,
            'Bab 1' => 12,
            'Bab 2' => 8,
            'Bab 3' => 18,
            'Bab 4' => 6,
            'Bab 5' => 4,
        ];

        $bab = Bab::find($babId);

        if ($subbabId !== null) {
            $numSubbabs = $bab->subbabs->count();
            $progressValues[$bab->nama] = 1 / $numSubbabs * $progressValues[$bab->nama];
        }

        $skripsi->progres -= $progressValues[$bab->nama];
        $skripsi->progres = max($skripsi->progres, 0);
        $skripsi->save();
    }

    public function hapus(Bimbingan $bimbingan)
    {
        $bimbingan->delete();
        return redirect(route('bimbingan-admin.index'))->with('success', 'Data Bimbingan berhasil dihapus.');
    }
}
