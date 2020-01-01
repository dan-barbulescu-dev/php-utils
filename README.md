# php-utils
PHP functions that make life easier / might be useful.

## next_available_filepath – avoid overriding past saved data by using a function to get the next available filepath

There are many situations where you need to save data, and there might be an arbitrary number of past data saved. In these cases, you might not want to override the past data files, but simply save your new data alongside it. Since I’ve encountered this situation many times, in order to quickly deal with it, I’ve put together a small and cozy function which returns the next available filename.

```php
function next_available_filepath($filename_pattern, $iterator_start = 0)
{
    // you give it a filepath like C:\test\random_filename_[i].txt
    // and it will try replacing [i] with ascending numbers, and it will give you back the first available filepath
    // useful to avoid overriding files
     
    $filepath = '';
    $i = $iterator_start;
    do
    {
        $filepath = str_replace('[i]', $i, $filename_pattern);
        $i++;
    } while (file_exists($filepath));
    return $filepath;
}
```
## get_hostname_from_url - function that gets the hostname (subdomain+domain) from an URL

This functions extracts the subdomain + domain from an URL. For example for the $url: “http://mail.google.com/example” it would return “mail.google.com”. It does so by first removing the http protocol, and then considering the text up until the first “/” it encounters to be part of the hostname.

Note that this function only works for URLs with the http and https protocol. For other protocols, you can either use another str_replace function, or adapt it to a more general solution (remove all text before and including

```php
function get_hostname_from_url($url)
{
    $url = str_replace("https://","", $url);
    $url = str_replace("http://","", $url);
    $domain = '';
    $i = 0;
    while ($i < strlen($url))
    {
        if ($url[$i] == '/') break;
        $domain .= $url[$i];
        $i++;
    }
    return $domain;
}
```
