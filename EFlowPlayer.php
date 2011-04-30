
<?php
/** 
 * EFlowPlayer
 * ===========
 * Yii extension for the [flowplayer](http://www.flowplayer.org)
 *
 * ###Support
 * - Yii 1.1.x
 * - flowplayer 3.2.6
 *
 * This base code was generated with the [gii-extension-generator](http://www.yiiframework.com/extension/gii-extension-generator/)
 * @version 0.1
 * @author Dimitrios Mengidis
 */
class EFlowPlayer extends CWidget
{

    /** The js scripts to register.
     * @var array
     * @since 0.1
     */
    private $js = array(
        'flowplayer-3.2.6.min.js'
    );
    /** The css scripts to register.
     * @var array
     * @since 0.1
     */
    private $css = array(
        'eflowplayer.css',
    );

    /** The asset folder after published
     * @var string
     * @since 0.1
     */
    private $assets;

    private function publishAssets() 
    {
        $assets = dirname(__FILE__).DIRECTORY_SEPARATOR."assets".DIRECTORY_SEPARATOR;
        $this->assets = Yii::app()->getAssetManager()->publish($assets);
    }

    private function registerScripts()
    {
        $cs = Yii::app()->clientScript;

        foreach($this->js as $file)
        {
            $cs->registerScriptFile($this->assets."/".$file, CClientScript::POS_END);
        }
        foreach($this->css as $file)
        {
            $cs->registerCss($this->assets."/".$file);
        }
    }

    public function init()
    {
        $this->publishAssets();
        $this->registerScripts();
    }
    public function run()
    {
    }
}
