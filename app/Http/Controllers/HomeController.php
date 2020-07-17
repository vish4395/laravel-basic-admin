<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $no_of_customer_wise_companies=$this->get_no_of_customer_wise_companies();
        $no_of_employees_wise_companies=$this->get_no_of_employees_wise_companies();
        $no_of_inventory_records_wise_companies=$this->get_no_of_inventory_records_wise_companies();
        $no_of_email_notifications_wise_companies=$this->get_no_of_email_notifications_wise_companies();
        $no_of_system_clients_city_wise=$this->get_no_of_system_clients_city_wise();
        $no_of_revenues_company_wise=$this->get_no_of_revenues_wise_companies();
        
        
        return view('home',compact('no_of_customer_wise_companies','no_of_employees_wise_companies','no_of_inventory_records_wise_companies','no_of_email_notifications_wise_companies','no_of_system_clients_city_wise','no_of_revenues_company_wise'));
    }

    public function get_no_of_customer_wise_companies(){

        $result = DB::table('company_clients')
        ->selectRaw("companies.id,companies.name as name, COUNT('company_clients.*') as total")
        ->join('companies', 'companies.id', '=', 'company_clients.company_id')
        ->groupBy('companies.id','companies.name')
        ->where('companies.deleted_at',NULL)
        ->where('company_clients.deleted_at',NULL)
        ->get();

          if($result->count()>0){
            foreach ($result as $key => $value) {
            $result_array['labels'][$key]=$value->name;
            $result_array['data'][$key]=$value->total;
        }
        }
        else{
            
            $result_array['labels']=array();
            $result_array['data']=array();
        }

        return $result_array;
    }

    public function get_no_of_employees_wise_companies(){
         $result_array=array();
        $result = DB::table('hrm_employees')
        ->selectRaw("companies.id,companies.name as name, COUNT('hrm_employees.*') as total")
        ->join('companies', 'companies.id', '=', 'hrm_employees.company_id')
        ->groupBy('companies.id','companies.name')
        ->where('companies.deleted_at',NULL)
        ->where('hrm_employees.deleted_at',NULL)
        ->get();
        if($result->count()>0){
            foreach ($result as $key => $value) {
            $result_array['labels'][$key]=$value->name;
            $result_array['data'][$key]=$value->total;
        }
        }
        else{
            
            $result_array['labels']=array();
            $result_array['data']=array();
        }
       
        return $result_array;
    }

    public function get_no_of_inventory_records_wise_companies(){
        $result_array=array();
        $result = DB::table('client_inventories')
        ->selectRaw("companies.id,companies.name as name, COUNT('client_inventories.*') as total")
        ->join('companies', 'companies.id', '=', 'client_inventories.company_id')
        ->groupBy('companies.id','companies.name')
        ->where('companies.deleted_at',NULL)
        ->where('client_inventories.deleted_at',NULL)
        ->get();
        if($result->count()>0){
            foreach ($result as $key => $value) {
            $result_array['labels'][$key]=$value->name;
            $result_array['data'][$key]=$value->total;
        }
        }
        else{
            
            $result_array['labels']=array();
            $result_array['data']=array();
        }
        return $result_array;
    }

     public function get_no_of_email_notifications_wise_companies(){
        $result_array=array();
        $result = DB::table('email_histories')
        ->selectRaw("companies.id,companies.name as name, COUNT('email_histories.*') as total")
        ->join('companies', 'companies.id', '=', 'email_histories.company_id')
        ->groupBy('companies.id','companies.name')
        ->where('companies.deleted_at',NULL)
        ->get();


        if($result->count()>0){
            foreach ($result as $key => $value) {
            $result_array['labels'][$key]=$value->name;
            $result_array['data'][$key]=$value->total;
        }
        }
        else{
            
            $result_array['labels']=array();
            $result_array['data']=array();
        }
        return $result_array;
    }

     public function get_no_of_system_clients_city_wise(){
        $result_array=array();
        $result = DB::table('companies')
        ->selectRaw("companies.country as country, COUNT('companies.*') as total")
        ->groupBy('companies.country')
        ->where('companies.deleted_at',NULL)
        ->get();

        if($result->count()>0){
            foreach ($result as $key => $value) {
            $result_array['labels'][$key]=$value->country;
            $result_array['data'][$key]=$value->total;
            $result_array['colors'][$key]="#" . $this->getColor($key);
        }
        }
        else{
            
            $result_array['labels']=array();
            $result_array['data']=array();
            $result_array['colors']="#" . $this->getColor(0);
        }
        return $result_array;
    }

    public function get_no_of_revenues_wise_companies(){
        
        $labels=array();
        $data=array();
        $data['ams_sell_transactions']=array();
        $data['crm_invoices']=array();
        $revenues=array();

        $result1 = DB::table('ams_sell_transactions')
        ->selectRaw("companies.id,companies.name as name,sum(grand_total) as total_amount")
        ->join('companies', 'companies.id', '=', 'ams_sell_transactions.company_id')
        ->groupBy('companies.id','companies.name')
        ->where('companies.deleted_at',NULL)
        ->where('ams_sell_transactions.deleted_at',NULL)
        ->get();

        $result2 = DB::table('invoices')
        ->selectRaw("companies.id,companies.name as name,sum(grand_total) as total_amount")
        ->join('companies', 'companies.id', '=', 'invoices.company_id')
        ->groupBy('companies.id','companies.name')
        ->where('companies.deleted_at',NULL)
        ->where('invoices.deleted_at',NULL)
        ->get();

         foreach ($result1 as $key => $value) {
          if (!in_array($value->name, $labels)) {
                array_push($labels, $value->name);
              }
              $label_index=array_search($value->name, $labels);
              $data['ams_sell_transactions'][$label_index]=$value->total_amount;
              $inventories['ams_sell_transactions']['data'][$value->name]=$value->total_amount;

          }
          foreach ($result2 as $key => $value) {
          if (!in_array($value->name, $labels)) {
                array_push($labels,$value->name);
              }
             $inventories['crm_invoices']['data'][$value->name]=$value->total_amount;
             $label_index=array_search($value->name, $labels);
             $data['crm_invoices'][$label_index]=$value->total_amount;
          }
          foreach ($labels as $key => $value) {
                if(!isset($data['ams_sell_transactions'][$key])){
                    $data['ams_sell_transactions'][$key]=0;
                }
                if(!isset($data['crm_invoices'][$key])){
                    $data['crm_invoices'][$key]=0;
                }
          }
          ksort($data['ams_sell_transactions']);
          ksort($data['crm_invoices']);
         $revenues['labels']=$labels;
         $revenues['data']=$data;
        return $revenues;
    }


    function getColor($num) {
        $preset_colors=[
            "007bff",
            "6c757d",
            "28a745",
            "17a2b8",
            "ffc107",
            "dc3545",
            "6610f2",
            "6f42c1",
            "e83e8c",
            "dc3545",
            "fd7e14",
            "ffc107",
            "28a745",
            "20c997",
            "17a2b8",
            "6c757d",
            "343a40",
            "343a40",
        ];
        if($num<=count($preset_colors)){
            return $preset_colors[$num];
        }
    $randomString = md5($num); // like "d73a6ef90dc6a ..."
    $r = substr($randomString,0,2); //1. and 2.
    $g = substr($randomString,1,2); //3. and 4.
    $b = substr($randomString,4,2); //5. and 6.
    $colors=$r.$g.$b;
    return $colors;
}
}
