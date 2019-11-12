# F1NDIN

Scanner de diretórios personalizado.

##### [mod_head]
Busca diretórios usando o método HTTP HEAD 
por padrão se a página retornar 404, O diretório não existe.


##### [mod_body]
Busca diretórios usando uma frase especifica retornada no corpo da página.
Suponhamos que o corpo (body) da resposta retorne algo como ```wooops, página não encontrada```
Então podemos supor que toda página que não existe vai retornar essa frase.


##### [mod_title]
Busca diretórios usando uma frase especifica retornada no título da página.
Mesma coisa do exemplo anterior, Só que agora vamos interpretar o retorno do título. ex:. ```<title> woops .. </title>```



#### USAGE:
``` php F1NDIN.php ["http://www.target.com/"] [asp/php/any] [mod_head/mod_body/mod_title]```




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


