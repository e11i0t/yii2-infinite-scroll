<?php

namespace darkcs\infinitescroll;

use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\widgets\LinkPager;

class InfiniteScrollPager extends LinkPager
{
    public $contentSelector = '.list-view';
    public $itemSelector = '.item';
    public $navSelector = '.pagination';
    public $nextSelector = '.pagination .next a:first';
    public $wrapperSelector = '.list-view';
    public $bufferPx = 40;
    public $autoStart = true;
    public $eventOnAppended = "function(arrayOfNewElems) { }";
    public $spinnerTemplate = "<em>Loading the next set of posts...</em>";
    public $finishedMsg = "";
    public $batch = 0;

    // опции jquery плагина напрямую
    public $pluginOptions = [];

    public function init()
    {
        $default = [
            'navSelector' => $this->navSelector,
            'nextSelector' => $this->nextSelector,
            'itemSelector' => $this->itemSelector,
            'state' => [
                'isPaused' => !$this->autoStart,
            ],
            'loading' => [
                'msgText' => $this->spinnerTemplate,
                'selector' => '.loading',
                'img' => '',
                'speed' => 0,
                'finishedMsg' => $this->finishedMsg
            ],
            'bufferPx' => $this->bufferPx,
            'wrapper' => $this->wrapperSelector,
            'batch' => $this->batch

        ];

        $this->pluginOptions = ArrayHelper::merge($default, $this->pluginOptions);

        InfiniteScrollAsset::register($this->view);
        $this->initInfiniteScroll();
        parent::init();
    }

    public function run()
    {
        parent::run();
    }

    public function initInfiniteScroll()
    {
        $options = Json::encode($this->pluginOptions);

        $js = "$('{$this->contentSelector}').infinitescroll({$options}, $this->eventOnAppended);";
        $this->view->registerJs($js);
    }
}
