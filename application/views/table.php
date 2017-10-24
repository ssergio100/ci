<?php
$data = '31/12/2017'; // Formato Brasileiro: dia/mes/Ano

echo date('Y-m-d', strtotime(str_replace('/','-',$data)));

$arr_data = array(
  '2017-01-12',
  '2017-01-13',
  '2017-01-14',
  '2017-01-15'
  );

$data = new \DateTime('2017-09-29');
$data2 = new \DateTime('2017-10-02');

$engloba = true;
$interval = new \DateInterval('P1D');

if ($engloba) {

  $data->sub($interval);
  $data2->add($interval);

}

$daterange = new DatePeriod($data, $interval ,$data2);

$uteis = 0;
$sabados = 0;
$domingos = 0;
$arr_dias_uteis = array();
$return_data = array();

foreach ($daterange as $date) {

 if (in_array($date->format('Y-m-d'),$arr_data) == false){

  switch ($date->format('w')) {
    case 0:
    $sabados++;
    break;

    case 6:
    $domingos++;
    break;

    default:
    $arr_dias_uteis[] = $date->format('Y-m-d');
    $uteis++;
    break;

  }

}

}
$return_data['sabados'] = $sabados;
$return_data['domingos'] = $domingos;
$return_data['qtd_uteis'] = $uteis;
$return_data['uteis'] = $arr_dias_uteis;
$return_data['total_dias'] = $uteis+$domingos+$sabados;

print_r($return_data);



?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
  <title></title>
  <meta charset='utf-8' />
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dataTables.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.3/css/select.dataTables.min.css">


  <style>
    .col_red{
      color: red;
    }
    td.details-control {
      background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
      cursor: pointer;
    }
    tr.shown td.details-control {
      background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
    }
  </style>
</head>
<body>
  <div class="containner">
    <div class="message" id="alert1"></div>
    <div class="message" id="alert2"></div>

    <div class="row" style="padding-top: 100px;">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">
         <thead>
           <tr>
             <th></th>
             <th>Nome</th>
             <th>Idade</th>
             <th>Peso</th>
             <th>Ação</th>
           </tr>
         </thead>
       </table>
     </div>
     <div class="col-md-2"></div>

   </div>
 </div>


 <script src="<?php echo base_url('assets/jquery/jquery-2.0.3.js')?>"></script>

 <script src="<?php echo base_url('assets/jquery.dataTables.min.js');?>"></script>
 <script src="<?php echo base_url('assets/dataTables.bootstrap4.min.js');?>"></script>

 <script src="<?php echo base_url('assets/dataTables.buttons.min.js');?>"></script>
 <script src="<?php echo base_url('assets/jszip.min.js');?>"></script>
 <script src="<?php echo base_url('assets/pdfmake.min.js');?>"></script>
 <script src="<?php echo base_url('assets/vfs_fonts.js');?>"></script>
 <script src="<?php echo base_url('assets/buttons.html5.min.js');?>"></script>
 <script src="<?php echo base_url('assets/buttons.colVis.min.js');?>"></script>
 <script src="<?php echo base_url('assets/jquery.blockUI.js');?>"></script>


 <script src="https://cdn.datatables.net/select/1.2.3/js/dataTables.select.min.js
 "></script>

 <!-- Chart code -->
 <script>
  camposMarcados = [];
  $(document).ready(function() {
   table =  $('#example').DataTable( {
    fixedHeader: true,
      pageLength: -1,
      initComplete: function () {
        this.api().columns(2).every( function () {
          var column = this;
          var select = $('<select style="width:80%" class="custom-select mb-2 mr-sm-2 mb-sm-0"><option value=""></option></select>')
            .appendTo( $(column.header()))
            .on( 'click', function (e) {
              e.stopPropagation();
            })
            .on( 'change', function () {
              var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
              );

              column
                .search( val ? '^'+val+'$' : '', true, false )
                .draw();
            } );

          column.data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
          } );
        } );
      },
    "dom": 'Bfrtip',
    buttons: [
    {
      text: 'Get selected data',
      action: function () {
       $("input[type=checkbox][name='checkbox-table[]']:checked").each(function(){
            camposMarcados.push($(this).val());
            console.log($(this).val());
        });
      }
    },
    {
      extend: 'copyHtml5',
      text: 'Copiar',
      exportOptions: {
        columns: [ 0, ':visible' ]
      }
    },
    {
      extend: 'excelHtml5',
      exportOptions: {
        columns: ':visible'
      }
    },
    {
      extend: 'pdfHtml5',
      exportOptions: {
        columns: [ 0, 1, 2, 5 ]
      }
    },'colvis'

    ],
    language: {
      buttons: {
        copyTitle: 'Ajouté au presse-papiers',
        copyKeys: 'Appuyez sur <i>ctrl</i> ou <i>\u2318</i> + <i>C</i> pour copier les données du tableau à votre presse-papiers. <br><br>Pour annuler, cliquez sur ce message ou appuyez sur Echap.',
        copySuccess: {
          _: '%d lignes copiées',
          1: '1 ligne copiée'
        }
      }
    },

    "ajax": "<?php echo base_url('painel/datajson');?>",
    "columns": [
    {
      "className":      'details-control',
      "orderable":      false,
      "data":           null,
      "defaultContent": '',
      "width": "5%",
    },

    {
       "title":'#',
      "render": function ( data, type, row, meta ) {
          return '<input type="checkbox" onclick="selected_col();" name="checkbox-table[]" value="'+row.id+'"> ';
        },

    },

    { "data": "nome",
     "orderable": false,
        "title":'NOME', //Renomeando a coluna como atributo title
        "render": function ( data, type, row, meta ) {
          return '<a href="'+row.id+'">'+data+'</a>';
        },
       
      },

      { "data": "peso",
      "width": "5%",

    },

    { "data": "idade",
    "width": "5%",
       "defaultContent": "<i>N/I</i>" //CASO O CAMPO NÃO EXISTA <> DE "" OU NULL
     }

     ],

     "order": [[ 2, "desc" ]],
     "paging": true,


     "columnDefs": [ {

        "targets": 4, //coluna 1 nao é alvo de buscas
       // "searchable": false, // tira das buscas
       // "className": "col_red", "targets": [ 0 ],// se não especificado as colunas, aplica-se as definidas em "targets" na primeira ocorrencia

       "orderable":      false,
       "render": function ( data, type, row, meta ) {
        return '<spam onclick="alert('+row.id+');">Editar</spam>|<spam onclick="alert('+row.id+');">excluir</spam>';
      }

    } ],
    "language": {
     "sEmptyTable": "Nenhum registro encontrado",
     "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
     "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
     "sInfoFiltered": "(Filtrados de _MAX_ registros)",
     "sInfoPostFix": "",
     "sInfoThousands": ".",
     "sLengthMenu": "_MENU_ resultados por página",
     "sLoadingRecords": "Carregando...",
     "sProcessing": "Processando...",
     "sZeroRecords": "Nenhum registro encontrado",
     "sSearch": "Pesquisar",
     "oPaginate": {
      "sNext": "Próximo",
      "sPrevious": "Anterior",
      "sFirst": "Primeiro",
      "sLast": "Último"
    },
    "oAria": {
      "sSortAscending": ": Ordenar colunas de forma ascendente",
      "sSortDescending": ": Ordenar colunas de forma descendente"
    }
  }
} );

       // Add event listener for opening and closing details
       $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
          }
          else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
          }
        } );

       /* Formatting function for row details - modify as you need */
       function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
    '<tr>'+
    '<td>Nome:</td>'+
    '<td>'+d.nome+'</td>'+
    '</tr>'+
    '<tr>'+
    '<td>INformações:</td>'+
    '<td>'+d.info+'</td>'+
    '</tr>'+
    '<tr>'+
    '<td>Idade</td>'+
    '<td>'+d.idade+'</td>'+
    '</table>';
  }
  table.on( 'select', function ( e, dt, type, indexes ) {
    if ( type === 'row' ) {

     var idx = table.cell('.selected', 0).index();
     var data = table.row( idx.row ).data();

     arr.push(data.id);

     console.log(data);
   }
 } );

  table.on( 'deselect', function ( e, dt, type, indexes ) {
    if ( type === 'row' ) {
     var data = table.rows( indexes ).data().pluck( 'id' );
     arr.indexOf(data[0]);
     console.log(data[0]);
   }
 } );
} );

Array.prototype.pushUnique = function (item){
  if(this.indexOf(item) == -1) {
    //if(jQuery.inArray(item, this) == -1) {
      this.push(item);
      return true;
    }
    return false;
  }

  $(document).on({
    ajaxStart: function() { $.blockUI();},
    ajaxStop: function() { $.unblockUI(); }
  });



 function MessageClass(id=null, _class=null, text=null) {
    var style = _class;

    this.getAlert = function () {
        return alert='<div style="display:none" class="alert '+style+' alert-dismissible fade show s-message" role="alert">'+
  '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
  '<span aria-hidden="true">&times;</span></button>'+
  '<strong>'+text+'</div>';
    };
}

function get_message(id=null, text=null, _class='alert-danger') {

  if( id!==null) {
    oMyClasse = new MessageClass(id, _class, text);

    $(id).html(oMyClasse.getAlert());
    $('.s-message').fadeIn();

  } else {
     $('.s-message').fadeOut(function(){
      $(this).remove();
     });

  }

}

var funcaoPrincipal = function(){

  a = function(){
    alert('function a inicializada');
  }


  b = function(){
    alert('function b inicializada');
  }


  c = function(){
    alert('function c inicializada');
  }

  return {init: function() {
    a(), b(), c()
  }}
}();

jQuery(document).ready(function($) {
   //funcaoPrincipal.init();
   //
$('checkbox').change(function(){
  alert();
})
});


function selected_col(){
   $("input[type=checkbox][name='checkbox-table[]']:checked").each(function(){
            camposMarcados.push($(this).val());
            console.log($(this).val());
        });
}
</script>

<!-- HTML -->

</body>
</html>

