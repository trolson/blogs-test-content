<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<input type="text" value="<?php '. get_search_query(); . ' ?>" name="s" id="s"/>
	<input type="submit" value=" " class="searchSubmit"/>
</form>
