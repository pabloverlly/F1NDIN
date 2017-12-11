# F1NDIN

## WEBSITE CRAWLER


###### USAGE:
php F1NDIN.php ["http://www.target.com/"] [asp/php/any] [mod_head/mod_body/mod_title]




		[mod_head]
		Picks up the page response code and interprets.
		By default, Any return code other than 404 is interpreted as a white page.

		[mod_body]
		Takes specific string from the page and interprets.
		It is necessary to configure the non-existent page-specific string.
		By default, The string is "Not found".

		[mod_title]
		Picks up the page title and interprets.
		It is necessary to configure the title string.
		By default, The title string is "404".


