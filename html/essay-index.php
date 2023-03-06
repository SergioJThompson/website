<!DOCTYPE html>
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
            font-size: 90px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 0;
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
        All my essays
    </h1>

    <div class="search-container">
        <label for="search-input"></label><input type="text" placeholder="Search for an essay by tag or title..." id="search-input">
        <button>Search</button>
    </div>

    <ul>
        <?php
        $folder = "essays/";
        $files = scandir($folder);
        $categories = array();

        // Loop through files to extract category and file name
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) == "html") {
                $html = file_get_contents($folder . $file);

                preg_match('/name="([^"]*)"\s/', $html, $match);
                $name = isset($match[1]) ? $match[1] : "Essay";

                preg_match('/content="(.*?)">/', $html, $match);
                $current_category = isset($match[1]) ? $match[1] : "Uncategorized";

                // Add new category to array if it doesn't already exist
                if (!in_array($current_category, $categories)) {
                    $categories[] = $current_category;
                }

                $file_list[$current_category][] = array("name" => $name, "file" => $file);
            }
        }

        // Loop through categories and output each one along with its corresponding files
        foreach ($categories as $category) {
            echo "<h2><br>" . $category . "<br></h2>";
            echo "<ul>";
            foreach ($file_list[$category] as $file_info) {
                echo "<li><a href='" . $folder . $file_info["file"] . "'>" . $file_info["name"] . "</a></li>";
            }
            echo "</ul>";
        }
        ?>
    </ul>

</div>

</body>

<script src="/js/search.js"></script>

</html>
