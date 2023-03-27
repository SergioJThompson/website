<?php
function get_file_list($folder) {
    $files = scandir($folder);
    $categories = array();
    $file_list = array();

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

    return array('file_list' => $file_list, 'categories' => $categories);
}

