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

function add_get_parameter_to_url($url, $name, $value)
{
    if (strpos($url, '?') !== FALSE) return $url."&".urlencode($name)."=".urlencode($value);
    else $url."?".urlencode($name)."=".urlencode($value);
}
