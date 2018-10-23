@extends('layouts.app')
@section('header')
<script type="text/javascript">
@if ($role_id == 1)
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Opción', 'Respuestas'],
		  @foreach($grafico_1 as $item)
			{!! "[ '".$item->answer."',".$item->count."]," !!}
		  @endforeach
        ]);

        var options = {
          title: '¿La información es correcta?'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
		drawChart2();
      }
	  
	  function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['Opción', 'Respuestas'],
		  @foreach($grafico_2 as $item)
			{!! "[ '".$item->answer."',".$item->count."]," !!}
		  @endforeach
        ]);

        var options = {
          title: '¿Del 1 al 5, es rápido el sitio?'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
      }
@endif
   </script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					@if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
					@if (session('warning'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('warning') }}
                        </div>
                    @endif
					
					@if ($role_id == 1)
					<div class="row">
						<div class="col-md-12">
							<h2>Resumen respuestas</h2>
						</div>
						<div class="col-md-6">
							<div id="piechart" style="width: 350px; height: 300px;"></div>
						</div>
						<div class="col-md-6">
							<div id="piechart2" style="width: 350px; height: 300px;"></div>
						</div>
					</div>
					@endif
					<form action="responder" method="post">
						{{ csrf_field() }}
					@if ($flag == 1)
						<p>Ha respondido las respuestas hace menos de un mes ({{ $created_at }}), solo puede ver su último envío</p>
						@foreach($questions as $item)
							<h3>{{ $item->question }}</h3>
							{{ $item->answer }}
						@endforeach
					@else
						<h2>Reponda la siguientes preguntas</h2>
						@foreach($questions as $question)
							<h3>{{ $question['question'] }}</h3>
							{!! $question['answers'] !!}
						@endforeach
					
						<div class="form-group row mb-0">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary">
									{{ __('Responder') }}
								</button>
							</div>
						</div>
					@endif
					</form>
					@if ($role_id == 1)
					<div class="row">
						<div class="col-md-12">
							<h2>Envíos realizados</h2>
						</div>
						<div class="col-md-12">
							<table class="table">
							  <thead>
								<tr>
								  <th scope="col">#</th>
								  <th scope="col">Usuario</th>
								  <th scope="col">Pregunta</th>
								  <th scope="col">Respuesta</th>
								  <th scope="col">Fecha</th>
								</tr>
							  </thead>
							  <tbody>
								@foreach($answers as $item)
								<tr>
								  <th scope="row">1</th>
								  <td>{{ $item->name }}</td>
								  <td>{{ $item->question}}</td>
								  <td>{{ $item->answer}}</td>
								  <td>{{ $item->created_at}}</td>
								</tr>
								@endforeach
							  </tbody>
							</table>
						</div>
					</div>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
