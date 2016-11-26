Yii2 Infinite Scroll
====================
LinkPager with infinite scroll support

Installation
------------

```
php composer.phar require --prefer-dist "darkcs/yii2-infinite-scroll" "dev-master"
```

And add to the composer.json

```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/e11i0t/yii2-infinite-scroll"
    }
],
```


Options
-------
##### $autoStart `true`;
##### $containerSelector `.list-view`;
##### $itemSelector `.item`;
##### $navSelector `.pagination`;
##### $nextSelector `.pagination .next a:first`;
##### $wrapperSelector `.list-view`;
##### $bufferPx `40`;
##### $pjaxContainer `null`;
##### $eventOnAppended `function(arrayOfNewElems) { }`;
##### $spinnerTemplate `<em>Loading the next set of posts...</em>`;
##### $finishedMsg;
##### $batch `0`;


Usage example
-------------

```php
$pjax = \yii\widgets\Pjax::begin();

echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'class' => '.list-view',
    ],
    'itemView' => '_item',
    'summary' => false,
    'layout' => '{items}<div class="pagination-wrap">{pager}</div>',
    'pager' => [
        'class' => \darkcs\infinitescroll\InfiniteScrollPager::className(),
        'paginationSelector' => '.pagination-wrap',
        'pjaxContainer' => $pjax->id,
    ],
]);
\yii\widgets\Pjax::end();
```

JS usage
--------

```javascript
// init
$('.list-view').infinitescroll();
// enable, paused by default
$('.list-view').infinitescroll('start');
// disable
$('.list-view').infinitescroll('stop');
```

Events
------
```javascript
$('.list-view').on('infinitescroll:afterRetrieve', function(){
    console.log('infinitescroll:afterRetrieve');
});

$('.list-view').on('infinitescroll:afterStart', function(){
    console.log('infinitescroll:afterStart');
});

$('.list-view').on('infinitescroll:afterStop', function(){
    console.log('infinitescroll:afterStop');
});
```
