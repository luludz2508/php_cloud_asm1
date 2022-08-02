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
?>
<?php
$offset = 0;
$page=0;
echo '<script>console.log("string: a ")</script>';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['page']) && preg_match("/^[0-9]*$/", $_GET['page']) && $_GET['page'] != '0') {
    $page = (int)$_GET['page'];
} else {
    echo '<script>console.log(" asas: ' . $page . ' ")</script>';

    // Auto adding page param on new search or invalid page
    $data = array_filter($_GET);
    $data['page'] = "1";
    echo '<script>console.log(" asas: ' . http_build_query($data) . ' ")</script>';

    header("Location: advance?" . http_build_query($data));
    echo '<script>console.log("string: c ")</script>';

//    exit();
}
?>
<?php
# For Searching
$count = 10;
$search_query = "";
if (isset($_GET['searchValue']) || isset($_GET['comboCountry']) || isset($_GET['comboQuantity'])) {
    $conditions = array();
    if (isset($_GET['searchValue'])) {
        $searchStr = $_GET['searchValue'];
        $conditions[] = "Project_Name like '%$searchStr%'";
    }
    if (isset($_GET['comboCountry'])) {
        $countryString = $_GET['comboCountry'];
        $conditions[] = "Country like '%$countryString%'";
    }
    if (isset($_GET['comboQuantity'])) {
        $count = $_GET['comboQuantity'];
    }
    $search_query = "WHERE " . join(" AND ", $conditions);
}
?>
<?php
//For Pagination
$requestPagination = new Google_Service_Bigquery_QueryRequest();
$qPagination = "SELECT * FROM [cloudcomputing-321710.1stassessment.project] " . $search_query;
$requestPagination->setQuery($qPagination);
$responsePagination = $bigquery->jobs->query($projectId, $requestPagination);
$rowsPagination = $responsePagination->getRows();
echo '<script>console.log("count Rows:' . count($rowsPagination) . ' ")</script>';
$offset = intval($page - 1) * $count;

$totalCount = count($rowsPagination);
echo '<script>console.log("total count: ' . $totalCount . '")</script>';
$num_of_page = ceil(($totalCount) / $count);
echo '<script>console.log("total pages: ' . $num_of_page . '")</script>';

// Auto move back when exceed page
if ($page > $num_of_page && $num_of_page != 0) {
    $data = $_GET;
    $data['page'] = $num_of_page;
    header("Location: home?" . http_build_query($data));
}
// For Table query
$q = "SELECT * FROM [cloudcomputing-321710.1stassessment.project] " . $search_query . " ORDER BY id limit " . intval($count) . " offset " . $offset;
$request->setQuery($q);
$response = $bigquery->jobs->query($projectId, $request);
$rows = $response->getRows();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <link rel="stylesheet" style="text/css" href="/css/AdvanceTable.css">
    <link rel="stylesheet" style="text/css" href="/css/Header.css">
    <link rel="stylesheet" style="text/css" href="/css/InfrastructureForm.css">
    <title>2nd Question</title>
</head>
<?php
include('Components/Header.php');
?>
<body>
<div class="main">
    <div class="searchField">
        <div class="title">
            <h2><?php
                $fields = array();
                foreach ($_GET as $x => $val) {
                    if ($x != 'page') {
                        $fields[] = "$x: $val";
                    }
                }
                echo "Showing results for " . join(", ", $fields) . "</h5>";
                ?></h2>
        </div>
        <form action='/advance' method='get'>
            <!--ComboBox-SearchBox-->
            <div>
                <div class="SearchBar">
                    <label for="searchValue">Search For:</label>
                    <input type="text" rows="1" class="searchArea" id="searchValue" value="<?php
                    (array_key_exists('searchValue', $_GET)) ? print($_GET['searchValue']) : print(""); ?>"
                           name="searchValue">
                </div>
                <br>
            </div>
            <div class="function">
                <!--ComboBox-Limitation-->
                <div class="comboQuantity">
                    <label>Project per page:</label>
                    <select name="comboQuantity" id="comboQuantity">
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
                <!--ComboBox-Nation-->
                <div class="comboCountry">
                    <label>Country:</label>
                    <label for="comboCountry"></label>
                    <select name="comboCountry" id="comboCountry" ">
                    <option value=""></option>
                    <?php
                    $request2 = new Google_Service_Bigquery_QueryRequest();
                    $qCountry = "SELECT Country FROM [cloudcomputing-321710.1stassessment.project] Group by Country";
                    $request2->setQuery($qCountry);
                    $response2 = $bigquery->jobs->query($projectId, $request2);
                    $rowsCountry = $response2->getRows();
                    $echoString = '';
                    foreach ($rowsCountry as $row) {
                        foreach ($row['f'] as $field) {
                            if ($field['v'] == $_GET['comboCountry']) {
                                $echoString .= '<option value="' . $field['v'] . '" selected>' . $field['v'] . '</option>';
                                continue;
                            }
                            $echoString .= '<option value="' . $field['v'] . '" >' . $field['v'] . '</option>';
                        }
                    }
                    echo $echoString;
                    ?>
                    </select>
                </div>
                <br>
            </div>
            <div class="text-center" id="buttonFields">
                <button id="formbuttons" type='submit' value="1" name='page' class="btn btn-start-order">Search
                </button>
            </div>
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
        </form>
    </div>
    <!--    --><?php
    //    if ($isSearching == true) {
    //        $fields = array();
    //        foreach ($_GET as $x => $val) {
    //            if ($x != 'page') {
    //                $fields[] = "$x: $val";
    //            }
    //        }
    //        echo "Showing results for ".join(", ", $fields)."</h5>";
    //    }
    //    ?>
    <div id="table-scroll" class="table-scroll">
        <div class="table-wrap">
            <table class='container'>
                <thead>
                <tr>
                    <th scope='col'><h1>Index</h1></th>
                    <th scope='col'><h1>Project Name</h1></th>
                    <th scope='col'><h1>Subtype</h1></th>
                    <th scope='col'><h1>Current Status</h1></th>
                    <th scope='col'><h1>Capacity (MW)</h1></th>
                    <th scope='col'><h1>Year of Completion</h1></th>
                    <th scope='col'><h1>Country list of Sponsor/Developer</h1></th>
                    <th scope='col'><h1>Sponsor/Developer Company</h1></th>
                    <th scope='col'><h1>Country list of Lender/Financier</h1></th>
                    <th scope='col'><h1>Lender/Financier Company</h1></th>
                    <th scope='col'><h1>Country list of Construction/EPC</h1></th>
                    <th scope='col'><h1>Construction Company/EPC Participant</h1></th>
                    <th scope='col'><h1>Country</h1></th>
                    <th scope='col'><h1>Province/State</h1></th>
                    <th scope='col'><h1>District</h1></th>
                    <th scope='col'><h1>Tributary</h1></th>
                    <th scope='col'><h1>Latitude</h1></th>
                    <th scope='col'><h1>Longitude</h1></th>
                    <th scope='col'><h1>Proximity</h1></th>
                    <th scope='col'><h1>Avg. Annual Output (MWh)</h1></th>
                    <th scope='col'><h1>Data Source</h1></th>
                    <th scope='col'><h1>Announcement/More Information</h1></th>
                    <th scope='col'><h1>Link</h1></th>
                    <th scope='col'><h1>Latest Update</h1></th>
                </tr>
                </thead>
                <tbody><?php
                echo '<script>console.log("' . $q . '")</script>';
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
</body>
</html>