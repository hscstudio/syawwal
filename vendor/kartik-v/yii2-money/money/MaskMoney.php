<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-money
 * @version 1.0.0
 */

namespace kartik\money;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * A money mask input widget styled for Bootstrap 3 based on the jQuery-maskMoney plugin,
 * which offers a simple way to create masks to your currency form fields.
 *
 * @see https://github.com/plentz/jquery-maskmoney
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class MaskMoney extends \kartik\widgets\InputWidget
{
    /**
     * @var array HTML attributes for the displayed input
     */
    private $_displayOptions = [];

    /**
     * @inherit doc
     */
    public function init()
    {
        parent::init();
        $this->initPluginOptions();
        $this->renderInput();
        $this->registerAssets();
    }

    /**
     * Renders a text input for widget display along with an internal
     * hidden input to validate and save the raw number (float) data.
     */
    protected function renderInput()
    {
        $this->_displayOptions = $this->options;
        $this->_displayOptions['id'] .= '-disp';
        $name = $this->_displayOptions['id'];
        if (isset($this->_displayOptions['name'])) {
            unset($this->_displayOptions['name']);
        }
        Html::addCssClass($this->_displayOptions, 'form-control');
        $input = Html::textInput($name, $this->value, $this->_displayOptions);
        $input .= $this->hasModel() ?
            Html::activeHiddenInput($this->model, $this->attribute, $this->options) :
            Html::hiddenInput($this->name, $this->value, $this->options);
        echo $input;
    }

    /**
     * Validates app level formatter settings and sets plugin defaults
     *
     * @param string $paramFrom the property setting in Yii::$app->formatter
     * @param string $paramFrom the setting in jQuery-maskMoney [[pluginOptions]]
     */
    protected function setDefaultFormat($paramFrom, $paramTo)
    {
        $formatter = Yii::$app->formatter;
        if (empty($this->pluginOptions[$paramTo]) && !empty($formatter->$paramFrom)) {
            $this->pluginOptions[$paramTo] = $formatter->$paramFrom;
        }
    }

    /**
     * Initializes default plugin options based on global settings
     * as setup in `Yii::$app->params['maskMoneyOptions']`, else
     * defaults the decimalSeparator and thousandSeparator from
     * `Yii::$app->formatter` settings.
     */
    protected function initPluginOptions()
    {
        if (!empty(Yii::$app->params['maskMoneyOptions'])) {
            $this->pluginOptions += Yii::$app->params['maskMoneyOptions'];
        } else {
            $this->setDefaultFormat('decimalSeparator', 'decimal');
            $this->setDefaultFormat('thousandSeparator', 'thousands');
        }
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        MaskMoneyAsset::register($view);
        $id = '$("#' . $this->_displayOptions['id'] . '")';
        $idSave = '$("#' . $this->options['id'] . '")';
        $this->registerPlugin('maskMoney', $id);
        $js = <<< JS
var val = parseFloat({$idSave}.val());
{$id}.maskMoney('mask', val);
{$id}.on('change', function () {
     var numDecimal = {$id}.maskMoney('unmasked')[0];
    {$idSave}.val(numDecimal);
    {$idSave}.trigger('change');
});
JS;
        $view->registerJs($js);
    }

}