# jsoncachify
PHP library to create cache files of large database entries in .json format.

Basic usage:

```php
<?php
  // Get data from your DB
  $data = get_data_from_db($query);
  
  // file name format
  $filename = "20201024_cache.json";
  
  // Set the absolute path of the folder to save your cached files in
  $folder = "/var/www/mycachedfiles/";
  
  // Instance the object
  $jc = new JsonCachify($filename , $folder);
  
  // Create cache files
  $res = $jc->cachify($data);

?>
```

This will create a file named "20201024_cache.json" inside the folder /var/www/mycachedfiles/
