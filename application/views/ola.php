<?php
defined('BASEPATH') OR exit('No direct script access allowed');




?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<?php
	$attibutes_imput = array('class'=>'form-control');
	$hidden = array('id'=>$id);
	echo form_open('painel/t','',$hidden);
	echo form_label('Usuario','username');
	echo form_input('username',set_value('username'),$attibutes_imput);
	echo form_submit('name', 'Enviar',array('class'=>'btn btn-success'));
	echo form_close();

	?>

	<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a>
	<div class="modal fade" id="modal-id">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Modal title</h4>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
