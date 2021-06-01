<?php

namespace App\Http\Controllers;

use App\Devi;
use App\Client;
use App\Avoir;
use App\Facture;
use Illuminate\Support\Carbon;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class chartController extends Controller
{
    // public $year = 2021;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function myYear()
    {
        $year = Carbon::now()->format('Y');
        return $year;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function charteuro()
    {
        $user = auth()->user();
        $chart_factures = (new LarapexChart)->lineChart()
            //     ->addData('Total Factures', $this->factures_euro()->toArray())
            //     ->addData('Nombre Factures', $this->nombreFactures_euro()->toArray())
            //     ->setColors(['#ffc63b', '#ff6384'])
            //     ->setXAxis($this->getAllMonths_factures_euro());


            ->addData('Total Factures', [40, 93, 35, 42, 18, 82])
            ->addData('Nombre Factures', [70, 29, 77, 28, 55, 45])
            ->setColors(['#ffc63b', '#ff6384'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);



        $chart_devis = (new LarapexChart)->barChart()
            // ->addData('Total Devis', $this->devises_euro()->toArray())
            // ->addData('Nombre Devis', $this->nombredevis_euro()->toArray())
            // ->setColors(['#70C6FE', '#26E7A6'])
            // ->setXAxis($this->getAllMonths_devises_euro());


            ->addData('Total Devis', [6, 9, 3, 4, 10, 8])
            ->addData('Nombre Devis', [7, 3, 8, 2, 6, 4])
            ->setColors(['#70C6FE', '#26E7A6'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

        $chart_avoirs = (new LarapexChart)->horizontalBarChart()
            // ->addData('Total Avoirs', $this->avoirs_euro()->toArray())
            // ->addData('Nombre Avoirs', $this->nombre_avoirs_euro()->toArray())
            // ->setColors(['#FFC107', '#D32F2F'])
            // ->setXAxis($this->getAllMonths_avoirs_euro());


            ->addData('Total Avoirs', [6, 9, 3, 4, 10, 8])
            ->addData('Nombre Avoirs', [7, 3, 8, 2, 6, 4])
            ->setColors(['#FFC107', '#D32F2F'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);


        $chart_clients = (new LarapexChart)->donutChart()
            // ->addData($this->nombreclients()->toArray())
            // ->setLabels($this->getAllMonths_clients());


            ->addData([20, 24, 30, 24, 12, 87])
            ->setLabels(['January', 'February', 'March', 'April', 'May', 'June']);


        $chart_chiffre_affaire = (new LarapexChart)->areaChart()
            ->addData('chiffre affaire', [40, 93, 35, 42, 18, 82])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June'])
            ->setGrid();


        return view('dashboard.chartseuro')->with('chart_factures', $chart_factures)->with('user', $user)->with('chart_devis', $chart_devis)->with('chart_clients', $chart_clients)->with('chart_avoirs', $chart_avoirs)->with('chart_chiffre_affaire', $chart_chiffre_affaire);
    }
    function getAllMonths_factures_euro()
    {
        $user = auth()->user();
        $month_array = array();
        // ($) (€) (DH)
        $pulse_dates = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Payée')->where('devis', '(€)')->where('user_id', $user->id)->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates)) {
            foreach ($pulse_dates as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_name] = $month_no;
            }
        }
        $keys = array_keys($month_array);
        // dd($keys);
        return $keys;
    }
    function factures_euro()
    {
        $user = auth()->user();
        $total_facture_monthly = Facture::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Payée')->where('devis', '(€)')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        // dump($total_facture_monthly);
        return $total_facture_monthly;
    }
    function nombreFactures_euro()
    {
        $user = auth()->user();
        $total_factures_monthly = Facture::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->where('devis', '(€)')->orderBy('borrowMonth', 'asc')->pluck('total');
        //  dump($total_factures_monthly);
        return $total_factures_monthly;
    }
    //charts for devis
    function getAllMonths_devises_euro()
    {
        $user = auth()->user();
        $month_array = array();
        // $pulse_dates = Devi::orderBy('created_at', 'ASC')->whereYear('created_at', $this->year)->where('etat_devis', 'Finalisé')->orWhere('etat_devis', 'Signés')->where('user_id', $user->id)->pluck('created_at');
        $pulse_dates = Devi::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_devis', 'Signés')->where('devis', '(€)')->where('user_id', $user->id)->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates)) {
            foreach ($pulse_dates as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_name] = $month_no;
            }
        }
        $keys = array_keys($month_array);
        // dump($keys);
        return $keys;
    }
    function devises_euro()
    {
        $user = auth()->user();
        $total_devi_monthly = Devi::selectRaw('SUM(total_ht_apres_remise_gendf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_devis', 'Signés')->where('devis', '(€)')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'ASC')->pluck('som');
        // dd($total_devi_monthly);
        return $total_devi_monthly;
    }
    function nombredevis_euro()
    {
        $user = auth()->user();
        $total_devis_monthly = Devi::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->where('devis', '(€)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dump($total_devis_monthly);
        return $total_devis_monthly;
    }


    function getAllMonths_avoirs_euro()
    {
        $user = auth()->user();
        $month_array = array();
        // ($) (€) (DH)
        $pulse_dates = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Remboursé')->where('devis', '(€)')->where('user_id', $user->id)->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates)) {
            foreach ($pulse_dates as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_name] = $month_no;
            }
        }
        $keys = array_keys($month_array);
        // dd($keys);
        return $keys;
    }
    function avoirs_euro()
    {
        $user = auth()->user();
        $total_avoir_monthly = Avoir::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Remboursé')->where('devis', '(€)')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        // dump($total_avoir_monthly);
        return $total_avoir_monthly;
    }
    function nombre_avoirs_euro()
    {
        $user = auth()->user();
        $total_avoirs_monthly = Avoir::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->where('devis', '(€)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dump($total_avoirs_monthly);
        return $total_avoirs_monthly;
    }

    // function chiffre_affaire_euro()
    // {
    //     $user = auth()->user();
    //     $total_facture_monthly = Facture::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Payée')->where('devis', '(€)')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
    //     $total_avoir_monthly = Avoir::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Remboursé')->where('devis', '(€)')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');

    // }



    public function chartdollar()
    {
        $user = auth()->user();
        $chart_factures = (new LarapexChart)->lineChart()
            // ->addData('Total Factures', $this->factures_dollar()->toArray())
            // ->addData('Nombre Factures', $this->nombreFactures_dollar()->toArray())
            // ->setColors(['#ffc63b', '#ff6384'])
            // ->setXAxis($this->getAllMonths_factures_dollar());


            ->addData('Total Factures', [12, 33, 42, 32, 81, 21])
            ->addData('Nombre Factures', [26, 19, 77, 58, 35, 95])
            ->setColors(['#ffc63b', '#ff6384'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);



        $chart_devis = (new LarapexChart)->barChart()
            // ->addData('Total Devis', $this->devises_dollar()->toArray())
            // ->addData('Nombre Devis', $this->nombredevis_dollar()->toArray())
            // ->setColors(['#70C6FE', '#26E7A6'])
            // ->setXAxis($this->getAllMonths_devises_dollar());

            ->addData('Total Devis', [61, 92, 32, 43, 20, 18])
            ->addData('Nombre Devis', [71, 32, 83, 22, 32, 41])
            ->setColors(['#70C6FE', '#26E7A6'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

        $chart_avoirs = (new LarapexChart)->horizontalBarChart()
            // ->addData('Total Avoirs', $this->avoirs_dollar()->toArray())
            // ->addData('Nombre Avoirs', $this->nombre_avoirs_dollar()->toArray())
            // ->setColors(['#FFC107', '#D32F2F'])
            // ->setXAxis($this->getAllMonths_avoirs_dollar());


            ->addData('Total Avoirs', [64, 92, 34, 43, 12, 87])
            ->addData('Nombre Avoirs', [72, 33, 8, 23, 16, 43])
            ->setColors(['#FFC107', '#D32F2F'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

        $chart_clients = (new LarapexChart)->donutChart()
            // ->addData($this->nombreclients()->toArray())
            // ->setLabels($this->getAllMonths_clients());


            ->addData([20, 23, 30, 14, 89, 37])
            ->setLabels(['January', 'February', 'March', 'April', 'May', 'June']);

        $chart_chiffre_affaire = (new LarapexChart)->areaChart()
            ->addData('chiffre affaire', [20, 33, 65, 12, 68, 32])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June'])
            ->setGrid();



        return view('dashboard.chartsdollar')->with('chart_factures', $chart_factures)->with('user', $user)->with('chart_devis', $chart_devis)->with('chart_clients', $chart_clients)->with('chart_avoirs', $chart_avoirs)->with('chart_chiffre_affaire', $chart_chiffre_affaire);
    }
    function getAllMonths_factures_dollar()
    {
        $user = auth()->user();
        $month_array = array();
        // ($) (€) (DH)
        $pulse_dates = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Payée')->where('devis', '($)')->where('user_id', $user->id)->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates)) {
            foreach ($pulse_dates as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_name] = $month_no;
            }
        }
        $keys = array_keys($month_array);
        // dd($keys);
        return $keys;
    }
    function factures_dollar()
    {
        $user = auth()->user();
        $total_facture_monthly = Facture::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Payée')->where('devis', '($)')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        // dd($total_facture_monthly);
        return $total_facture_monthly;
    }
    //charts for devis
    function getAllMonths_devises_dollar()
    {
        $user = auth()->user();
        $month_array = array();
        // $pulse_dates = Devi::orderBy('created_at', 'ASC')->whereYear('created_at', $this->year)->where('etat_devis', 'Finalisé')->orWhere('etat_devis', 'Signés')->where('user_id', $user->id)->pluck('created_at');
        $pulse_dates = Devi::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_devis', 'Signés')->where('devis', '($)')->where('user_id', $user->id)->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates)) {
            foreach ($pulse_dates as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_name] = $month_no;
            }
        }
        $keys = array_keys($month_array);
        // dump($keys);
        return $keys;
    }
    function devises_dollar()
    {
        $user = auth()->user();
        $total_devi_monthly = Devi::selectRaw('SUM(total_ht_apres_remise_gendf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_devis', 'Signés')->where('devis', '($)')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'ASC')->pluck('som');
        // dd($total_devi_monthly);
        return $total_devi_monthly;
    }
    function nombredevis_dollar()
    {
        $user = auth()->user();
        $total_devis_monthly = Devi::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->where('devis', '($)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dump($total_devis_monthly);
        return $total_devis_monthly;
    }
    function nombreFactures_dollar()
    {
        $user = auth()->user();
        $total_factures_monthly = Facture::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->where('devis', '($)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dump($total_factures_monthly);
        return $total_factures_monthly;
    }

    function getAllMonths_avoirs_dollar()
    {
        $user = auth()->user();
        $month_array = array();
        // ($) (€) (DH)
        $pulse_dates = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Remboursé')->where('devis', '($)')->where('user_id', $user->id)->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates)) {
            foreach ($pulse_dates as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_name] = $month_no;
            }
        }
        $keys = array_keys($month_array);
        // dd($keys);
        return $keys;
    }
    function avoirs_dollar()
    {
        $user = auth()->user();
        $total_avoir_monthly = Avoir::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Remboursé')->where('devis', '($)')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        // dd($total_facture_monthly);
        return $total_avoir_monthly;
    }
    function nombre_avoirs_dollar()
    {
        $user = auth()->user();
        $total_avoirs_monthly = Avoir::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->where('devis', '($)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dump($total_factures_monthly);
        return $total_avoirs_monthly;
    }



    public function chartdirham()
    {
        $user = auth()->user();
        $chart_factures = (new LarapexChart)->lineChart()
            // ->addData('Total Factures', $this->factures_dirham()->toArray())
            // ->addData('Nombre Factures', $this->nombreFactures_dirham()->toArray())
            // ->setColors(['#ffc63b', '#ff6384'])
            // ->setXAxis($this->getAllMonths_factures_dirham());

            ->addData('Total Factures', [44, 13, 32, 52, 85, 12])
            ->addData('Nombre Factures', [70, 19, 47, 78, 25, 65])
            ->setColors(['#ffc63b', '#ff6384'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);



        $chart_devis = (new LarapexChart)->barChart()
            // ->addData('Total Devis', $this->devises_dirham()->toArray())
            // ->addData('Nombre Devis', $this->nombredevis_dirham()->toArray())
            // ->setColors(['#70C6FE', '#26E7A6'])
            // ->setXAxis($this->getAllMonths_devises_dirham());


            ->addData('Total Devis', [64, 92, 33, 64, 10, 18])
            ->addData('Nombre Devis', [75, 32, 85, 22, 6, 44])
            ->setColors(['#70C6FE', '#26E7A6'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

        $chart_clients = (new LarapexChart)->donutChart()
            // ->addData($this->nombreclients()->toArray())
            // ->setLabels($this->getAllMonths_clients());


            ->addData([20, 14, 30, 44, 12, 17])
            ->setLabels(['January', 'February', 'March', 'April', 'May', 'June']);

        $chart_avoirs = (new LarapexChart)->horizontalBarChart()
            // ->addData('Total Avoirs', $this->avoirs_dirham()->toArray())
            // ->addData('Nombre Avoirs', $this->nombre_avoirs_dirham()->toArray())
            // ->setColors(['#FFC107', '#D32F2F'])
            // ->setXAxis($this->getAllMonths_avoirs_dirham());


            ->addData('Total Avoirs ', [61, 93, 34, 54, 20, 28])
            ->addData('Nombre Avoirs', [27, 36, 83, 22, 26, 44])
            ->setColors(['#FFC107', '#D32F2F'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

        $chart_chiffre_affaire = (new LarapexChart)->areaChart()
            ->addData('chiffre affaire', [45, 33, 53, 63, 12, 63])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June'])
            ->setGrid();

        return view('dashboard.chartsdirham')->with('chart_factures', $chart_factures)->with('user', $user)->with('chart_devis', $chart_devis)->with('chart_clients', $chart_clients)->with('chart_avoirs', $chart_avoirs)->with('chart_chiffre_affaire', $chart_chiffre_affaire);
    }
    function getAllMonths_factures_dirham()
    {
        $user = auth()->user();
        $month_array = array();
        // ($) (€) (DH)
        $pulse_dates = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Payée')->where('devis', '(DH)')->where('user_id', $user->id)->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates)) {
            foreach ($pulse_dates as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_name] = $month_no;
            }
        }
        $keys = array_keys($month_array);
        // dd($keys);
        return $keys;
    }
    function factures_dirham()
    {
        $user = auth()->user();
        $total_facture_monthly = Facture::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Payée')->where('devis', '(DH)')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        // dd($total_facture_monthly);
        return $total_facture_monthly;
    }
    //charts for devis
    function getAllMonths_devises_dirham()
    {
        $user = auth()->user();
        $month_array = array();
        // $pulse_dates = Devi::orderBy('created_at', 'ASC')->whereYear('created_at', $this->year)->where('etat_devis', 'Finalisé')->orWhere('etat_devis', 'Signés')->where('user_id', $user->id)->pluck('created_at');
        $pulse_dates = Devi::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_devis', 'Signés')->where('devis', '(DH)')->where('user_id', $user->id)->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates)) {
            foreach ($pulse_dates as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_name] = $month_no;
            }
        }
        $keys = array_keys($month_array);
        // dump($keys);
        return $keys;
    }
    function devises_dirham()
    {
        $user = auth()->user();
        $total_devi_monthly = Devi::selectRaw('SUM(total_ht_apres_remise_gendf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_devis', 'Signés')->where('devis', '(DH)')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'ASC')->pluck('som');
        // dd($total_devi_monthly);
        return $total_devi_monthly;
    }
    function nombredevis_dirham()
    {
        $user = auth()->user();
        $total_devis_monthly = Devi::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->where('devis', '(DH)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dump($total_devis_monthly);
        return $total_devis_monthly;
    }
    function nombreFactures_dirham()
    {
        $user = auth()->user();
        $total_factures_monthly = Facture::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->where('devis', '(DH)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dump($total_factures_monthly);
        return $total_factures_monthly;
    }
    function getAllMonths_avoirs_dirham()
    {
        $user = auth()->user();
        $month_array = array();
        // ($) (€) (DH)
        $pulse_dates = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Remboursé')->where('devis', '(DH)')->where('user_id', $user->id)->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates)) {
            foreach ($pulse_dates as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_name] = $month_no;
            }
        }
        $keys = array_keys($month_array);
        // dd($keys);
        return $keys;
    }
    function avoirs_dirham()
    {
        $user = auth()->user();
        $total_avoir_monthly = Avoir::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Remboursé')->where('devis', '(DH)')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        // dd($total_facture_monthly);
        return $total_avoir_monthly;
    }
    function nombre_avoirs_dirham()
    {
        $user = auth()->user();
        $total_avoirs_monthly = Avoir::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->where('devis', '(DH)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dump($total_factures_monthly);
        return $total_avoirs_monthly;
    }

    function getAllMonths_clients()
    {
        $user = auth()->user();
        $month_array = array();
        $pulse_dates = Client::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('user_id', $user->id)->pluck('created_at');
        if (!empty($pulse_dates)) {
            foreach ($pulse_dates as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_name] = $month_no;
            }
        }
        $keys = array_keys($month_array);
        return $keys;
    }
    function nombreclients()
    {
        $user = auth()->user();
        $total_client_monthly = Client::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('total');
        return $total_client_monthly;
    }

    function chiffre_affaire()
    {
        $user = auth()->user();
        return view('dashboard.chiffre_affaire')->with('user', $user);
    }
    function debours()
    {
        $user = auth()->user();
        $total_debours_facture_monthly_dirham = Facture::selectRaw('SUM(total_debours) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('devis', '(DH)')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_debours_avoir_monthly_dirham = Avoir::selectRaw('SUM(total_debours) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('devis', '(DH)')->where('user_id', $user->id)->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        dump($total_debours_facture_monthly_dirham);
        dump($total_debours_avoir_monthly_dirham);




        $month_array_facture_dh = array();
        $pulse_dates_facture_dh = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('devis', '(DH)')->where('user_id', $user->id)->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_facture_dh)) {
            foreach ($pulse_dates_facture_dh as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_facture_dh[$month_name] = $month_no;
            }
        }
        $keys_facture_dh = array_keys($month_array_facture_dh);
        dump($keys_facture_dh);


        $month_array_avoir_dh = array();
        $pulse_dates_avoir_dh = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('devis', '(DH)')->where('user_id', $user->id)->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_avoir_dh)) {
            foreach ($pulse_dates_avoir_dh as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_avoir_dh[$month_name] = $month_no;
            }
        }
        $keys_avoir_dh = array_keys($month_array_avoir_dh);
        dump($keys_avoir_dh);

        return view('dashboard.debours')->with('user', $user)->with('total_debours_facture_monthly_dirham', $total_debours_facture_monthly_dirham)->with('total_debours_avoir_monthly_dirham', $total_debours_avoir_monthly_dirham)->with('keys_facture_dh', $keys_facture_dh)->with('keys_avoir_dh', $keys_avoir_dh);
    }
}
