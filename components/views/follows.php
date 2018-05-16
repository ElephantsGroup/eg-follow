<?php

use elephantsGroup\follow\assets\FollowAsset;

FollowAsset::register($this);
$module = \Yii::$app->getModule('follow');
?>
<div>
	<div class="submit-review">
		<div class="fa fa-check-square" aria-hidden="true"  onclick="post_follow('<?= Yii::getAlias('@web') ?>/follow/ajax/add', '<?= Yii::$app->request->csrfToken; ?>', <?= $service ?>, <?= $item ?>)" id="check-follow<?= $item ?>" style="display: <?= $is_follow ? 'none' : 'block' ?>; cursor: pointer;"></div>
		<div class="fa fa-check-square" aria-hidden="true"  onclick="post_unfollow('<?= Yii::getAlias('@web') ?>/follow/ajax/remove', '<?= Yii::$app->request->csrfToken; ?>', <?= $service ?>, <?= $item ?>)" id="check-unfollow<?= $item ?>" style="display: <?= !$is_follow ? 'none' : 'block' ?>; color: blue; cursor: pointer;"></div>
	</div>
</div>