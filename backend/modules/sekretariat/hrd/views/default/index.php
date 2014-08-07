<?php
$this->title="Dashboard";
$modules=$this->context->module->uniqueId;
$modules=explode('-',$modules);
foreach($modules as $module){
	$this->params['breadcrumbs'][]=ucfirst($module);
}
?>
<div class="sekretariat-hrd-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
