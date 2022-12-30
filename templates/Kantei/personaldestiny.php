<div class="row">
    <div class="col-12 col-md-3">
        <?= $this->Form->create() ?>
        <?= $this->Form->control('dob'); ?>
        <?= $this->Form->submit(); ?>
        <?= $this->Form->end(); ?>
    </div>
    <div class="col-12 col-md-9 1bgc-default-l4 pt-0 radius-1 d-flex flex-column pos-rel mt-2 mt-md-0">
        <div>
        <?php echo $this->element(
            'studentDestiny',
            compact('zero', 'shuku', 'jukkan', 'lifeSteps')
        ); ?>
        </div>
        <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-120">生徒の概要</h4>
            </div>
            <div class="card-body">
                <dl class="dl-horizontal">
                    <?php if (isset($shuku['name'])) : ?>
                    <dt>宿曜</dt>
                    <dd><?= $shuku['name']  ?>(<?= $shuku['yomi'] ?>)</dd>
                    <dd><?= $shuku['description'] ?></dd>
                    <dt>十干支</dt>
                    <dd><?= $jukkan['name'] ?>(<?= $jukkan['yomi'] ?>)</dd>
                    <dd><?= $jukkan['description'] ?></dd>
                    <dt>ゼロ学</dt>
                    <dd><?= $zero['name'] ?></dd>
                    <dd><?= $zero['description'] ?></dd>
                    <?php endif; ?>
                </dl>
            </div>   
        </div>
        </div>
    </div>
</div>
