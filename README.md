# php-simple-jwt-auth

This is just a short example of how to implement a very basic authentication method using JSON Web Tokens.

It works like this:

1. client sends 'usr' and 'pw' (sha256 of password) via POST request to server
2. server sends back {"token":"THETOKEN"} or status 401
3. client makes requests to protected endpoints with the header "Authorization: THETOKEN"
4. server either accepts the token or sends status 401 (then start again from 1.)
