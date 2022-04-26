<?php

namespace App\Controllers;

use App\Models\Dogadjaji;
use App\Models\Oglasi;
use App\Models\Tabels;
use App\Models\User;
use App\Models\Vesti;

class Home extends BaseController
{
    
    public function index()
    {   
        /**init */
        $dogadjaj_model = new Dogadjaji();
        $users_model = new User();
        $vesti_model = new Vesti();
        $oglasi_model = new Oglasi();
        $kat_model = new Tabels();

        /**search vars from guest view for events*/
        $mesto_search = $this->request->getVar('mestoNaziv') ?? '';
        $kat_search = $this->request->getVar('column') ?? '';
        $datum_search = $this->request->getVar('searchDatum') ?? '';
        
        /**get */
        $res_dog = $dogadjaj_model->get_all_events($mesto_search,$kat_search,$datum_search);
        $res_user = $users_model->get_all_users();
        $nearest_dates = $dogadjaj_model->nearest_dates();
        $res_vesti = $vesti_model->get_all_news();
        $res_oglasi = $oglasi_model->get_all_ads();
        $get_kat = $kat_model->get_table('kategorije',false);
        $mesto_model = new Tabels();
        $get_mesto = $mesto_model->get_table('mesto',false);
        
        /**send */
        return view('guest/home',['dogadjaj' => $res_dog,'users' => $res_user,'dates' => $nearest_dates,'vesti' => $res_vesti,'oglasi' => $res_oglasi,'kategorije' => $get_kat,'mesto' => $get_mesto]);
    }
    public function terms()
    {
        return view('guest/terms');
    }
    
}
