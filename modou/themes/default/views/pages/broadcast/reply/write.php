<p><?php echo '回应'.HTML::anchor('people/'.$comments->author->id, $comments->author->name).'的广播'; ?></p>
<div class="editarea">
	<form action="<?php echo url::base(); ?>broadcast/reply" method="post">
		<input type="hidden" name="miniblog_id" value="<?php echo $miniblog_id; ?>" />
		<textarea id="saying" rows="3" name="message" 
			onkeyup="UpdateCharCounter(this.value, event);"
			onfocus="UpdateCharCounter(this.value, event); "
			onblur="UpdateCharCounter(this.value, event);"></textarea>
		<div>
			<input type="submit" id="update" value="添加回应" />
			<span id="status-counter">128</span>
		</div>
	</form>
	<script type="text/javascript">function updateCount(){document.getElementById("status-counter").innerHTML = 128 - document.getElementById("saying").value.length;setTimeout(updateCount, 400);}updateCount();</script>
</div>
<hr />