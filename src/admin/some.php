<?php
require_once('config.php');
require_once(DIR_SYSTEM . 'startup.php');

// Registry
$registry = new Registry();

// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);

// Database
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$registry->set('db', $db);

function seoURL($str) {
    $str = str_replace("&", "and", html_entity_decode($str));
    return trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($str)), '-');
}
?>
<html>
<head>
    <title>Create SEO-friendly OpenCart URLs</title>
    <style type="text/css">
        body {
            font-family: "Arial";
            font-size: 12px;
            text-align: center;
        }
        #page {
            width: 960px;
            margin: 30px auto 10px auto;
        }
        #page #header { margin-bottom: 20px; }
        #page #header h1 a { text-decoration: none; }
        #page #header h3 { margin-bottom: 20px; }
        .links { font-weight: bold; }
        table { text-align: center; margin-bottom: 10px; }
        th, td { border: 1px solid black; }
    </style>
</head>
<body>
<div id="page">
    <div id="header">
        <h1><a href="seo-links.php">Create SEO-friendly OpenCart URLs</a></h1>
        <h2>Original script by Kartoffelz</h2>
        <h3>Updated by <a href="http://www.logicpwn.com">logicPwn</a> - 8/2/12</h3>
        <span class="links">Create SEO-friendly: <a href="?action=products">Product URLs</a> | <a href="?action=categories">Category URLs</a> | <a href="?action=information">Information URLs</a> | <a href="?action=manufacturers">Manufacturer URLs</a></span>
    </div>
    <?php if (isset($_GET['action'])) {
        $action = strtolower($_GET['action']); ?>
        <table>
            <tr>
                <th width="40">ID</th>
                <th width="440">Name</th>
                <th width="480">Message</th>
            </tr>
            <?php
            if ($action == "products") {
                $products = $db->query("SELECT * FROM ".DB_PREFIX."product");
                $products = $products->rows;
                foreach ($products as $product) {
                    $url = $db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query='product_id=".$product['product_id']."' LIMIT 1");
                    $url = $url->rows;
                    $url = $url[0];
                    $info = $db->query("SELECT * FROM ".DB_PREFIX."product_description WHERE product_id='".$product['product_id']."' LIMIT 1");
                    $info = $info->rows;
                    $info = $info[0];
                    $new_keyword = seoURL($info['name']);
                    if (!empty($url)) {
                        if ($url['keyword'] != $new_keyword) {
                            $db->query("UPDATE ".DB_PREFIX."url_alias SET keyword='".$new_keyword."' WHERE url_alias_id='".$url['url_alias_id']."'"); ?>
                            <tr>
                                <td><?php echo $product['product_id']; ?></td>
                                <td><?php echo $info['name']; ?></td>
                                <td>Updated from "<?php echo $url['keyword']; ?>" to "<?php echo $new_keyword; ?>"</td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td><?php echo $product['product_id']; ?></td>
                                <td><?php echo $info['name']; ?></td>
                                <td>Match found, no action taken</td>
                            </tr>
                        <?php } } else {
                        $db->query("INSERT INTO ".DB_PREFIX."url_alias SET query='product_id=".$product['product_id']."', keyword='".$db->escape($new_keyword)."'"); ?>
                        <tr>
                            <td><?php echo $product['product_id']; ?></td>
                            <td><?php echo $info['name']; ?></td>
                            <td>Inserted URL alias "<?php echo $new_keyword; ?>"</td>
                        </tr>
                    <?php }
                }
            } elseif ($action == "categories") {
                $categories = $db->query("SELECT * FROM ".DB_PREFIX."category");
                $categories = $categories->rows;
                foreach ($categories as $category) {
                    $url = $db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query = 'category_id=".$category['category_id']."' LIMIT 1");
                    $url = $url->rows;
                    $url = $url[0];
                    $info = $db->query("SELECT * FROM ".DB_PREFIX."category_description WHERE category_id='".$category['category_id']."' LIMIT 1");
                    $info = $info->rows;
                    $info = $info[0];
                    $new_keyword = seoURL($info['name']);
                    if (!empty($url)) {
                        if ($url['keyword'] != $new_keyword) {
                            $db->query("UPDATE ".DB_PREFIX."url_alias SET keyword='".$new_keyword."' WHERE url_alias_id='".$url['url_alias_id']."'"); ?>
                            <tr>
                                <td><?php echo $category['category_id']; ?></td>
                                <td><?php echo $info['name']; ?></td>
                                <td>Updated from "<?php echo $url['keyword']; ?>" to "<?php echo $new_keyword; ?>"</td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td><?php echo $category['category_id']; ?></td>
                                <td><?php echo $info['name']; ?></td>
                                <td>Match found, no action taken</td>
                            </tr>
                        <?php } } else {
                        $db->query("INSERT INTO ".DB_PREFIX."url_alias SET query = 'category_id=".$category['category_id']."', keyword = '".$db->escape($new_keyword)."'"); ?>
                        <tr>
                            <td><?php echo $category['category_id']; ?></td>
                            <td><?php echo $info['name']; ?></td>
                            <td>Inserted URL alias "<?php echo $new_keyword; ?>"</td>
                        </tr>
                    <?php }
                }
            } elseif ($action == "information") {
                $informationp = $db->query("SELECT * FROM ".DB_PREFIX."information");
                $informationp = $informationp->rows;
                foreach ($informationp as $information) {
                    $url = $db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query='information_id=".$information['information_id']."' LIMIT 1");
                    $url = $url->rows;
                    $url = $url[0];
                    $info = $db->query("SELECT * FROM ".DB_PREFIX."information_description WHERE information_id = '".$information['information_id']."' LIMIT 1");
                    $info = $info->rows;
                    $info = $info[0];
                    $new_keyword = seoURL($info['title']);
                    if (!empty($url)) {
                        if ($url['keyword'] != $new_keyword) {
                            $db->query("UPDATE ".DB_PREFIX."url_alias SET keyword='".$new_keyword."' WHERE url_alias_id='".$url['url_alias_id']."'"); ?>
                            <tr>
                                <td><?php echo $information['information_id']; ?></td>
                                <td><?php echo $info['title']; ?></td>
                                <td>Updated from "<?php echo $url['keyword']; ?>" to "<?php echo $new_keyword; ?>"</td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td><?php echo $information['information_id']; ?></td>
                                <td><?php echo $info['title']; ?></td>
                                <td>Match found, no action taken</td>
                            </tr>
                        <?php } } else {
                        $db->query("INSERT INTO ".DB_PREFIX."url_alias SET query='information_id=".$information['information_id']."', keyword='".$db->escape($new_keyword)."'"); ?>
                        <tr>
                            <td><?php echo $information['information_id']; ?></td>
                            <td><?php echo $info['title']; ?></td>
                            <td>Inserted URL alias "<?php echo $new_keyword; ?>"</td>
                        </tr>
                    <?php }
                }
            } else if ($action == "manufacturers") {
                $manufacturers = $db->query("SELECT * FROM ".DB_PREFIX."manufacturer");
                $manufacturers = $manufacturers->rows;
                foreach ($manufacturers as $manufacturer) {
                    $url = $db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query='manufacturer_id=".$manufacturer['manufacturer_id']."' LIMIT 1");
                    $url = $url->rows;
                    $url = $url[0];
                    $new_keyword = seoURL($manufacturer['name']);
                    if (!empty($url)) {
                        if ($url['keyword'] != $new_keyword) {
                            $db->query("UPDATE ".DB_PREFIX."url_alias SET keyword='".$new_keyword."' WHERE url_alias_id='".$url['url_alias_id']."'"); ?>
                            <tr>
                                <td><?php echo $manufacturer['manufacturer_id']; ?></td>
                                <td><?php echo $manufacturer['name']; ?></td>
                                <td>Updated from "<?php echo $url['keyword']; ?>" to "<?php echo $new_keyword; ?>"</td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td><?php echo $manufacturer['manufacturer_id']; ?></td>
                                <td><?php echo $manufacturer['name']; ?></td>
                                <td>Match found, no action taken</td>
                            </tr>
                        <?php } } else {
                        $db->query("INSERT INTO ".DB_PREFIX."url_alias SET query='manufacturer_id=".$manufacturer['manufacturer_id']."', keyword='".$db->escape($new_keyword)."'"); ?>
                        <tr>
                            <td><?php echo $manufacturer['manufacturer_id']; ?></td>
                            <td><?php echo $manufacturer['name']; ?></td>
                            <td>Inserted URL alias "<?php echo $new_keyword; ?>"</td>
                        </tr>
                    <?php }
                }
            } ?>
        </table>
        <span class="links" style="font-size: 18px;"><a href="seo-links.php">Back</a></span>
    <?php } ?>
</div>
</body>
</html>