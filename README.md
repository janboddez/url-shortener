# URL Shortener
Simple URL shortening.

Beside the usual (`.env`, etc.), also adapt `config/allowlist.php`.

Creating a shortened URL is done by sending a POST request to https://example.org/shorten, like so:
```
curl -X POST https://example.org/shorten?url=https://some.url/and-so-on
```
If the URL in question contains special characters, a query string, etc., better make sure it is run through, e.g., PHP's `rawurlencode()` first.

If all goes well, the resulting short URL is returned in plain text.

Might later on add rate limiting or an IP-based allowlist, but for now, this is it.
