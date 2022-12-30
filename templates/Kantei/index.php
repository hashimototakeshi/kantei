<?php
$this->extend('../layout/TwitterBootstrap/dashboard');

echo '<h2>個人の鑑定</h2>';
echo $this->Form->create(null, [
    'url' => ['action' => 'personaldestiny'],
]);
echo $this->Form->control('dob', [
    'label' => '誕生日',
    'placeholder' => 'YYYY-mm-dd',
]);
echo $this->Form->button('鑑定', [
]);
echo $this->Form->end();

echo '<br/><br/>';
echo '<h2>チーム鑑定</h2>';
echo $this->Form->create(null, [
    'url' => ['action' => 'teamdestiny'],
]);
echo $this->Form->control('teamdob', [
    'label' => '一覧をコピペして下さい',
    'type' => 'textarea',
    'placeholder' => '姓,名,ふりがな,誕生日(YYYY-mm-dd) ',
    'tooltip' => '区切りはカンマもしくはタブで入力します',
]);
echo $this->Form->button('鑑定');
echo $this->Form->end();
