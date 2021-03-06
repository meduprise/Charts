<script type="text/javascript">
    google.charts.setOnLoadCallback(drawPieChart)

    function drawPieChart() {
        var data = google.visualization.arrayToDataTable([
            [
                'Element',
                @for ($i = 0; $i < count($model->datasets); $i++)
                    "{{ $model->datasets[$i]['key'] }}",
                @endfor
            ],
            @for ($l = 0; $l < count($model->labels); $l++)
                [
                    "{{ $l }}",
                    @for ($i = 0; $i < count($model->datasets); $i++)
                        "{{ $model->datasets[$i]['values'][$l] }}",
                    @endfor
                ],
            @endfor
        ])

        var options = {
            @include('charts::_partials.dimension.js'),
            legend: { position: 'top', alignment: 'end' },
            fontSize: 12,
            @if($model->title)
                title: "{{ $model->title }}",
            @endif
            @if($model->colors)
                colors:[
                    @foreach($model->colors as $color)
                        "{{ $color }}",
                    @endforeach
                ],
            @endif
        };

        var chart = new google.visualization.ColumnChart(document.getElementById("{{ $model->id }}"))

        chart.draw(data, options)
    }
</script>

@if(!$model->customId)
    @include('charts::_partials.container.div')
@endif
