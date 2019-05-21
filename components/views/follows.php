<?php

use elephantsGroup\follow\assets\FollowAsset;

FollowAsset::register($this);
$module = \Yii::$app->getModule('follow');
?>
<div>
	<div class="submit-review">
		<div class="fas fa-check-square" aria-hidden="true"  onclick="post_follow('<?= Yii::getAlias('@web') . $module->add_path ?>', '<?= Yii::$app->request->csrfToken; ?>', <?= $service ?>, <?= $item ?>)" id="check-follow<?= $item ?>" style="display: <?= $is_follow ? 'none' : 'block' ?>; color: <?= $color; ?>; cursor: pointer;"></div>
		<div class="fas fa-check-square" aria-hidden="true"  onclick="post_unfollow('<?= Yii::getAlias('@web') . $module->remove_path ?>', '<?= Yii::$app->request->csrfToken; ?>', <?= $service ?>, <?= $item ?>)" id="check-unfollow<?= $item ?>" style="display: <?= !$is_follow ? 'none' : 'block' ?>; color: blue; cursor: pointer;"></div>
	</div>
</div>
