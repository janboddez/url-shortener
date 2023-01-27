# URL Shortener
Simple URL shortening.

To set up, rename `.env.example` to `.env` and add the necessary values. (Make sure to add a random `API_TOKEN`, too.) Also add allowed domains to `config/allowlist.php`.

Creating a shortened URL is done by sending a POST request to https://example.org/shorten, like so:
```
curl -H "Authorization: Bearer w6xc7RjEC79nFSBKuPZKmn" -d "url=https://some.url/and-so-on" https://example.org/shorten
```
If the URL in question contains special characters, a query string, etc., it should be run through, e.g., PHP's `rawurlencode()` first.

If all goes well, the resulting short URL is returned in plain text.

Might later on add rate limiting or an IP-based allowlist, but for now, this is it.
