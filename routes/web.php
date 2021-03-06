    <?php

    use Illuminate\Support\Facades\Route;

    /*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    // Auth::routes();
    Route::get('/', 'HomeController@index');
    Auth::routes();
    Route::get('/dashboard', 'HomeController@index');
    Route::get('/lihat-dashboard', 'HomeController@lihatdashboard');
    Route::get('/cabor-perkategori', 'HomeController@read');
    Route::get('/jadwal-harian', 'HomeController@jadwalhari');
    ///Route::get('/dashboard');
    Route::group(['/Data-Atlet' => ['web', 'auth', 'roles']], function () {
        Route::group(['/Data-Atlet' => 'Administrator'], function () {
            Route::resource('admin', 'AdminController');
        });
        Route::group(['roles' => 'Pegawai'], function () {
            Route::resource('pegawai', 'PegawaiController');
        });
        Route::group(['roles' => 'User'], function () {
            Route::resource('user', 'UserController');
        });
        Route::get('logout', 'LoginController@logout');
        Route::get('/Data-Status/tambah', function () {
        });
        Route::get('/Data-Status', 'StatusTerakhirController@read');

        Route::post('/Jadwal-Perhari/lihat', function () {
        });

        //buat update profile
        Route::post('/update-profile/edit/{id}=update', 'HomeController@updateAccount');
        Route::get('/update-profile/ubah/{id}', 'HomeController@updateprofil');
        // Route::post('update-profile/edit/{{$id}}=update', 'HomeController@updateAccount');   

        //Data Company
        Route::get('/Data-Company/tambah', function () {
        });
        Route::post('/Data-Company/create', 'CompanyController@create');
        Route::get('/Data-Company', 'CompanyController@read');
        Route::post('/Data-Company/add', 'CompanyController@add');
        Route::post('/Data-Company/edit/{id}=update', 'CompanyController@update');
        Route::post('/Data-Company/edit/{id}', 'CompanyController@redirect_update');
        Route::post('/Data-Company/delete/{id}', 'CompanyController@delete');

        ///Data list user
        Route::post('/Data-List-User/create', 'ListUserController@create');
        Route::get('/Data-List-User', 'ListUserController@read');
        Route::get('/Data-List-User/tambah', 'ListUserController@tambah');
        Route::post('/Data-List-User/edit/{id}=update', 'ListUserController@update');
        Route::get('/Data-List-User/edit/{id}', 'ListUserController@redirect_update');
        Route::get('/Data-List-User/delete/{id}', 'ListUserController@delete');

        //Buat login admin baru
        Route::get('/login-admin/tambah', function () {
            return view('Admin/LoginAdmin');
        });
        Route::post('/login-admin/create', 'LoginAdminController@create');

        //redirect data tambah atlet ke view part/tambah atlet
        Route::get('/Data-Atlet/tambah', function () {
            $cabor = DB::table('data_cabor')->get();
            return view('part/TambahAtlet', ['cabor' => $cabor]);
        });
        //redirect data edit atlet ke view atletedit
        Route::get('/Data-Atlet/edit', function () {
            $editcabor = DB::table('data_cabor')->get();
            return view('atletedit', ['cabor' => $editcabor]);
        });
        Route::post('/Data-Atlet/create', 'AdminController@create'); //C OK
        Route::get('/Data-Atlet', 'AdminController@read'); //R OK   
        Route::get('/Data-Atlet/add', 'AdminController@add');
        Route::post('/Data-Atlet/edit/{id}=update', 'AdminController@update'); //U OK
        Route::get('/Data-Atlet/edit/{id}', 'AdminController@redirect_update'); //Redirect to Update Page OK
        Route::get('/Data-Atlet/delete/{id}', 'AdminController@delete'); //D OK
        Route::get('/Data-Atlet/cari', 'AdminController@cari');

        /* SIDEBAR - ADMIN cabor */
        //Redirect ke view part/TambahAdminCbr
        Route::get('/Data-admincabor/tambah', function () {
            $admincabor = DB::table('data_cabor')->get();
            return view('part/TambahAdminCbr', ['cabor' => $admincabor]);
        });
        //Redirect ke view editadmincabor
        Route::get('/Data-admincabor/edit', function () {
            $admincabor = DB::table('data_cabor')->get();
            return view('editadmincabor', ['admincabor' => $admincabor]);
        });
        Route::match(['get', 'post'], '/Data-admincabor', 'AdminCaborController@match');
        Route::post('/Data-admincabor/create', 'AdminCaborController@create'); //C ok
        Route::get('/Data-admincabor', 'AdminCaborController@read'); //R OK  
        Route::post('/Data-admincabor/edit/{id}=update', 'AdminCaborController@update');
        Route::get('/Data-admincabor/edit/{id}', 'AdminCaborController@redirect_update'); //Redirect to Update Page OK
        /* END SIDEBAR - ADMIN cabor */

        /* END SIDEBAR - CABOR */
        //Redirect ke View Caboredit
        Route::get('/Data-cabor/edit', function () {
            $admincabor = DB::table('data_cabor')->get();
            return view('caboredit', ['cabor' => $admincabor]);
        });
        Route::post('/Data-cabor/create', 'CaborController@create'); //C OK
        Route::get('/Data-cabor', 'CaborController@read'); //R OK
        Route::get('/Data-cabor/add', 'CaborController@add');
        Route::post('/Data-cabor/edit/{id_cabor}=update', 'CaborController@update'); //U OK
        Route::get('/Data-cabor/edit/{id_cabor}', 'CaborController@redirect_update'); //Redirect to Update Page OK
        Route::get('/Data-cabor/delete/{id_cabor}', 'CaborController@delete'); //D OK 
        Route::get('/Data-cabor/cari', 'CaborController@cari');

        /* SIDEBAR - KETUA KONI */
        //Redirect ke view Data_master_atlet
        Route::get('/Data-ketuakoni/tambah', function () {
            $ketuakoni = DB::table('data_master_nomer_ketua_koni')->get();
            return view('data_master_nomer_ketua_koni', ['ketuakoni' => $ketuakoni]);
        });
        //redirect edit ketuakoni di view edit ketua koni
        Route::get('/Data-ketuakoni/edit', function () {
            $ketuakoni = DB::table('data_master_nomer_ketua_koni')->get();
            return view('editketuakoni', ['ketuakoni' => $ketuakoni]);
        });
        route::post('/ketuakoni/create', 'AtletAddkoniController@create');
        Route::get('/ketuakoni', 'AtletAddkoniController@read');
        Route::post('/ketuakoni/edit/{id}=update', 'AtletAddkoniController@update');
        Route::get('/ketuakoni/edit/{id}', 'AtletAddkoniController@redirect_update');
        Route::get('/ketuakoni/delete/{id}', 'AtletAddkoniController@delete');
        Route::get('/ketuakoni/cari', 'AtletAddkoniController@cari');
        //*SIDEBAR PERTDANDINGAN
        Route::post('/jadwal-pertandingan/create', 'PertandinganController@create');
        Route::get('/jadwal-pertandingan', 'PertandinganController@read');
        //* END SIDEBAR PERTANDINGAN
        //*SIDEBAR status terkahir

        //Redirect Url ke view pages/ediitjadwal
        Route::get('/lihat-jadwal/editt', function () {
            $edit = DB::table('data_master_atlet')->get();
            return view('pages/editjadwal', ['jadwal' => $edit]);
        });
        //Redirect Url ke view pages/addjadwal
        Route::get('/lihat-jadwal/add', function () {
            $atlet_u = DB::table('data_master_atlet')->get();
            $cabor_a = DB::table('data_cabor')->get();
            $pic = DB::table('jadwal')->get();
            return view('pages/addjadwal', ['lihatdata' => $pic, 'atlet' => $atlet_u, 'cabor' => $cabor_a]);
        });
        //lihat jadwal kaya crud nya jadwal
        Route::post('/lihat-jadwal/create', 'JadwalController@create');
        Route::get('/lihat-jadwal', 'JadwalController@read');
        Route::post('/lihat-jadwal/tambah', 'JadwalController@tambah');
        Route::post('/lihat-jadwal/edit/{id}=update', 'JadwalController@update');
        Route::get('/lihat-jadwal/edit/{id}', 'JadwalController@redirect_update');
        Route::get('/lihat-jadwal/delete/{id}', 'JadwalController@delete');
        Route::get('/lihat-jadwal/cari', 'JadwalController@cari');

        //* SIDEBAR SERAH TERIMA    
        //Redirect ke view Tambah serah
        Route::get('/serah-terima/create', function () {
            $serah = DB::table('serah_terima_inventaris')->get();
            $pic = DB::table('jadwal')->get();
            return view('TambahSerah', ['lihatdata' => $pic]);
        });
        //redirect lihatserah terima di views/pages/lihatserah
        Route::get('/serah-terima/read', function () {
            $serah = DB::table('serah_terima_inventaris')->get();
            return view('/pages/lihatserah', ['lihatserah' => $serah]);
        });
        //redirect serah terima 2 monitoring ke view/lihat_serah_terima_inventaris
        Route::get('/lihat-serah-terima/read', function () {
            $serah = DB::table('serah_terima_inventaris')->get();
            return view('/pages/lihat_serah_terima', ['lihatserah_terima' => $serah]);
        });
        route::post('/serah-terima/create', 'SerahTerimaController@create');
        Route::get('/serah-terima', 'SerahTerimaController@read');

        //Get jadwal di serah terima controller
        Route::get('/jadwal', 'SerahTerimaController@index');

        Route::get('/serah-terima/fetch', 'SerahTerimaController@fetch')->name('SerahTerima.fetch');
        Route::post('/serah-terima/edit/{id}=update', 'SerahTerimaController@update');
        Route::get('/serah-terima/edit/{id}', 'SerahTerimaController@redirect_update');
        Route::get('/serah-terima/delete/{id}', 'SerahTerimaController@delete');
        Route::get('/serah-terima/cari', 'SerahTerimaController@cari');
        Route::get('/jadwal/{id}', 'SerahTerimaController@getjadwal');
        // *END SIDEBAR
    });
    //*END SIDEBAR 
    //*SIDEBAR status terkahir
    Route::post('/status-terakhir/create', 'StatusController@create');
    Route::get('/status-terakhir', 'StatusController@read');
//*END SIDEBAR status
