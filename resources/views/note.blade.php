
@if($active='home')

<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(function () {

      // Create Source Chart 
        
        jsonSources = JSON.stringify(sources);
        JSON.stringify(drilldown_gouvernement);
          $('#source').highcharts({
              chart: {
                  type: 'column'
              },
              legend:{
                enabled: false
              },
              credits:{
                enabled: false
              },
              title: {
                  text: ''
              },
              subtitle: {
                  text: 'Cliquez sur la colonne pour plus de détails'
              },
              xAxis: {
                  type: 'category'
              },
              yAxis: {
                  title: {
                      text: 'Nombre de promesses '
                  }

              },
              plotOptions: {
                  series: {
                      borderWidth: 0,
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.1f}%'
                      }
                  }
              },

              tooltip: {
                  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                  pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
              },

              series: [{
                  name: 'Nombre de promesses',
                  colorByPoint: true,
                  data: sources
              }],
              drilldown: {
                  series: [{
                      name: 'Président',
                      id: 'Président',
                      data: drilldown_president
                  }, {
                      name: 'Gouvernement',
                      id: 'Gouvernement',
                      data: drilldown_gouvernement
                  }]
              }
          });
          
      // Charts End

      // Create Verdict Chart

      $('#etat').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              legend:{
                enabled: false
              },
              credits:{
                enabled: false
              },
              title: {
                  text: ''
              },
              tooltip: {
                  pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
              },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: true,
                          format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                          style: {
                              color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                          }
                      }
                  }
              },
              series: [{
                  name: 'Verdict',
                  colorByPoint: true,
                  data: etats
              }]
          });
      // End Chart

      // Create Secteur Chart

      $('#secteur').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              legend:{
                enabled: false
              },
              credits:{
                enabled: false
              },
              title: {
                  text: ''
              },
              tooltip: {
                  pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
              },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: true,
                          format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                          style: {
                              color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                          }
                      }
                  }
              },
              series: [{
                  name: 'Secteur',
                  colorByPoint: true,
                  data: secteurs
              }]
          });
      // End Chart
    });
  });
</script>

@endif
