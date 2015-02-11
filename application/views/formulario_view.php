<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $titulo;?></title>
	</head>
	
	<body>
	<h1>Mi formulario</h1>
	<?= form_open(base_url().'formulario/validar',array('name'=>'mi_form','id'=>'form'));?>
	<?= form_label('Nombre','Nombre',array('class'=>'label')); ?><br>
	<?= form_input('nombre','','class="input"') ?><br>
	<?= form_password('pass','','class="password"')?><br>
	Futbol<?= form_checkbox('deporte','futbol',false,'class="check"');?>
	Voley<?= form_checkbox('deporte','voley',true,'class="check"');?><br>
	<?= form_textarea('mensaje','','class="textarea" row="25px"');?><br>
	Masculuno<?= form_radio('sexo','M',false,'class="radio"');?>
	Femenino<?= form_radio('sexo','F',true,'class="radio"' );?>
	<?= form_button('boton','titulo Botton','class="boton"');?>
	<?= form_hidden('oculto','valor_oculto');?><br>
	<?= form_upload('archivo','','class="class_upload"');?><br>
	<?= form_dropdown('seleccione',array('1'=>'uno','2'=>'dos','3'=>'tres'),array('1'),'class="select"');?><br>
	<?= form_multiselect('seleccione2',array('1'=>'uno','2'=>'dos','3'=>'tres'),array('1','2'),'class="select"');?><br>
	<?= form_submit('submit','Enviar datos','class="submit"');?><br>
	<?= form_close()?>	
	
	<hr>
	<h3>Posibles errores</h3>
	<?= validation_errors();?>
	</body>
</html>



