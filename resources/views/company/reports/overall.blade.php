@extends('layouts.company')

@section('styles')
<!-- Date Picker -->
<link href="{{ asset('theme/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('companyDashboard') }}">Dashboard</a> > <a href="{{ route('company.reports') }}"> Reports </a> > Overall </li>
@endsection
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card-box">
      <div class="row d-flex align-items-center">
          <div class="col-md-3" >
              <div class="card-box">
                  @php
                    $res = json_decode($response, true);
                  @endphp
                  @foreach($res['questions'] as $key => $question)

                      <p>Q{{$loop->index +1 }}: {{$question['question']}}</p>
                  @endforeach
              </div>
          </div>
        <div class="col-md-9">
          <div class="card-box">
            <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- container -->
</div> <!-- content -->
@endsection

@section('scripts')

<!-- Date Picker -->
<script src="{{ asset('theme/plugins/moment/moment.js')}}"></script>
<script src="{{ asset('theme/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{ asset('assets/js/datepickerConf.js') }}"></script>

<script type="text/javascript">
    let surveyId = {!! request('surveyId') !!};

    $('#btnFilter').on('click', function(){
        let base_url = window.location.origin;
        let dateArr = $('#reportrange').val().split(' - ');

        let from = dateArr[0];
        let to   = dateArr[1];

        window.location.href = base_url+'/company/reports/overall/survey/'+surveyId+'?from='+from+'&to='+to;
    })
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    let reportData = {!! json_decode( json_encode($response), true) !!};
    let temp = [];
    let outterIndex = 0;
    $.each(reportData.questions, function(index, question){
        outterIndex++;
        $.each(question.options, function(index, option){
            // alert(option.colour);
            let xyz = [];
            xyz.push('Q'+outterIndex);
            xyz.push(option.label);
            xyz.push(option.totalResponse);
            // xyz.push(parseInt(Math.random() * 50 + 1));
            temp.push(xyz);
        });
    });

    google.load("visualization", "1.1", {packages:["bar"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        // var productWiseData = google.visualization.arrayToDataTable(getPivotArray(arr, 0, 1, 2));
        var productWiseData = google.visualization.arrayToDataTable(getPivotArray(temp, 0, 1, 2));

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        var options = {
            // hide legends
            // legend: { position: "none" },
            // colors: ['red','green', 'blue'],
            // bars width
            bar: {groupWidth: "50%"},

            // chart: {
            // title: 'Company Performance',
            // subtitle: 'Sales, Expenses, and Profit: 2014-2017',
            // },

            bars: 'vertical' ,// Required for Material Bar Charts.
        };
        // chart.draw(productWiseData,{});
        chart.draw(productWiseData, google.charts.Bar.convertOptions(options));
    }

    function getPivotArray(dataArray, rowIndex, colIndex, dataIndex) {
        var result = {}, ret = [];
        var newCols = [];
        for (var i = 0; i < dataArray.length; i++) {

            if (!result[dataArray[i][rowIndex]]) {
                result[dataArray[i][rowIndex]] = {};
            }
            result[dataArray[i][rowIndex]][dataArray[i][colIndex]] = dataArray[i][dataIndex];

            //To get column names
            if (newCols.indexOf(dataArray[i][colIndex]) == -1) {
                newCols.push(dataArray[i][colIndex]);
            }
        }

        newCols.sort();
        var item = [];

        //Add Header Row
        item.push(reportData.survey.name);
        item.push.apply(item, newCols);
        ret.push(item);

        //Add content
        for (var key in result) {
            item = [];
            item.push(key);
            for (var i = 0; i < newCols.length; i++) {
                item.push(result[key][newCols[i]] || 0);
            }
            ret.push(item);
        }
        return ret;
    }
</script>
@endsection
