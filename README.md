# URL Shortener
Simple URL shortening.

Beside the usual (`.env`, etc.), also adapt `config\allowlist.php`.

Creating a shortened URL is done by sending a POST request to https://example.org/shorten, like so:
```
curl -X POST https://example.org/shorten?url=https://some.url/and-so-on
```

If all goes well, the resulting short URL is returned in plain text.

Might later on add rate limiting or an IP-based allowlist, but for now, this is it.
