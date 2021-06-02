<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Devi;
use App\Client;
use App\Avoir;
use App\Facture;
use Illuminate\Support\Carbon;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DashApplicationController extends Controller
{

    // public $year = 2021;

    public function __construct()
    {
        $this->middleware(['is.admin']);
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
        $chart_factures = (new LarapexChart)->lineChart()
            // ->addData('Total Factures', $this->factures_euro()->toArray())
            // ->addData('Nombre Factures', $this->nombreFactures_euro()->toArray())
            // ->setColors(['#ffc63b', '#ff6384'])
            // ->setXAxis($this->getAllMonths_factures_euro());


            ->addData('Total Factures', [12, 73, 21, 93, 52, 59])
            ->addData('Nombre Factures', [70, 12, 77, 9, 55, 90])
            ->setColors(['#ffc63b', '#ff6384'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);



        $chart_devis = (new LarapexChart)->barChart()
            // ->addData('Total Devis', $this->devises_euro()->toArray())
            // ->addData('Nombre Devis', $this->nombredevis_euro()->toArray())
            // ->setColors(['#70C6FE', '#26E7A6'])
            // ->setXAxis($this->getAllMonths_devises_euro());


            ->addData('Total Devis', [6, 29, 3, 43, 10, 63])
            ->addData('Nombre Devis', [7, 53, 8, 15, 6, 48])
            ->setColors(['#70C6FE', '#26E7A6'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

        $chart_avoirs = (new LarapexChart)->horizontalBarChart()
            // ->addData('Total Avoirs', $this->avoirs_euro()->toArray())
            // ->addData('Nombre Avoirs', $this->nombre_avoirs_euro()->toArray())
            // ->setColors(['#FFC107', '#D32F2F'])
            // ->setXAxis($this->getAllMonths_avoirs_euro());


            ->addData('Total Avoirs', [6, 26, 3, 43, 10, 22])
            ->addData('Nombre Avoirs', [7, 22, 81, 21, 63, 12])
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


        return view('dashboard_application.chartseuro')->with('chart_factures', $chart_factures)->with('chart_devis', $chart_devis)->with('chart_clients', $chart_clients)->with('chart_avoirs', $chart_avoirs)->with('chart_chiffre_affaire', $chart_chiffre_affaire);
    }

    //charteuro for facture
    function factures_euro()
    {
        $total_facture_monthly = Facture::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Payée')->where('devis', '(€)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        // dd($total_facture_monthly);
        return $total_facture_monthly;
    }
    function nombreFactures_euro()
    {
        $total_factures_monthly = Facture::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->whereYear('created_at', $this->myYear())->where('devis', '(€)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dd($total_factures_monthly);
        return $total_factures_monthly;
    }
    function getAllMonths_factures_euro()
    {
        $month_array = array();
        // ($) (€) (DH)
        $pulse_dates = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Payée')->where('devis', '(€)')->pluck('created_at');
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

    //charts for devis
    function devises_euro()
    {
        $total_devi_monthly = Devi::selectRaw('SUM(total_ht_apres_remise_gendf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_devis', 'Signés')->where('devis', '(€)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'ASC')->pluck('som');
        // dd($total_devi_monthly);
        return $total_devi_monthly;
    }
    function nombredevis_euro()
    {
        $total_devis_monthly = Devi::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->whereYear('created_at', $this->myYear())->where('devis', '(€)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dd($total_devis_monthly);
        return $total_devis_monthly;
    }
    function getAllMonths_devises_euro()
    {
        $month_array = array();
        $pulse_dates = Devi::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_devis', 'Signés')->where('devis', '(€)')->pluck('created_at');
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


    // charteuro for avoir
    function avoirs_euro()
    {
        $total_avoir_monthly = Avoir::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Remboursé')->where('devis', '(€)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        // dd($total_avoir_monthly);
        return $total_avoir_monthly;
    }
    function nombre_avoirs_euro()
    {
        $total_avoirs_monthly = Avoir::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->whereYear('created_at', $this->myYear())->where('devis', '(€)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dd($total_avoirs_monthly);
        return $total_avoirs_monthly;
    }
    function getAllMonths_avoirs_euro()
    {
        $month_array = array();
        // ($) (€) (DH)
        $pulse_dates = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Remboursé')->where('devis', '(€)')->pluck('created_at');
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


    public function chartdollar()
    {
        $chart_factures = (new LarapexChart)->lineChart()
            // ->addData('Total Factures', $this->factures_dollar()->toArray())
            // ->addData('Nombre Factures', $this->nombreFactures_dollar()->toArray())
            // ->setColors(['#ffc63b', '#ff6384'])
            // ->setXAxis($this->getAllMonths_factures_dollar());


            ->addData('Total Factures', [12, 23, 42, 12, 81, 28])
            ->addData('Nombre Factures', [26, 91, 77, 15, 35, 55])
            ->setColors(['#ffc63b', '#ff6384'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);



        $chart_devis = (new LarapexChart)->barChart()
            // ->addData('Total Devis', $this->devises_dollar()->toArray())
            // ->addData('Nombre Devis', $this->nombredevis_dollar()->toArray())
            // ->setColors(['#70C6FE', '#26E7A6'])
            // ->setXAxis($this->getAllMonths_devises_dollar());

            ->addData('Total Devis', [61, 45, 32, 33, 20, 78])
            ->addData('Nombre Devis', [71, 22, 83, 53, 32, 31])
            ->setColors(['#70C6FE', '#26E7A6'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

        $chart_avoirs = (new LarapexChart)->horizontalBarChart()
            // ->addData('Total Avoirs', $this->avoirs_dollar()->toArray())
            // ->addData('Nombre Avoirs', $this->nombre_avoirs_dollar()->toArray())
            // ->setColors(['#FFC107', '#D32F2F'])
            // ->setXAxis($this->getAllMonths_avoirs_dollar());


            ->addData('Total Avoirs', [64, 42, 34, 53, 12, 47])
            ->addData('Nombre Avoirs', [72, 23, 8, 43, 16, 33])
            ->setColors(['#FFC107', '#D32F2F'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

        $chart_clients = (new LarapexChart)->donutChart()
            // ->addData($this->nombreclients()->toArray())
            // ->setLabels($this->getAllMonths_clients());


            ->addData([22, 21, 10, 34, 21, 42])
            ->setLabels(['January', 'February', 'March', 'April', 'May', 'June']);

        $chart_chiffre_affaire = (new LarapexChart)->areaChart()
            ->addData('chiffre affaire', [20, 23, 65, 32, 68, 22])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June'])
            ->setGrid();



        return view('dashboard_application.chartsdollar')->with('chart_factures', $chart_factures)->with('chart_devis', $chart_devis)->with('chart_clients', $chart_clients)->with('chart_avoirs', $chart_avoirs)->with('chart_chiffre_affaire', $chart_chiffre_affaire);
    }
    //chartdollar for facture
    function factures_dollar()
    {

        $total_facture_monthly = Facture::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Payée')->where('devis', '($)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        // dd($total_facture_monthly);
        return $total_facture_monthly;
    }
    function nombreFactures_dollar()
    {

        $total_factures_monthly = Facture::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->whereYear('created_at', $this->myYear())->where('devis', '($)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dd($total_factures_monthly);
        return $total_factures_monthly;
    }
    function getAllMonths_factures_dollar()
    {
        $month_array = array();
        // ($) (€) (DH)
        $pulse_dates = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Payée')->where('devis', '($)')->pluck('created_at');
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
    //chartdollar for devis
    function devises_dollar()
    {
        $total_devi_monthly = Devi::selectRaw('SUM(total_ht_apres_remise_gendf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_devis', 'Signés')->where('devis', '($)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'ASC')->pluck('som');
        // dd($total_devi_monthly);
        return $total_devi_monthly;
    }
    function nombredevis_dollar()
    {
        $total_devis_monthly = Devi::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->whereYear('created_at', $this->myYear())->where('devis', '($)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dd($total_devis_monthly);
        return $total_devis_monthly;
    }
    function getAllMonths_devises_dollar()
    {

        $month_array = array();
        $pulse_dates = Devi::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_devis', 'Signés')->where('devis', '($)')->pluck('created_at');
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

    //chartdollar for avoir
    function avoirs_dollar()
    {
        $total_avoir_monthly = Avoir::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Remboursé')->where('devis', '($)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        // dd($total_avoir_monthly);
        return $total_avoir_monthly;
    }
    function nombre_avoirs_dollar()
    {
        $total_avoirs_monthly = Avoir::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->whereYear('created_at', $this->myYear())->where('devis', '($)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dd($total_avoirs_monthly);
        return $total_avoirs_monthly;
    }
    function getAllMonths_avoirs_dollar()
    {
        $month_array = array();
        // ($) (€) (DH)
        $pulse_dates = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Remboursé')->where('devis', '($)')->pluck('created_at');
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




    public function chartdirham()
    {

        $chart_factures = (new LarapexChart)->lineChart()
            // ->addData('Total Factures', $this->factures_dirham()->toArray())
            // ->addData('Nombre Factures', $this->nombreFactures_dirham()->toArray())
            // ->setColors(['#ffc63b', '#ff6384'])
            // ->setXAxis($this->getAllMonths_factures_dirham());

            ->addData('Total Factures', [73, 23, 63, 5, 71, 10])
            ->addData('Nombre Factures', [12, 02, 72, 42, 31, 52])
            ->setColors(['#ffc63b', '#ff6384'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);



        $chart_devis = (new LarapexChart)->barChart()
            // ->addData('Total Devis', $this->devises_dirham()->toArray())
            // ->addData('Nombre Devis', $this->nombredevis_dirham()->toArray())
            // ->setColors(['#70C6FE', '#26E7A6'])
            // ->setXAxis($this->getAllMonths_devises_dirham());


            ->addData('Total Devis', [83, 62, 11, 52, 21, 51])
            ->addData('Nombre Devis', [21, 82, 24, 23, 03, 90])
            ->setColors(['#70C6FE', '#26E7A6'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

        $chart_clients = (new LarapexChart)->donutChart()
            // ->addData($this->nombreclients()->toArray())
            // ->setLabels($this->getAllMonths_clients());


            ->addData([22, 64, 10, 42, 21, 12])
            ->setLabels(['January', 'February', 'March', 'April', 'May', 'June']);

        $chart_avoirs = (new LarapexChart)->horizontalBarChart()
            // ->addData('Total Avoirs', $this->avoirs_dirham()->toArray())
            // ->addData('Nombre Avoirs', $this->nombre_avoirs_dirham()->toArray())
            // ->setColors(['#FFC107', '#D32F2F'])
            // ->setXAxis($this->getAllMonths_avoirs_dirham());


            ->addData('Total Avoirs ', [12, 23, 98, 53, 42, 13])
            ->addData('Nombre Avoirs', [63, 33, 53, 22, 35, 90])
            ->setColors(['#FFC107', '#D32F2F'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

        $chart_chiffre_affaire = (new LarapexChart)->areaChart()
            ->addData('chiffre affaire', [45, 12, 53, 90, 12, 52])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June'])
            ->setGrid();

        return view('dashboard_application.chartsdirham')->with('chart_factures', $chart_factures)->with('chart_devis', $chart_devis)->with('chart_clients', $chart_clients)->with('chart_avoirs', $chart_avoirs)->with('chart_chiffre_affaire', $chart_chiffre_affaire);
    }

    //chartdirham for  facture
    function factures_dirham()
    {
        $total_facture_monthly = Facture::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Payée')->where('devis', '(DH)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        return $total_facture_monthly;
    }
    function nombreFactures_dirham()
    {

        $total_factures_monthly = Facture::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->whereYear('created_at', $this->myYear())->where('devis', '(DH)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dd($total_factures_monthly);
        return $total_factures_monthly;
    }
    function getAllMonths_factures_dirham()
    {
        $month_array = array();

        $pulse_dates = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Payée')->where('devis', '(DH)')->pluck('created_at');
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

    //chartdirham  for devis
    function devises_dirham()
    {

        $total_devi_monthly = Devi::selectRaw('SUM(total_ht_apres_remise_gendf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_devis', 'Signés')->where('devis', '(DH)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'ASC')->pluck('som');
        // dd($total_devi_monthly);
        return $total_devi_monthly;
    }
    function nombredevis_dirham()
    {
        $total_devis_monthly = Devi::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->whereYear('created_at', $this->myYear())->where('devis', '(DH)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dd($total_devis_monthly);
        return $total_devis_monthly;
    }
    function getAllMonths_devises_dirham()
    {

        $month_array = array();
        $pulse_dates = Devi::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_devis', 'Signés')->where('devis', '(DH)')->pluck('created_at');
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

    //chartdirham for avoir
    function avoirs_dirham()
    {
        $total_avoir_monthly = Avoir::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Remboursé')->where('devis', '(DH)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        // dd($total_avoir_monthly);
        return $total_avoir_monthly;
    }
    function nombre_avoirs_dirham()
    {

        $total_avoirs_monthly = Avoir::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->whereYear('created_at', $this->myYear())->where('devis', '(DH)')->orderBy('borrowMonth', 'asc')->pluck('total');
        // dd($total_avoirs_monthly);
        return $total_avoirs_monthly;
    }

    function getAllMonths_avoirs_dirham()
    {

        $month_array = array();
        $pulse_dates = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Remboursé')->where('devis', '(DH)')->pluck('created_at');
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

    // chart  for clients
    function nombreclients()
    {

        $total_client_monthly = Client::selectRaw('COUNT(id) as total, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('total');
        // dd($total_client_monthly);
        return $total_client_monthly;
    }
    function getAllMonths_clients()
    {
        $month_array = array();
        $pulse_dates = Client::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->pluck('created_at');
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

    function chiffre_affaire()
    {
        $total_facture_monthly_dirham = Facture::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('devis', '(DH)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_avoir_monthly_dirham = Avoir::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('devis', '(DH)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_facture_monthly_euro = Facture::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('devis', '(€)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_avoir_monthly_euro = Avoir::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('devis', '(€)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_facture_monthly_dollar = Facture::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('devis', '($)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_avoir_monthly_dollar = Avoir::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('devis', '($)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        // dump($total_facture_monthly_dirham);
        // dump($total_avoir_monthly_dirham);
        // dump($total_facture_monthly_euro);
        // dump($total_avoir_monthly_euro);
        // dump($total_facture_monthly_dollar);
        // dump($total_avoir_monthly_dollar);

        $month_array_facture_dirham = array();
        $pulse_dates_facture_dirham = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('devis', '(DH)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_facture_dirham)) {
            foreach ($pulse_dates_facture_dirham as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_facture_dirham[$month_name] = $month_no;
            }
        }
        $keys_facture_dirham = array_keys($month_array_facture_dirham);
        // dump($keys_facture_dirham);


        $month_array_avoir_dirham = array();
        $pulse_dates_avoir_dirham = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('devis', '(DH)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_avoir_dirham)) {
            foreach ($pulse_dates_avoir_dirham as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_avoir_dirham[$month_name] = $month_no;
            }
        }
        $keys_avoir_dirham = array_keys($month_array_avoir_dirham);
        // dump($keys_avoir_dirham);


        $month_array_facture_euro = array();
        $pulse_dates_facture_euro = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('devis', '(€)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_facture_euro)) {
            foreach ($pulse_dates_facture_euro as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_facture_euro[$month_name] = $month_no;
            }
        }
        $keys_facture_euro = array_keys($month_array_facture_euro);
        // dump($keys_facture_euro);


        $month_array_avoir_euro = array();
        $pulse_dates_avoir_euro = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('devis', '(€)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_avoir_euro)) {
            foreach ($pulse_dates_avoir_euro as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_avoir_euro[$month_name] = $month_no;
            }
        }
        $keys_avoir_euro = array_keys($month_array_avoir_euro);
        // dump($keys_avoir_euro);

        $month_array_facture_dollar = array();
        $pulse_dates_facture_dollar = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('devis', '($)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_facture_dollar)) {
            foreach ($pulse_dates_facture_dollar as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_facture_dollar[$month_name] = $month_no;
            }
        }
        $keys_facture_dollar = array_keys($month_array_facture_dollar);
        // dump($keys_facture_dollar);


        $month_array_avoir_dollar = array();
        $pulse_dates_avoir_dollar = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('devis', '($)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_avoir_dollar)) {
            foreach ($pulse_dates_avoir_dollar as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_avoir_dollar[$month_name] = $month_no;
            }
        }
        $keys_avoir_dollar = array_keys($month_array_avoir_dollar);
        // dump($keys_avoir_dollar);

        // die();
        return view('dashboard_application.chiffre_affaire')->with('total_facture_monthly_dirham', $total_facture_monthly_dirham)->with('total_avoir_monthly_dirham', $total_avoir_monthly_dirham)
            ->with('total_facture_monthly_euro', $total_facture_monthly_euro)->with('total_avoir_monthly_euro', $total_avoir_monthly_euro)
            ->with('keys_facture_dirham', $keys_facture_dirham)->with('keys_avoir_dirham', $keys_avoir_dirham)
            ->with('keys_facture_euro', $keys_facture_euro)->with('keys_avoir_euro', $keys_avoir_euro)
            ->with('total_facture_monthly_dollar', $total_facture_monthly_dollar)->with('total_avoir_monthly_dollar', $total_avoir_monthly_dollar)
            ->with('keys_facture_dollar', $keys_facture_dollar)->with('keys_avoir_dollar', $keys_avoir_dollar);
    }
    function debours()
    {
        $total_debours_facture_monthly_dirham = Facture::selectRaw('SUM(total_debours) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('devis', '(DH)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_debours_avoir_monthly_dirham = Avoir::selectRaw('SUM(total_debours) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('devis', '(DH)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_debours_facture_monthly_dollar = Facture::selectRaw('SUM(total_debours) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('devis', '($)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_debours_avoir_monthly_dollar = Avoir::selectRaw('SUM(total_debours) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('devis', '($)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_debours_facture_monthly_euro = Facture::selectRaw('SUM(total_debours) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('devis', '(€)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_debours_avoir_monthly_euro = Avoir::selectRaw('SUM(total_debours) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('devis', '(€)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        // dump($total_debours_facture_monthly_dirham);
        // dump($total_debours_avoir_monthly_dirham);
        // dump($total_debours_avoir_monthly_dollar);
        // dump($total_debours_facture_monthly_dollar);
        // dump($total_debours_avoir_monthly_euro);
        // dump($total_debours_facture_monthly_euro);





        $month_array_facture_dirham = array();
        $pulse_dates_facture_dirham = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('devis', '(DH)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_facture_dirham)) {
            foreach ($pulse_dates_facture_dirham as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_facture_dirham[$month_name] = $month_no;
            }
        }
        $keys_facture_dirham = array_keys($month_array_facture_dirham);
        // dump($keys_facture_dirham);


        $month_array_avoir_dirham = array();
        $pulse_dates_avoir_dirham = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('devis', '(DH)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_avoir_dirham)) {
            foreach ($pulse_dates_avoir_dirham as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_avoir_dirham[$month_name] = $month_no;
            }
        }
        $keys_avoir_dirham = array_keys($month_array_avoir_dirham);
        // dump($keys_avoir_dirham);


        $month_array_facture_dollar = array();
        $pulse_dates_facture_dollar = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('devis', '($)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_facture_dollar)) {
            foreach ($pulse_dates_facture_dollar as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_facture_dollar[$month_name] = $month_no;
            }
        }
        $keys_facture_dollar = array_keys($month_array_facture_dollar);
        // dump($keys_facture_dollar);


        $month_array_avoir_dollar = array();
        $pulse_dates_avoir_dollar = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('devis', '($)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_avoir_dollar)) {
            foreach ($pulse_dates_avoir_dollar as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_avoir_dollar[$month_name] = $month_no;
            }
        }
        $keys_avoir_dollar = array_keys($month_array_avoir_dollar);
        // dump($keys_avoir_dollar);


        $month_array_facture_euro = array();
        $pulse_dates_facture_euro = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('devis', '(€)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_facture_euro)) {
            foreach ($pulse_dates_facture_euro as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_facture_euro[$month_name] = $month_no;
            }
        }
        $keys_facture_euro = array_keys($month_array_facture_euro);
        // dump($keys_facture_euro);


        $month_array_avoir_euro = array();
        $pulse_dates_avoir_euro = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('devis', '(€)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_avoir_euro)) {
            foreach ($pulse_dates_avoir_euro as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_avoir_euro[$month_name] = $month_no;
            }
        }
        $keys_avoir_euro = array_keys($month_array_avoir_euro);
        // dump($keys_avoir_euro);
        // die();


        return view('dashboard_application.debours')->with('total_debours_facture_monthly_dirham', $total_debours_facture_monthly_dirham)->with('total_debours_avoir_monthly_dirham', $total_debours_avoir_monthly_dirham)->with('keys_facture_dirham', $keys_facture_dirham)->with('keys_avoir_dirham', $keys_avoir_dirham)
            ->with('total_debours_facture_monthly_dollar', $total_debours_facture_monthly_dollar)->with('total_debours_avoir_monthly_dollar', $total_debours_avoir_monthly_dollar)
            ->with('keys_facture_dollar', $keys_facture_dollar)->with('keys_avoir_dollar', $keys_avoir_dollar)
            ->with('total_debours_facture_monthly_euro', $total_debours_facture_monthly_euro)->with('total_debours_avoir_monthly_euro', $total_debours_avoir_monthly_euro)
            ->with('keys_facture_euro', $keys_facture_euro)->with('keys_avoir_euro', $keys_avoir_euro);
    }

    public function encaissement()
    {

        $total_facture_monthly_dirham = Facture::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Payée')->where('devis', '(DH)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_avoir_monthly_dirham = Avoir::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Remboursé')->where('devis', '(DH)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_facture_monthly_euro = Facture::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Payée')->where('devis', '(€)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_avoir_monthly_euro = Avoir::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Remboursé')->where('devis', '(€)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_facture_monthly_dollar = Facture::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Payée')->where('devis', '($)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        $total_avoir_monthly_dollar = Avoir::selectRaw('SUM(total_ht_apres_remise_genf) as som, MONTH(created_at) as borrowMonth')->groupBy('borrowMonth')->where('etat_facture', 'Remboursé')->where('devis', '($)')->whereYear('created_at', $this->myYear())->orderBy('borrowMonth', 'asc')->pluck('som');
        // dump($total_facture_monthly_dirham);
        // dump($total_avoir_monthly_dirham);
        // dump($total_facture_monthly_euro);
        // dump($total_avoir_monthly_euro);
        // dump($total_facture_monthly_dollar);
        // dump($total_avoir_monthly_dollar);

        $month_array_facture_dirham = array();
        $pulse_dates_facture_dirham = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Payée')->where('devis', '(DH)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_facture_dirham)) {
            foreach ($pulse_dates_facture_dirham as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_facture_dirham[$month_name] = $month_no;
            }
        }
        $keys_facture_dirham = array_keys($month_array_facture_dirham);
        // dump($keys_facture_dirham);


        $month_array_avoir_dirham = array();
        $pulse_dates_avoir_dirham = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Remboursé')->where('devis', '(DH)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_avoir_dirham)) {
            foreach ($pulse_dates_avoir_dirham as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_avoir_dirham[$month_name] = $month_no;
            }
        }
        $keys_avoir_dirham = array_keys($month_array_avoir_dirham);
        // dump($keys_avoir_dirham);


        $month_array_facture_euro = array();
        $pulse_dates_facture_euro = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Payée')->where('devis', '(€)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_facture_euro)) {
            foreach ($pulse_dates_facture_euro as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_facture_euro[$month_name] = $month_no;
            }
        }
        $keys_facture_euro = array_keys($month_array_facture_euro);
        // dump($keys_facture_euro);


        $month_array_avoir_euro = array();
        $pulse_dates_avoir_euro = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Remboursé')->where('devis', '(€)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_avoir_euro)) {
            foreach ($pulse_dates_avoir_euro as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_avoir_euro[$month_name] = $month_no;
            }
        }
        $keys_avoir_euro = array_keys($month_array_avoir_euro);
        // dump($keys_avoir_euro);

        $month_array_facture_dollar = array();
        $pulse_dates_facture_dollar = Facture::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Payée')->where('devis', '($)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_facture_dollar)) {
            foreach ($pulse_dates_facture_dollar as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_facture_dollar[$month_name] = $month_no;
            }
        }
        $keys_facture_dollar = array_keys($month_array_facture_dollar);
        // dump($keys_facture_dollar);


        $month_array_avoir_dollar = array();
        $pulse_dates_avoir_dollar = Avoir::orderBy('created_at', 'ASC')->whereYear('created_at', $this->myYear())->where('etat_facture', 'Remboursé')->where('devis', '($)')->pluck('created_at');
        // dd($pulse_dates);
        if (!empty($pulse_dates_avoir_dollar)) {
            foreach ($pulse_dates_avoir_dollar as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array_avoir_dollar[$month_name] = $month_no;
            }
        }
        $keys_avoir_dollar = array_keys($month_array_avoir_dollar);
        // dump($keys_avoir_dollar);

        // die();
        return view('dashboard_application.encaissements')->with('total_facture_monthly_dirham', $total_facture_monthly_dirham)->with('total_avoir_monthly_dirham', $total_avoir_monthly_dirham)
            ->with('total_facture_monthly_euro', $total_facture_monthly_euro)->with('total_avoir_monthly_euro', $total_avoir_monthly_euro)
            ->with('keys_facture_dirham', $keys_facture_dirham)->with('keys_avoir_dirham', $keys_avoir_dirham)
            ->with('keys_facture_euro', $keys_facture_euro)->with('keys_avoir_euro', $keys_avoir_euro)
            ->with('total_facture_monthly_dollar', $total_facture_monthly_dollar)->with('total_avoir_monthly_dollar', $total_avoir_monthly_dollar)
            ->with('keys_facture_dollar', $keys_facture_dollar)->with('keys_avoir_dollar', $keys_avoir_dollar);
    }

}
