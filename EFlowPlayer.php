
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
 * ###Use
 * Here are some examples on how to use this extension.
 *
 * ####Minimal
 * Code:
 * <code>
 *     $this->widget('ext.EFlowPlayer.EFlowPlayer', array(
 *         'flv'=>"http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv",
 *     ));
 * </code>
 * Result:
 * <code><div id="yw0"></div></code>
 *
 * ####With style and id
 * <code>
 *     $this->widget('ext.EFlowPlayer.EFlowPlayer', array(
 *         'flv'=>'http://192.168.1.38/spool/d436.flv',
 *         'htmlOptions'=>array(
 *             'id'=>'testingplayer',
 *              'style'=>'width: 320px; height: 160px;',
 *         ),
 *     ));
 * </code>
 * Result: 
 * <code><div id="testingplayer" style="width: 320px; height: 160px;"></div></code>
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
     * If the flv is a string the will be one video render.
     * If flv is an array then multiple video will be generated.
     * @var mixed
     * @since 0.2
     */
    public $flv;
    /** Tag element player use for container.
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
