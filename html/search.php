<!DOCTYPE html>
<!-- TODO: fix this duplication -->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Essays</title>
  <style>
    a {
      font-size: 24px;
    }

    body {
      background-color: black;
      margin: 0;
      padding: 0;
    }

    h1 {
      font-size: 30px;
      font-weight: bold;
      margin-top: 0;
      margin-bottom: 60px;
      text-align: center;
    }

    h2 {
      font-size: 30px;
      font-weight: bold;
      margin-top: 0;
      margin-bottom: 0;
    }

    .main-container {
      margin: 0 auto;
      width: 960px;
      padding: 30px;
      background-color: white;
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      height: 100vh;
    }

    .search-container {
      text-align: center;
      margin-top: 10px;
      margin-bottom: 10px;
    }

    .search-container input[type="text"] {
      padding: 8px;
      font-size: 16px;
      border: solid 1px;
      width: 60%;
      margin-right: 10px;
      border-radius: 10px;
      margin-bottom: 5px;
    }

    .search-container button {
      padding: 8px;
      font-size: 16px;
      border: 1px;
      border-radius: 10px;
    }

    .search-container button:hover {
      cursor: pointer;
    }
  </style>
</head>

<body>

<div class="main-container">

  <h1>
  </h1>

  <div class="search-container">
    <label for="search-input"></label><input type="text" placeholder="Search..." id="search-input">
    <button>Search</button>
  </div>

<div id="display-links"></div>
    <ul>
        <?php
        include 'get-essay-metadata.php';
        $folder = "essays/";
        $result = get_file_list($folder);
        $file_list = $result['file_list'];
        $categories = $result['categories'];

        // Get the current URL
        $currentUrl = "http";
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $currentUrl .= "s";
        }
        $currentUrl .= "://";
        if ($_SERVER['SERVER_PORT'] !== '80') {
            $currentUrl .= $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
        } else {
            $currentUrl .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        }

        // Parse the URL to get the query string
        $queryString = parse_url($currentUrl, PHP_URL_QUERY);

        // Parse the query string to get the value of the "q" parameter
        parse_str($queryString, $queryArray);
        $q = isset($queryArray['q']) ? $queryArray['q'] : '';

        // Loop through categories to check if each has any matching files
        foreach ($categories as $category) {
            $has_matching_files = false; // initialize flag variable
            foreach ($file_list[$category] as $file_info) {
                if (!is_null($q) && strpos(strtolower($file_info["name"]), strtolower($q)) !== false) {
                    $has_matching_files = true; // update flag variable if there's a match
                    break;
                }
            }
            if ($has_matching_files) { // only echo category name if there are matching files
                echo "<h2><br>" . $category . "<br></h2>";
                echo "<ul>";
                foreach ($file_list[$category] as $file_info) {
                    if (!is_null($q) && strpos(strtolower($file_info["name"]), strtolower($q)) !== false) {
                        echo "<li><a href='" . $folder . $file_info["file"] . "'>" . $file_info["name"] . "</a></li>";
                    }
                }
                echo "</ul>";
            }
        }
        ?>
    </ul>

</div>
</body>

<script src="../js/search.js"></script>
<script src="../js/display-search-term.js"></script>

</html>
