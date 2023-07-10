<?php

use yii\helpers\Html;
use Orhanerday\OpenAi\OpenAi;

/* @var $this yii\web\View */

$this->title = 'OpenAI';

$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="view">
    <h1><?= $this->title ?></h1>
</div>



<?php $open_ai_key = getenv('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');
$open_ai = new OpenAi($open_ai_key);
$open_ai->setORG("org-41xvUAFcddWIuOehauFAFTC5");

$chat = $open_ai->chat([
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        [
            "role" => "system",
            "content" => "You are a helpful assistant."
        ],
        [
            "role" => "user",
            "content" => "Who won the world series in 2020?"
        ],
        [
            "role" => "assistant",
            "content" => "The Los Angeles Dodgers won the World Series in 2020."
        ],
        [
            "role" => "user",
            "content" => "Where was it played?"
        ],
    ],
    'temperature' => 1.0,
    'max_tokens' => 4000,
    'frequency_penalty' => 0,
    'presence_penalty' => 0,
]);


var_dump($chat);
echo "<br>";
echo "<br>";
echo "<br>";
// decode response
$d = json_decode($chat);
// Get Content
if (isset($d->choices[0]->message->content)) {
    echo($d->choices[0]->message->content);
} else {
    echo 'Sin resultado';
}

?>