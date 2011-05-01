<h1>意见反馈</h1>

<?php if($error): ?>
<div class="error"><?php echo $error; ?></div>
<?php elseif($success): ?>
<div class="success"><?php echo $success; ?></div>
<?php endif; ?>

<div class="editarea">
	<form method="POST">
		<input name="people_id" type="hidden" value="<?php echo $people_id; ?>" />
		<label>您在使用魔豆遇到的问题或意见: (如需提交请填写几句)</label><br />
		<textarea name="message" rows="2"></textarea><br />
		<label>您的移动设备型号: (可选)</label>
		<input name="type" type="text" /><br />
		<input type="submit" value="提交" />
	</form>
</div>
