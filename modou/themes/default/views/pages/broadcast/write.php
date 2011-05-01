<div class="editarea">
	<form action="<?php echo url::base(); ?>broadcast/create" method="post">
		<textarea id="saying" rows="3" name="status" 
			onkeyup="UpdateCharCounter(this.value, event);"
			onfocus="UpdateCharCounter(this.value, event); "
			onblur="UpdateCharCounter(this.value, event);"></textarea>
		<div>
			<input type="submit" id="update" value="我说" />
			<span id="status-counter">128</span>
		</div>
	</form>
	<script type="text/javascript">function updateCount(){document.getElementById("status-counter").innerHTML = 128 - document.getElementById("saying").value.length;setTimeout(updateCount, 400);}updateCount();</script>
</div>
<hr />