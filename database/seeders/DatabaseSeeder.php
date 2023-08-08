<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Foundation\Auth\User;
use App\Models\User;
use App\Models\kategori_layanan;
use App\Models\layanan;
use App\Models\kategori_operasi;
use App\Models\skema_operasi;
use App\Models\jadwal_operasi;
use App\Models\operasi;
use App\Models\reservasi;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. seed user-------------------------------------------------------------------------------------------
        // User::factory(10)->create();
        User::create([
            'name' => 'Andri Firmansyah Putra',
            'email' => 'ahsyandri@gmail.com',
            'alamat' => 'Jl. Bantul No.13, Monggang, Pendowoharjo, Kec. Sewon, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55186',
            'telephone' => '089510364498',
            'password' => Hash::make('admin_rcsm'),
            'level' => 'pemilik'
        ]);


        User::create([
            'name' => 'Vinda Risma',
            'email' => 'vindarisma.vr@gmail.com',
            'alamat' => 'Mrisi RT 11, Tirtonirmolo Kasihan, Bantul Yohyakarta',
            'telephone' => '089632311271',
            'password' => Hash::make('passs_pelangan'),
            'level' => 'member'
        ]);

        User::create([
            'name' => 'Tri Agung J',
            'email' => 'triagungj@gmail.com',
            'alamat' => 'Hidden Gem Purwokerto',
            'telephone' => '089632314321',
            'password' => Hash::make('pass_member'),
            'level' => 'pelanggan'
        ]);

        User::create([
            'name' => 'Vindut Rismaputri',
            'email' => '19107020074@student.uin-suka.ac.id',
            'alamat' => 'Sewon Asri Tirtonirmolo Kasihan Bantul',
            'telephone' => '089632314321',
            'password' => Hash::make('passs_member'),
            'level' => 'member'
        ]);

        User::create([
            'name' => 'Dwi Agus Wahyudi',
            'email' => 'aw110874@gmail.com',
            'alamat' => 'Jl. Mrisi rt.11 Tirtonirmolo Kasihan Bantul',
            'telephone' => '089632314321',
            'password' => Hash::make('passs_member'),
            'level' => 'member'
        ]);

        // 2. seed kategori layanan------------------------------------------------------------------------------
        kategori_layanan::create(['nama' => 'Perawatan Rambut', 'slug' => 'perawatan-rambut', 'gambar' => 'kategori_layanan/perawatan-rambut.png']);
        kategori_layanan::create(['nama' => 'Serba Lulur', 'slug' => 'serba-lulur', 'gambar' => 'kategori_layanan/lulur.png']);
        kategori_layanan::create(['nama' => 'SPA', 'slug' => 'spa', 'gambar' => 'kategori_layanan/spa.png']);
        kategori_layanan::create(['nama' => 'Perawatan Tangan dan Kaki', 'slug' => 'perawatan-tangan-dan-kaki', 'gambar' => 'kategori_layanan/perawatan-kaki.png']);
        kategori_layanan::create(['nama' => 'Perawatan Wajah', 'slug' => 'perawatan-wajah', 'gambar' => 'kategori_layanan/perawatan-wajah.png']);
        kategori_layanan::create(['nama' => 'Serba Pijat dan Urut', 'slug' => 'serba-pijat-dan-urut', 'gambar' => 'kategori_layanan/pijat-urut.png']);


        // 3. seed layanan-----------------------------------------------------------------------------------------
        $data_layanan = [
            [1, 'haircutz', 'haircut', 20000, true],
            [1, 'cuciblow', 'cuciblow', 20000, true],
            [1, 'creambat-organik', 'creambat organik', 60000, true],
            [1, 'creambat-natural', 'creambat natural', 50000, true],
            [1, 'hair-spa-matrix', 'hair spa matrix', 70000, true],
            [1, 'henna', 'henna', 50000, true],
            [1, 'coloring-hair', 'coloring hair', 60000, true],
            [1, 'rebonding', 'rebonding', 150000, true],
            [1, 'hair-treatment', 'hair treatment', 20000, true],
            [2, 'tradisional', 'tradisional', 110000, true],
            [2, 'organik', 'organik', 110000, true],
            [2, 'whitening', 'whitening', 110000, true],
            [2, 'lulur-dewi-sri', 'lulur dewi sri', 110000, true],
            [2, 'cangkang-watnut', 'cangkang watnut', 150000, true],
            [3, 'coklat', 'coklat', 145000, true],
            [3, 'lulur-whitening', 'whitening', 150000, true],
            [3, 'strawberry', 'strawberry', 125000, true],
            [3, 'spa-dewi-sri', 'spa dewi sri', 240000, true],
            [3, 'aromaterapy essential', 'aromaterapy essential', 250000, true],
            [4, 'manicure', 'manicure', 40000, true],
            [4, 'pedicure', 'pedicure', 50000, true],
            [4, 'hand-spa-Special', 'Hand SPA Special', 45000, true],
            [4, 'foot-spa', 'Foot SPA', 55000, true],
            [4, 'foot-spa-special', 'foot SPA Special', 75000, true],
            [5, 'totok-wajah', 'totok wajah', 35000, true],
            [5, 'totok-mata', 'totok mata', 35000, true],
            [5, 'totok-migran-kolestrol', 'totok migran kolestrol', 100000, true],
            [5, 'totok-wajah-lumispa', 'totok wajah lumispa', 100000, true],
            [5, 'facial-punggung', 'facial punggung', 50000, true],
            [5, 'facial-message-tererapy', 'facial message tererapy', 45000, true],
            [5, 'facial-natural', 'facial natural', 50000, true],
            [5, 'facial-wardah', 'facial wardah', 60000, true],
            [5, 'facial-biokos', 'facial biokos', 65000, true],
            [5, 'facial-anti-acne', 'facial anti acne', 100000, true],
            [5, 'facial-whitening', 'facial whitening', 100000, true],
            [6, 'sauna', 'sauna', 15000, true],
            [6, 'pijat-punggung-dan-kaki', 'pijat punggung dan kaki', 35000, true],
            [6, 'masker-payudara', 'masker payudara', 40000, true],
            [6, 'refleksi', 'refleksi', 45000, true],
            [6, 'pijat-balita-(1-5)', 'pijat balita (1-5)', 55000, true],
            [6, 'pijat-anak-(5-10)', 'pijat anak (5-10)', 60000, true],
            [6, 'body-aroma-terapy-message', 'body aroma terapy message', 80000, true],
            [6, 'essential-body-message', 'essential body message', 150000, true],
            [6, 'ratus-v', 'ratus v', 35000, true],
            [6, 'bekam-sehat', 'bekam sehat', 65000, true],
            [6, 'waxing', 'waxing', 75000, true],
        ];

        foreach ($data_layanan as $layanan) {
            layanan::create([
                'kategori_layanan_id' => $layanan[0],
                'slug' => $layanan[1],
                'nama' => $layanan[2],
                'harga' => $layanan[3],
                'status' => $layanan[4]
            ]);
        }


        //4. kategori operasi seed-------------------------------------------------------------------------
        kategori_operasi::create(['nama' => 'khusus hari nasional', 'slug' => 'khusus-hari-nasiona']);
        kategori_operasi::create(['nama' => 'hari biasa', 'slug' => 'hari-biasa']);
        kategori_operasi::create(['nama' => 'khusus weekend', 'slug' => 'khusus-weekend']);

        //6. Skema operasi------------------------------------------------------------------------------
        $data_skema_operasi = [
            [1, '09:00', '09:30'],
            [1, '09:30', '10:00'],
            [1, '10:00', '10:30'],
            [1, '10:30', '11:00'],
            [1, '11:00', '11:30'],
            [1, '11:30', '12:00'],
            [1, '13:00', '13:30'],
            [1, '13:30', '14:00'],
            [1, '14:00', '14:30'],
            [1, '14:30', '15:00'],
            [1, '15:00', '15:30'],
            [1, '15:30', '16:00'],
            [1, '16:00', '16:30'], //haha
            [2, '09:00', '09:30'],
            [2, '09:30', '10:00'],
            [2, '10:00', '10:30'],
            [2, '10:30', '11:00'],
            [2, '11:00', '11:30'],
            [2, '13:00', '13:30'],
            [2, '13:30', '14:00'],
            [2, '14:00', '14:30'],
            [2, '14:30', '15:00'],
            [2, '15:00', '15:30'],
            [2, '15:30', '16:00'],
            [2, '16:00', '16:30'], //haha2
            [3, '09:00', '09:30'],
            [3, '09:30', '10:00'],
            [3, '10:00', '10:30'],
            [3, '10:30', '11:00'],
            [3, '11:00', '11:30'],
            [3, '11:30', '12:00'],
            [3, '13:00', '13:30'],
            [3, '13:30', '14:00'],
            [3, '14:00', '14:30'],
            [3, '14:30', '15:00'],
            [3, '15:00', '15:30'],
            [3, '15:30', '16:00'],
            [3, '16:00', '16:30'], //haha3
        ];

        foreach ($data_skema_operasi as $dso) {
            skema_operasi::create([
                'kategori_operasi_id' => $dso[0],
                'waktu_mulai' => $dso[1],
                'waktu_selesai' => $dso[2],
            ]);
        }

        // 5.membuat data dummy reservasi ------------------------------------
        jadwal_operasi::create([
            'tanggal' => '2023-07-01',
            'kategori_operasi' => 'khusus hari nasional',
            'hari' => '05',
            'bulan' => '07',
            'tahun' => '2023',
            'status' => false,
        ]);

        jadwal_operasi::create([
            'tanggal' => '2023-07-02',
            'kategori_operasi' => 'hari biasa',
            'hari' => '05',
            'bulan' => '07',
            'tahun' => '2023',
            'status' => false,
        ]);

        jadwal_operasi::create([
            'tanggal' => '2023-07-03',
            'kategori_operasi' => 'khusus weekend',
            'hari' => '05',
            'bulan' => '07',
            'tahun' => '2023',
            'status' => false,
        ]);

        // diperuntukan untuk reservasi mendatang
        jadwal_operasi::create([
            'tanggal' => '2023-07-20',
            'kategori_operasi' => 'hari biasa',
            'hari' => '20',
            'bulan' => '07',
            'tahun' => '2023',
            'status' => true,
        ]);

        jadwal_operasi::create([
            'tanggal' => '2023-07-21',
            'kategori_operasi' => 'hari biasa',
            'hari' => '21',
            'bulan' => '07',
            'tahun' => '2023',
            'status' => true,
        ]);
        //6. dummy operasi dari jadwaloperasi diatas------------------------------------------------------------------------------
        //ctt : false berarti kosong || true dibooking

        $data_operasi = [
            [1, '09:00', '09:30', true],
            [1, '09:30', '10:00', true],
            [1, '10:00', '10:30', false],
            [1, '10:30', '11:00', false],
            [1, '11:00', '11:30', true],
            [1, '11:30', '12:00', true],
            [1, '13:00', '13:30', false],
            [1, '13:30', '14:00', false],
            [1, '14:00', '14:30', false],
            [1, '14:30', '15:00', false],
            [1, '15:00', '15:30', false],
            [1, '15:30', '16:00', true],
            [1, '16:00', '16:30', true], //haha
            [2, '09:00', '09:30', true],
            [2, '09:30', '10:00', true],
            [2, '10:00', '10:30', true],
            [2, '10:30', '11:00', false],
            [2, '11:00', '11:30', false],
            [2, '13:00', '13:30', false],
            [2, '13:30', '14:00', false],
            [2, '14:00', '14:30', false],
            [2, '14:30', '15:00', false],
            [2, '15:00', '15:30', false],
            [2, '15:30', '16:00', false],
            [2, '16:00', '16:30', false], //haha2
            [3, '09:00', '09:30', true],
            [3, '09:30', '10:00', true],
            [3, '10:00', '10:30', false],
            [3, '10:30', '11:00', false],
            [3, '11:00', '11:30', true],
            [3, '11:30', '12:00', true],
            [3, '13:00', '13:30', false],
            [3, '13:30', '14:00', false],
            [3, '14:00', '14:30', false],
            [3, '14:30', '15:00', false],
            [3, '15:00', '15:30', false],
            [3, '15:30', '16:00', false],
            [3, '16:00', '16:30', false], //haha3--------------------------
            [4, '09:00', '09:30', true],
            [4, '09:30', '10:00', false],
            [4, '10:00', '10:30', false],
            [4, '10:30', '11:00', false],
            [4, '11:00', '11:30', false],
            [4, '11:30', '12:00', false],
            [4, '13:00', '13:30', false],
            [4, '13:30', '14:00', false],
            [4, '14:00', '14:30', false],
            [4, '14:30', '15:00', false],
            [4, '15:00', '15:30', false], //diperuntukkan untuk reservasi mendatang
            [5, '09:00', '09:30', false],
            [5, '09:30', '10:00', false],
            [5, '10:00', '10:30', false],
            [5, '10:30', '11:00', false],
            [5, '11:00', '11:30', false],
            [5, '11:30', '12:00', false],
            [5, '13:00', '13:30', false],
            [5, '13:30', '14:00', false],
            [5, '14:00', '14:30', false],
            [5, '14:30', '15:00', false],
            [5, '15:00', '15:30', false], //diperuntukkan untuk reservasi mendatang

        ];
        // $d_jadwal_operasi_id = 

        foreach ($data_operasi as $o) {
            operasi::create([
                'jadwal_operasi_id' => $o[0],
                'waktu_mulai' => $o[1],
                'waktu_selesai' => $o[2],
                'status' => $o[3]
            ]);
        }

        // dummy reservasi-----------------------------------------------------------------------------------------------------------------------------
        Reservasi::create([
            'jadwal_operasi_id' => 1,
            'user_id' => 2,
            'layanan_id' => 1,
            'operasi_id' => 1,
            'status' => 'selesai'
        ]);

        Reservasi::create([
            'jadwal_operasi_id' => 1,
            'user_id' => 2,
            'layanan_id' => 3,
            'operasi_id' => 2,
            'status' => 'selesai'
        ]);

        Reservasi::create([
            'jadwal_operasi_id' => 1,
            'user_id' => 3,
            'layanan_id' => 13,
            'operasi_id' => 5,
            'status' => 'selesai'
        ]);

        Reservasi::create([
            'jadwal_operasi_id' => 1,
            'user_id' => 3,
            'layanan_id' => 2,
            'operasi_id' => 6,
            'status' => 'selesai'
        ]);

        Reservasi::create([
            'jadwal_operasi_id' => 1,
            'user_id' => 5,
            'layanan_id' => 1,
            'operasi_id' => 12,
            'status' => 'selesai'
        ]);

        Reservasi::create([
            'jadwal_operasi_id' => 1,
            'user_id' => 5,
            'layanan_id' => 20,
            'operasi_id' => 13,
            'status' => 'selesai'
        ]);

        Reservasi::create([
            'jadwal_operasi_id' => 2,
            'user_id' => 4,
            'layanan_id' => 6,
            'operasi_id' => 14,
            'status' => 'selesai'
        ]);

        // -----------------------------------
        Reservasi::create([
            'jadwal_operasi_id' => 3,
            'user_id' => 2,
            'layanan_id' => 2,
            'operasi_id' => 26,
            'status' => 'selesai'
        ]);

        Reservasi::create([
            'jadwal_operasi_id' => 3,
            'user_id' => 2,
            'layanan_id' => 1,
            'operasi_id' => 27,
            'status' => 'selesai'
        ]);

        Reservasi::create([
            'jadwal_operasi_id' => 3,
            'user_id' => 3,
            'layanan_id' => 20,
            'operasi_id' => 30,
            'status' => 'selesai'
        ]);

        Reservasi::create([
            'jadwal_operasi_id' => 4,
            'user_id' => 4,
            'layanan_id' => 6,
            'operasi_id' => 39,
            'status' => 'antri'
        ]);
    }
}
