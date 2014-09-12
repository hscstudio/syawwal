<?php 
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="eregistrasi-training-default-index">
<?php
$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = ['label'=>'Trainings','url'=>['../eregistrasi-student/training/index']];
$this->params['breadcrumbs'][] = ['label'=>'Training Class Students','url'=>['index?tb_training_id='.$tb_training_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
	<p>
        You may customize side bar menu by editing folowing file:<br>
		<?php $path = explode('views',__FILE__);  ?>
        <code><?= $path[0]; ?>Module.php</code>
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>