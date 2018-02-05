<?php

use Illuminate\Database\Seeder;
use App\dosen;
use App\jurusan;
use App\mahasiswa;
use App\matkul;
use App\wali;

class UlanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dosens')->delete();
        DB::table('jurusans')->delete();
        DB::table('mahasiswas')->delete();
        DB::table('walis')->delete();
        DB::table('matkuls')->delete();
        DB::table('matkul_mahasiswas')->delete();

        $dosen1 = dosen::create(array(
        	'nama' => 'Rizki Nurs Fadillah','nipd'=>'381','alamat'=>'Cibaduyut','mata_kuliah'=>'mtk'
        ));
        $dosen2 = dosen::create(array(
        	'nama' => 'Rizki Fadhillah','nipd'=>'902','alamat'=>'Bahuan','mata_kuliah'=>'fisika'
        ));
        $this->command->info('Dosen Sudah Terisi !');

        $rpl = jurusan::create(array(
         	'nama_jurusan'=>'Rekayasa Perangkat Lunak'
         ));
        $tkr = jurusan::create(array(
         	'nama_jurusan'=>'Teknik Kendaraan Ringan'
         ));
        $tsm = jurusan::create(array(
         	'nama_jurusan'=>'Teknik Sepeda Motor'
         ));
        $this->command->info('Jurusan Sudah Terisi !');

        $bagus = mahasiswa::create(array(
        'nama_mahasiswa'=> 'bagus',
        'nis'=>'921',
        'id_dosen'=>$dosen1->id,
        'id_jurusan'=> $rpl->id
        ));

        $mustafa = mahasiswa::create(array(
        'nama_mahasiswa'=> 'mustafa','nis'=>'362','id_dosen'=>$dosen1->id,'id_jurusan'=> $tkr->id
        ));
        $robi = mahasiswa::create(array(
        'nama_mahasiswa'=> 'robi','nis'=>'383','id_dosen'=>$dosen2->id,'id_jurusan'=> $tsm->id
        ));

        $this->command->info('Mahasiswa Sudah Terisi!');

        wali::create(array(
        'nama'=>'Maman',
        'alamat'=>'Cangkuang',
        'id_mahasiswa'=>$bagus->id
        ));
        wali::create(array(
        'nama'=>'Edi',
        'alamat'=>'Karasak',
        'id_mahasiswa'=>$mustafa->id
        ));
        wali::create(array(
        'nama'=>'Udin',
        'alamat'=>'Kopo',
        'id_mahasiswa'=>$robi->id
        ));

		$this->command->info('Wali Telah Diisi !');

		$mtk = matkul::create(array('nama_matkul'=>'mtk','kkm'=>'80'));
		$fisika = matkul::create(array('nama_matkul'=>'fisika','kkm'=>'85'));

		$bagus->matkul()->attach($fisika->id);
        $bagus->matkul()->attach($mtk->id);
		$mustafa->matkul()->attach($fisika->id);
		$robi->matkul()->attach($mtk->id);

		$this->command->info('Mahasiswa dan Mata Kuliah Telah Diisi !'); 
    }
}
