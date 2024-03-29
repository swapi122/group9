{*
 * Copyright (c) 2004-2006 OIC Group, Inc.
 * Written and Designed by James Hunt
 *
 * This file is part of Exponent
 *
 * Exponent is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the
 * License, or (at your option) any later version.
 *
 * GPL: http://www.gnu.org/licenses/gpl.txt
 *
 *}

<div class="textmodule form-edit">
	<div class="form_header">
        	<h1>{$_TR.form_title}</h1>
	        <p>{$_TR.form_header}</p>
	</div>
	{form action="save"}
		{control type="hidden" name="id" value=$textitem->id}
		{control type="editor" name="text" value=$textitem->text}
		{control type=buttongroup submit="submit" cancel="cancel"}
	{/form}
</div>
