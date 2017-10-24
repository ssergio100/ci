<!DOCTYPE html>

<html lang="pt-br">
<head>
  <title>&#128339;</title>
  <meta charset='utf-8' />
  <link rel="stylesheet" href="<?php echo base_url('assets/time_tracker.css')?>">

  <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

 <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap.min.css')?>">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" type="text/css" media="all" />
</head>
<body>
  <div class="containner">
    <div class="row">
      <div class="col-md-4" style="text-align: center"><a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a>
      </div>

      <div class="col-md-4" style="text-align: center" >
       <div id="chartdiv"></div>

     </div>

     <div class="col-md-4" id="TaskList" style="text-align: center">
       <div id="top_drop" class="drop_target"></div>
     </div>

   </div>
    <div class="row" style="padding-top: 100px;">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">
         <thead>
           <tr>
             <th>Nome</th>
             <th>Idade</th>
             <th>Peso</th>
           </tr>
         </thead>
       </table>
    </div>
    <div class="col-md-2"></div>

       </div>
 </div>


 <div class="modal fade" id="modal-id">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Cadastrar nova tarefa</h4>
      </div>

      <?php
      echo form_open('',array('id'=>'TaskForm'));
      ?>
      <div class="modal-body">
        <?php
        $hidden = array('name'=> '','id'=>'StartTimer');
        $data = array('placeholder'=>'Digite a tarefa','class'=>'form-control','id'=>'Form_TaskName');
        $data_btn_add_tarefa = array('value'=>'Add tarefa','class'=>'btn btn-default','id'=>'AddTaskButton');
        $data_btn_add_tarefa_iniciar = array('value'=>'Add tarefa e iniciar','class'=>'btn btn-warning','id'=>'TrackTimeButton');
        echo form_input('tarefa','',$data);
        echo "<input id='StartTimer' type='hidden' />";


        ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?php
        echo form_submit('','Adicionar',$data_btn_add_tarefa);
        echo form_submit('','Add tarefa e iniciar',$data_btn_add_tarefa_iniciar);
        ?>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url('assets/jquery/jquery-2.0.3.js')?>"></script>
<script src="<?php echo base_url('assets/time_tracker.js')?>"></script>
<script src="<?php echo base_url('assets/popper.js')?>"></script>
<!-- <script src="<?php echo base_url('assets/bootstrap.min.js')?>"></script> -->


<!-- Styles -->
<style>
  #chartdiv {
    width: 100%;
    height: 400px;
  }

</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>



<!-- Chart code -->
<script>

/**
 * Captura o submit do formulario, adiciona o evento no banco de dados
 * @type {[type]}
 */

  $('#TaskForm').submit(function(e) {
 e.preventDefault();
    return false;
    var $dataForm = $(this).serialize();
    $.ajax({
      url: '',
      type: 'POST',
      dataType: 'json)',
      data: dataForm
      // data: {param1: 'value1'},
    })
    .done(function(data) {
      console.log("success");
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });

  });

  var chart = AmCharts.makeChart( "chartdiv", {
    "type": "pie",
    "angle": 1,
    "balloonText": "[[title]]<br><span style='font-size:10px'><b>[[value]]</b> ([[percents]]%)</span>",
    "titleField": "country",
    "valueField": "litres",
    "maxLabelWidth": 99,
    "depth3D": 2,
    "allLabels": [],
    "balloon": {},
    "graphs":{
      "position": "absolute",
    },


    "legend": {
      "enabled": true,
      "enabled": true,
      "align": "center",
      "equalWidths": false,
      "forceWidth": true,


    },
    "dataProvider": [ {
      "country": "Lithuania",
      "litres":884
    }, {
      "country": "Czech Republic",
      "litres": 301.9
    }, {
      "country": "Ireland",
      "litres": 201.1
    }, {
      "country": "Germany",
      "litres": 165.8
    }, {
      "country": "Australia",
      "litres": 139.9
    },{
      "country": "The Netherlands",
      "litres": 50
    } ],

    "export": {
      "enabled": true
    },
  } );

  $(document).ready(function() {
    $('#example').DataTable( {
        "ajax": "<?php echo base_url('painel/datajson');?>",
        "columns": [
            { "data": "nome" },
            { "data": "peso" },
            { "data": "idade" }

        ]
    } );
} );
</script>

<!-- HTML -->

</body>
</html>
