
<div class="page-content">
    
    <!-- ****************** Conteúdo das páginas internas ********************** -->
    <div class="row">

        <div class="col-xs-12">	
            <!--Script de mensagem '?' -->
            <script type="text/javascript">
                jQuery(function($) {
                    $('[data-rel=popover]').popover({container: 'body'});
                });
            </script>
            <script type="text/javascript">
                
              function buscar_cidades() {
                var estado = $('#estado').val();
                if (estado) {
                    var url = "<?php echo base_url().'aluno/listarMunicipio/' ?>" + estado;
                    $.post(url, function(retornoDaFuncao) {
                        $('#load_cidades').html(retornoDaFuncao);

                    });
                }
            }
               
            </script>
            
            <?php if (isset($sucesso)) { ?>
                <div class="alert alert-success"><?php echo $sucesso; ?></div>
            <?php } ?>
            <?php if (isset($erro)) { ?>
                <div class="alert alert-danger"><?php echo $erro; ?></div>
            <?php } ?>
                
     <?php if(validation_errors()): ?>
	 <div class="row">
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<strong>Atenção!</strong>
                        <?php echo form_error('nome_aluno'); ?>
                        <?php echo form_error('registro_matricula'); ?>
                        <?php echo form_error('nome_mae'); ?>
                        <?php echo form_error('nome_pai'); ?>
                        <?php echo form_error('data_nascimento'); ?>
                        <?php echo form_error('id_municipio_aluno'); ?> 
		</div>
	 </div>
       <?php endif; ?>

            <div class="page-header">
                <h1> Cadastrar aluno </h1>
            </div>
            <div class="col-xs-12">
              
                <form id="formulario" name="form1" method="post" action="<?php echo base_url().'aluno/cadastrar'; ?>">
                    <br>
                    <!-- SELECT -->
                    <div class="row">
                        <div class="col-xs-3 align-r">
                            <label>Estado:</label>
                        </div>
                        <div class="col-xs-5">
                            <div>
                                <select class="full-width" id="estado" onchange="buscar_cidades();" name="estado">
                                    <?php
                                    if (!isset($estados) || empty($estados)) {
                                        ?>
                                        <option value="">
                                            Nenhum estado cadastrado
                                        </option>
                                    <?php
                                    } else {
                                        foreach ($estados as $e):
                                            ?>

                                            <option value="<?php echo $e->id_estado; ?>">
                                            <?php echo $e->nome_estado; ?>
                                            </option>
                                           <?php endforeach;
                                            } ?>
                                </select>
                            
                            </div>
                        </div>
                        <div class="col-xs-1">
                            <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Campo estado, deve ser selecionado um estado para carregar os municípios" title="Estado">?</span>
                        </div>
                    </div>
                    <br>
                    <!-- FIM SELECT -->
                    <!-- SELECT -->
                    <div class="row">
                        <div class="col-xs-3 align-r">
                            <label>Município:</label>
                        </div>
                        <div class="col-xs-5">
                            <div>
                                <select class="full-width" id="load_cidades" name="id_municipio_aluno">
                                   
                                        <option value="">
                                            Selecione um estado antes..
                                        </option>
                                </select>
                               
                            </div>
                        </div>
                        <div class="col-xs-1">
                            <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Campo cidade, é preciso informar o nome da cidade." title="cidade">?</span>
                        </div>
                    </div>
                    <br>

                    <!-- TEXTFIELD -->
                    <div class="row">
                        <div class="col-xs-3 align-r">
                            <label>Matrícula(rm):</label>
                        </div>

                        <div class="col-xs-5">
                            <input type="text" name="registro_matricula" value="<?php echo set_value('registro_matricula'); ?>" class="full-width">
                        </div>
                        <div class="col-xs-1">
                            <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Campo matrícula, deve ser preenchido com o número de matricula do aluno." title="Matrícula">?</span>
                        </div>
                    </div>
                    <!-- FIM TEXTFIELD -->
                    <br>

                    <!-- TEXTFIELD -->
                    <div class="row">
                        <div class="col-xs-3 align-r">
                            <label>Nome do aluno:</label>
                        </div>

                        <div class="col-xs-5">
                            <input type="text"  name="nome_aluno"  value="<?php echo set_value('nome_aluno'); ?>"  class="full-width">
                        </div>
                        <div class="col-xs-1">
                            <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Campo nome, deve ser preenchido com o nome completo do aluno." title="Nome">?</span>
                        </div>
                    </div>
                    <!-- FIM TEXTFIELD -->
                    <br>

                    <!-- TEXTFIELD -->
                    <div class="row">
                        <div class="col-xs-3 align-r">
                            <label>Nome da mãe:</label>
                        </div>

                        <div class="col-xs-5">
                            <input type="text" name="nome_mae"  value="<?php echo set_value('nome_mae'); ?>"  class="full-width">
                        </div>
                        <div class="col-xs-1">
                            <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Campo nome da mãe, deve ser preenchido com nome da mãe ou responsável legal." title="Mãe">?</span>
                        </div>
                    </div>
                    <!-- FIM TEXTFIELD -->
                    <br>

                    <!-- TEXTFIELD -->
                    <div class="row">
                        <div class="col-xs-3 align-r">
                            <label>Nome do pai:</label>
                        </div>

                        <div class="col-xs-5">
                            <input type="text"  name="nome_pai"  value="<?php echo set_value('nome_pai'); ?>"  class="full-width">
                        </div>
                        <div class="col-xs-1">
                            <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Campo nome do pai, opcional pode ser preenchido com nome do pai do aluno." title="Pai">?</span>
                        </div>
                    </div>
                    <!-- FIM TEXTFIELD -->
                    <br>

                    <!-- TEXTFIELD -->
                    <div class="row">
                        <div class="col-xs-3 align-r">
                            <label>Data de nascimento:</label>
                        </div>

                        <div class="col-xs-5">
                            <input type="date" name="data_nascimento" value="<?php echo set_value('data_nascimento'); ?>" required class="full-width">
                        </div>
                        <div class="col-xs-1">
                            <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Campo data de nascimento, deve ser preenchido com a data de nascimento do aluno." title="Data nascimento">?</span>
                        </div>
                    </div>
                    <!-- FIM TEXTFIELD -->
                    <br>
                    
                    <div class="clearfix form-actions">
                        <div class="col-md-9">

                            <button class="btn btn-info" name="acao"> <i class="icon-ok bigger-110"></i> Enviar </button>
                        </div>
                    </div>

                </form> 
             
            </div>
                
        </div><!-- /.col -->
        <!-- ****************** Conteúdo das páginas internas FIM ********************** -->
    </div><!-- /.row -->
</div><!-- /.page-content -->
