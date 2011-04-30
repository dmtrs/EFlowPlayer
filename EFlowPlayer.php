
<?php
/** 
 * EFlowPlayer
 * ===========
 * Yii extension for the [flowplayer](http://www.flowplayer.org)
 *
 * ###Description 
 * This is an alpha version of the extension. 
 * It supports only the basic configuration.
 *
 * ###Support
 * - Yii 1.1.x
 * - flowplayer 3.2.6
 *
 * This base code was generated with the [gii-extension-generator](http://www.yiiframework.com/extension/gii-extension-generator/)
 * @version 0.2 alpha
 * @author Dimitrios Mengidis
 */
class EFlowPlayer extends CWidget
{
    /** The flv url.
     * @var string
     * @since 0.2
     */
    public $flv;
    /** Tag element player will be.
     * @var string
     * @since 0.2
     */
    public $tag = 'div';
    /** The flowplayer.swf url 
     * @var string 
     * @since 0.2
     */
    public $swfUrl;
    /** The htmlOptions of the video
     * @var array
     * @since 0.2
     */
    public $htmlOptions;
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
            $cs->registerCssFile($this->assets."/".$file);
        }
    }

    public function init()
    {
        $this->publishAssets();
        $this->registerScripts();

        if(!isset($this->htmlOptions['id'])) $this->htmlOptions['id'] = $this->id;
        if(!isset($this->swfUrl)) $this->swfUrl = $this->assets."/flowplayer-3.2.7.swf";
    }
    public function run()
    {
        echo CHtml::openTag($this->tag, $this->htmlOptions);
        echo CHtml::closeTag($this->tag);

        Yii::app()->clientScript->registerScript($this->id, 
            "flowplayer('".$this->htmlOptions['id']."','".$this->swfUrl."', '".$this->flv."')", 
            CClientScript::POS_READY
        );
    }
}
