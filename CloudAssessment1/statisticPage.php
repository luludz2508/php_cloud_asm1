<?php
session_start();
require_once 'php/google-api-php-client/vendor/autoload.php';
?>
<?php
$projectId = 'cloudcomputing-321710';
$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Bigquery::BIGQUERY);
$bigquery = new Google_Service_Bigquery($client);
$request = new Google_Service_Bigquery_QueryRequest();
//Fetch value on uri here

$offset = 0;
$page=1;
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['page']) && preg_match("/^[0-9]*$/", $_GET['page']) && $_GET['page'] != '0') {
    $page = (int)$_GET['page'];
} else {

    // Auto adding page param on new search or invalid page
    $data = array_filter($_GET);
    $data['page'] = "1";

    header("Location: statistics?" . http_build_query($data));
//    exit();
}

$searchString='';
if (isset($_GET['searchValue'])){
    $searchString=$_GET['searchValue'];
}
//For Pagination
$requestPagination = new Google_Service_Bigquery_QueryRequest();
$qPagination = "SELECT * FROM [cloudcomputing-321710.1stassessment.game] where Name like '%".$searchString."%'";
echo '<script>console.log("pagination query:' . $qPagination . ' ")</script>';

$requestPagination->setQuery($qPagination);
$responsePagination = $bigquery->jobs->query($projectId, $requestPagination);
$rowsPagination = $responsePagination->getRows();
$count=10;
if (isset($_GET['comboQuantity'])){
    $count=$_GET['comboQuantity'];
}
$totalCount = count($rowsPagination);
$offset = intval($page - 1) * $count;

echo '<script>console.log("total count: ' . $totalCount . '")</script>';
$num_of_page = ceil(($totalCount) / $count);
echo '<script>console.log("total pages: ' . $num_of_page . '")</script>';

// Auto move back when exceed page
if ($page > $num_of_page && $num_of_page != 0) {
    $data = $_GET;
    $data['page'] = $num_of_page;
    header("Location: home?" . http_build_query($data));
}
?>


<html>

<head>
    <meta charset='UTF-8'>
    <link rel="stylesheet" style="text/css" href="css/statistics.css">
    <link rel="stylesheet" style="text/css" href="css/Header.css">
    <title>3rd Question</title>
</head>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="https://apis.google.com/js/client.js"></script>
<?php
include('Components/Header.php');
?>
<body style="background: #fff url('http://www.gamehype.co.uk/wp-content/uploads/2017/01/playstation_3_collage_by_ereeen-d3lgqke.jpg') ;background-repeat: no-repeat;background-attachment: fixed;  background-size: cover;">
<?php
include('Components/waitingRequest.php');
?>
<div class="main" style="background-color: #2f323a">

    <div class="statisticForm">
        <div class="title"><h2>Game Sale Record on Console from 2011 - 2016</h2></div>
        <form action='/statistics' method='get'>
            <!--ComboBox-SearchBox-->
            <div>
                <div class="SearchBar">
                    <label for="searchValue">Search For:</label>
                    <input type="text" rows="1" class="searchArea" onkeyup="this.form.submit();" id="searchValue"
                           value="<?php
                           (array_key_exists('searchValue', $_GET)) ? print($_GET['searchValue']) : print(""); ?>"
                           name="searchValue">
                    <input type="text" id="page" value="1" name="page" style="display: none">
                </div>
                <br>
            </div>
            <!--ComboBox-Limitation-->
            <div class="function">
                <div class="comboQuantity">
                    <label>Game per page:</label>
                    <select name="comboQuantity" id="comboQuantity" onchange="this.form.submit();">
                        <option value="10" <?php if ($_GET['comboQuantity'] == '10') echo 'selected'; ?>>10</option>
                        <option value="20" <?php if ($_GET['comboQuantity'] == '20') echo 'selected'; ?>>20</option>
                        <option value="50" <?php if ($_GET['comboQuantity'] == '50') echo 'selected'; ?>>50</option>
                        <option value="100" <?php if ($_GET['comboQuantity'] == '100') echo 'selected'; ?>>100</option>
                        <option value="200" <?php if ($_GET['comboQuantity'] == '200') echo 'selected'; ?>>200</option>
                        <option value="500" <?php if ($_GET['comboQuantity'] == '500') echo 'selected'; ?>>500</option>
                        <option value="1000" <?php if ($_GET['comboQuantity'] == '1000') echo 'selected'; ?>>1000
                        </option>
                        <option value="<?php
                        echo $totalCount;
                        ?>>" <?php if ($_GET['comboQuantity'] == $totalCount) echo 'selected'; ?>>All
                        </option>
                    </select>
                </div>
                <!--comboHeader-->
                <div class="comboHeader">
                    <label>Sort by:</label>
                    <label for="comboHeader"></label>
                    <select name="comboHeader" id="comboHeader" onchange="this.form.submit();">
                        <option value="Name" <?php if ($_GET['comboHeader'] == 'Name') echo 'selected'; ?>>Name</option>
                        <option value="Platform" <?php if ($_GET['comboHeader'] == 'Platform') echo 'selected'; ?>>Platform
                        </option>
                        <option value="Year_of_Release" <?php if ($_GET['comboHeader'] == 'Year_of_Release') echo 'selected'; ?>>
                            Year_of_Release
                        </option>
                        <option value="Genre" <?php if ($_GET['comboHeader'] == 'Genre') echo 'selected'; ?>>Genre</option>
                        <option value="Global_Sales" <?php if ($_GET['comboHeader'] == 'Global_Sales') echo 'selected'; ?>>
                            Global_Sales
                        </option>
                        <option value="Rating" <?php if ($_GET['comboHeader'] == 'Rating') echo 'selected'; ?>>Rating
                        </option>
                    </select>
                </div>
            </div>
        </form>
        <!--Pagination-->
        <div class="paginationField">
            <div class="center">
                <div class="pagination" name="pagination">
                    <a href="<?php
                    echo str_replace('page=' . $page, 'page=' . 1, $_SERVER['REQUEST_URI']);
                    ?>">&laquo;</a>
                    <a class="page-link"
                       href=<?php
                       if ($page > 1) {
                           echo str_replace('page=' . $page, 'page=' . ($page - 1), $_SERVER['REQUEST_URI']);
                       } else {
                           echo '"#"';
                       }
                       ?> tabindex="-1">Previous</a>
                    <?php

                    $start = $page > 3 ? $page - 2 : 1;
                    if ($start - 4 > 1) {
                        echo '<a class="page-link">...</a>';
                    }
                    for ($x = $start; $x <= min($start + 4, $num_of_page); $x++) {
                        if ($x == $page) {
                            echo '<a class="page-link active" href="#">' . $x . '</a>';
                        } else {
                            $href = str_replace('page=' . $page, 'page=' . $x, $_SERVER['REQUEST_URI']);
                            echo '<a class="page-link" href="' . $href . '">' . $x . '</a>';
                        }
                    }
                    if ($start + 4 < $num_of_page) {
                        echo '<a class="page-link">...</a>';
                    }
                    ?>
                    <a class="page-link" href=<?php
                    if ($page < $num_of_page) {
                        echo str_replace('page=' . $page, 'page=' . ($page + 1), $_SERVER['REQUEST_URI']);
                    } else {
                        echo '"#"';
                    }
                    ?>>Next</a>
                    <a href="<?php
                    echo str_replace('page=' . $page, 'page=' . $num_of_page, $_SERVER['REQUEST_URI']);
                    ?>">&raquo;</a>
                </div>
            </div>
        </div>
    </div>

    <div class="statisticTable">
        <div id="table-scroll" class="table-scroll">
            <div class="table-wrap">
                <table class="container">
                    <thead>
                    <tr>
                        <th scope="col"><h1>Name</h1></th>
                        <th scope="col"><h1>Platform</h1></th>
                        <th scope="col"><h1>Year_of_Release</h1></th>
                        <th scope="col"><h1>Genre</h1></th>
                        <th scope="col"><h1>Publisher</h1></th>
                        <th scope="col"><h1>NA_Sales</h1></th>
                        <th scope="col"><h1>EU_Sales</h1></th>
                        <th scope="col"><h1>JP_Sales</h1></th>
                        <th scope="col"><h1>Other_Sales</h1></th>
                        <th scope="col"><h1>Global_Sales</h1></th>
                        <th scope="col"><h1>Critic_Score</h1></th>
                        <th scope="col"><h1>Critic_Count</h1></th>
                        <th scope="col"><h1>User_Score</h1></th>
                        <th scope="col"><h1>User_Count</h1></th>
                        <th scope="col"><h1>Developer</h1></th>
                        <th scope="col"><h1>Rating</h1></th>
                    </tr>
                    </thead>
                    <tbody><?php
                    echo '<script>console.log("Begin")</script>';

                    $q = "SELECT * FROM [cloudcomputing-321710.1stassessment.game]  ";

                    if (isset($_GET['searchValue'])) {
                        $q .= "where Name like'%" . $_GET['searchValue'] . "%'";
                    }

                    if (isset($_GET['comboHeader'])) {
                        $q .= " order by " . $_GET['comboHeader'] . " DESC ";
                    }
                    $limit=10;
                    if (isset($_GET['comboQuantity'])) {
                        $limit=$_GET['comboQuantity'];
                    }
                    $q .= "limit " . $limit ;
                    $q.=" offset ".$offset;
                    echo '<script>console.log("Query: ' . $q . '")</script>';
                    $request->setQuery($q);
                    echo '<script>console.log("Requested")</script>';

                    $response = $bigquery->jobs->query($projectId, $request);
                    echo '<script>console.log("Responded")</script>';

                    $rows = $response->getRows();
                    echo '<script>console.log("Get rows")</script>';
                    $str = '';
                    foreach ($rows as $row) {
                        $str .= "<tr>";

                        foreach ($row['f'] as $field) {
                            $str .= "<td  class='info'>" . $field['v'] . "</td>";
                        }
                        $str .= "</tr>";
                    }
                    echo $str;
                    ?></tbody>

                </table>
            </div>
        </div>

    </div>
</div>
</body>
</html>