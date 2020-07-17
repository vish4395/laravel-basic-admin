@extends('layouts.inner_app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Dashboard') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
        <div class="card card-primary card-outline">
                <div class="card-header">{{ __('No of customer') }}</div>
                <div class="card-body">
              <div class="chart">
              <canvas id="customersChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            </div>
         </div>
        </div>
        <div class="col-md-6">
        <div class="card card-primary card-outline">
                <div class="card-header">{{ __('No of employees') }}</div>
                <div class="card-body">
              <div class="chart">
              <canvas id="employeesChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            </div>
            </div>
            
        </div>
        <div class="col-md-6">
        <div class="card card-primary card-outline">
                <div class="card-header">{{ __('Inventory records') }}</div>

                <div class="card-body">
              <div class="chart">
              <canvas id="inventoriesChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            </div>
            </div>
            
        </div>
        <div class="col-md-6">
        <div class="card card-primary card-outline">
                <div class="card-header">{{ __('Email notifications') }}</div>
                 <div class="card-body">
              <div class="chart">
              <canvas id="notificationsChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            </div>
            </div>
            
        </div>
        <div class="col-md-6">
        <div class="card card-primary card-outline">
                <div class="card-header">{{ __('System clients country wise') }}</div>

                 <div class="card-body">
              <div class="chart">
               <canvas id="systemClients" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            </div>
            </div>
            
        </div>
        <div class="col-md-6">
        <div class="card card-primary card-outline">
                <div class="card-header">{{ __('Revenues') }}</div>
                <div class="card-body">
              <div class="chart">
              <canvas id="revenuesChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            </div>
         </div>
        </div>
    </div>
</div>

</div>
    <!-- /.content -->
    <!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script type="text/javascript">
 
  var no_of_customer_wise_companies=JSON.parse('{"labels":["Justaddwater.in","Ram"],"data":[23,1]}');
 var no_of_employees_wise_companies=JSON.parse('{"labels":["Justaddwater.in","Ram"],"data":[5,2]}');
 var no_of_inventory_records_wise_companies=JSON.parse('{"labels":["Justaddwater.in"],"data":[58]}');
  var no_of_email_notifications_wise_companies=JSON.parse('{"labels":["Justaddwater.in"],"data":[58]}');
 var no_of_system_clients_city_wise=JSON.parse('{"labels":["India"],"data":[5],"colors":["#007bff"]}');
  var no_of_revenues_company_wise=JSON.parse('{"labels":["Justaddwater.in"],"data":{"ams_sell_transactions":["10281.30"],"crm_invoices":["111397.46"]}}');
  $(document).ready(function(){
     var customersChartData = {
      // labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      labels  : no_of_customer_wise_companies.labels,
      datasets: [
        {
          label               : '{{__('Customers')}}',
          backgroundColor     : 'rgba(0,123,255,0.9)',
          borderColor         : 'rgba(0,123,255,0.8)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(0,123,255,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(0,123,255,1)',
          // hoverBackgroundColor  : '#fff',
          // hoverBorderWidth  : '1',
          // hoverBorderColor: 'rgba(0,123,255,1)',
          data                : no_of_customer_wise_companies.data
        },
      ]
    }
    var ChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
    }
 
    //-------------
    //- BAR CHART -
    //-------------
    var customersChartCanvas = $('#customersChart').get(0).getContext('2d')
    var customersChartData = jQuery.extend(true, {}, customersChartData)
    var temp0 = customersChartData.datasets[0]

    customersChartData.datasets[0] = temp0


    var customersChart = new Chart(customersChartCanvas, {
      type: 'bar', 
      data: customersChartData,
      options:ChartOptions
    })

    var employeesChartData = {
      // labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      labels  : no_of_employees_wise_companies.labels,
      datasets: [
        {
          label               : '{{__('Employees')}}',
          backgroundColor     : 'rgba(0,123,255,0.9)',
          borderColor         : 'rgba(0,123,255,0.8)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(0,123,255,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(0,123,255,1)',
          // hoverBackgroundColor  : '#fff',
          // hoverBorderWidth  : '1',
          // hoverBorderColor: 'rgba(0,123,255,1)',
          data                : no_of_employees_wise_companies.data
        },
      ]
    }
    
    
     //-------------
    //- BAR CHART -
    //-------------
    var employeesChartCanvas = $('#employeesChart').get(0).getContext('2d')
    var employeesChartData = jQuery.extend(true, {}, employeesChartData)
    var temp0 = employeesChartData.datasets[0]

    employeesChartData.datasets[0] = temp0

   
    var employeesChart = new Chart(employeesChartCanvas, {
      type: 'line', 
      data: employeesChartData,
      options:ChartOptions
    })
 

    var inventoriesChartData = {
      // labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      labels  : no_of_inventory_records_wise_companies.labels,
      datasets: [
        {
          label               : '{{__('Inventories')}}',
          backgroundColor     : 'rgba(0,123,255,0.9)',
          borderColor         : 'rgba(0,123,255,0.8)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(0,123,255,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(0,123,255,1)',
          // hoverBackgroundColor  : '#fff',
          // hoverBorderWidth  : '1',
          // hoverBorderColor: 'rgba(0,123,255,1)',
          data                : no_of_inventory_records_wise_companies.data
        },
      ]
    }

     //-------------
    //- LINE CHART -
    //-------------
    var inventoriesChartCanvas = $('#inventoriesChart').get(0).getContext('2d')
    var lineChartinventoriessOptions = jQuery.extend(true, {},ChartOptions)
    var inventoriesChartData = jQuery.extend(true, {}, inventoriesChartData)
    var temp0 = inventoriesChartData.datasets[0]

    inventoriesChartData.datasets[0] = temp0
    inventoriesChartData.datasets[0].fill = false;
    lineChartinventoriessOptions.datasetFill = false

    var inventoriesChart = new Chart(inventoriesChartCanvas, {
      type: 'line', 
      data: inventoriesChartData,
      options:lineChartinventoriessOptions
    })

      var notificationsChartData = {
      // labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      labels  : no_of_email_notifications_wise_companies.labels,
      datasets: [
        {
          label               : '{{__('Email Notifications')}}',
          backgroundColor     : 'rgba(0,123,255,0.9)',
          borderColor         : 'rgba(0,123,255,0.8)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(0,123,255,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(0,123,255,1)',
          // hoverBackgroundColor  : '#fff',
          // hoverBorderWidth  : '1',
          // hoverBorderColor: 'rgba(0,123,255,1)',
          data                : no_of_email_notifications_wise_companies.data
        },
      ]
    }

     //-------------
    //- BAR CHART -
    //-------------
    var notificationsChartCanvas = $('#notificationsChart').get(0).getContext('2d')
    var notificationsChartData = jQuery.extend(true, {}, notificationsChartData)
    var temp0 = notificationsChartData.datasets[0]

    notificationsChartData.datasets[0] = temp0


    var notificationsChart = new Chart(notificationsChartCanvas, {
      type: 'bar', 
      data: notificationsChartData,
      options:ChartOptions
    })
      //-------------
    //- PIE CHART -
    //-------------
       var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    var pieSystemClientData        = {
      labels:no_of_system_clients_city_wise.labels,
      datasets: [
        {
          data: no_of_system_clients_city_wise.data,
          backgroundColor :no_of_system_clients_city_wise.colors,
        }
      ]
    }
    var pieChartCanvasSystemClient = $('#systemClients').get(0).getContext('2d')
    var pieChart = new Chart(pieChartCanvasSystemClient, {
      type: 'pie',
      data: pieSystemClientData,
      options: pieOptions      
    })


    //bar chart
      var revenuesChartData = {
      // labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      labels  : no_of_revenues_company_wise.labels,
      datasets: [
        {
          label               : '{{__('AMS Sell Transactions')}}',
          backgroundColor     : 'rgba(0,123,255,0.9)',
          borderColor         : 'rgba(0,123,255,0.8)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(0,123,255,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(0,123,255,1)',
          // hoverBackgroundColor  : '#fff',
          // hoverBorderWidth  : '1',
          // hoverBorderColor: 'rgba(0,123,255,1)',
          data                : no_of_revenues_company_wise.data.ams_sell_transactions
        },
         {
          label               : '{{__('CRM Invoices')}}',
          backgroundColor     : 'rgba(255,141,188,0.9)',
          borderColor         : 'rgba(255,141,188,0.8)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(255,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(255,141,188,1)',
          // hoverBackgroundColor  : '#fff',
          // hoverBorderWidth  : '1',
          // hoverBorderColor: 'rgba(0,123,255,1)',
          data                : no_of_revenues_company_wise.data.crm_invoices
        },
      ]
    }
    var ChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
    }
 
    //-------------
    //- BAR CHART -
    //-------------
    var revenuesChartCanvas = $('#revenuesChart').get(0).getContext('2d')
    var revenuesChartData = jQuery.extend(true, {}, revenuesChartData)
    var temp0 = revenuesChartData.datasets[0]

    revenuesChartData.datasets[0] = temp0


    var revenuesChart = new Chart(revenuesChartCanvas, {
      type: 'bar', 
      data: revenuesChartData,
      options:ChartOptions
    })
  });
</script>
@endsection

