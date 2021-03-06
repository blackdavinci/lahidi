
@if($active='home')

<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(function () {

      // Create Source Chart 
        
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
                          format: '{point.y}'
                      }
                  }
              },

              tooltip: {
                  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                  pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> du total<br/>'
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
                  pointFormat: '{series.name}: <b>{point.y}</b>'
              },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: true,
                          format: '<b>{point.name}</b>: {point.y}',
                          style: {
                              color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                          }
                      }
                  },
                  series: {
                                  cursor: 'pointer',
                                  point: {
                                      events: {
                                          click: function () {
                                              location.href = this.options.url;
                                          }
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
                  pointFormat: '{series.name}: <b>{point.y}</b>'
              },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: true,
                          format: '<b>{point.name}</b>: {point.y}',
                          style: {
                              color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                          }
                      }
                  },
                  series: {
                                  cursor: 'pointer',
                                  point: {
                                      events: {
                                          click: function () {
                                              location.href = this.options.url;
                                          }
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
  // End HighCharts Function

  

  // End Map Script
  });
</script>

@endif
