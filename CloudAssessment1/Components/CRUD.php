<?php
// define bucket file
define('bucketFile', 'gs://cloud1assessment/project.csv');
function fetchData()
{
    if (!file_exists(bucketFile)) {
        echo "csv does not exist";
        exit();
    } else {
        // Load project's csv file from bucket to array of lines.
        if (($handle = fopen(bucketFile, "r")) !== FALSE) {
            fgetcsv($handle, 1000, ",");
            // loop through each line of csv file and parse to array of information of each line, delimetered by ','
            while (($data = fgetcsv($handle, 9999, ",")) !== FALSE) {
                {
                    // Write data to table of Infrastructure
                    echo "<tr data-id='" . $data[0] . "'>",
                    "<td  class='fixed-side'>",
                    "<form  action='/' method='POST'>"
                    , "<button style='margin:0;' type='submit' value='" . $data[0] . "' name='deleteProject' class='deleteButton'>Delete</button>"//This for edit and delete button
                    , "</form>"
                    , "<form onsubmit=\"updateForm(event, ".$data[0].")\">"
                    , "<button onClick='Window.href='#formtitle'' style='margin:0;' type='submit' value='" . $data[0] . "' name='viewOne' class='editButton'>Edit</button>"
                    , "</form>"
                    , "</td>";
                    foreach ($data as $field) {
                        echo "<td  class='info'>" . $field . "</td>";
                    }
                    echo "</tr>";
                }
            }
            fclose($handle);
        }
    }
}

function addData()
{
    if (!file_exists(bucketFile)) {
        echo '<script>alert("csv does not exist")</script>';
        exit();
    } else {
        $handle = file_get_contents(bucketFile);
        $newid=0;
        if (empty($handle)) {
            $id = 1;
        } else {
            $rows = str_getcsv($handle, "\n");
            $id = ((int)str_getcsv(end($rows), ",")[0]);
            $newid = $id+ 1;
        }
//        $str="";
        $str = sprintf('%d,"%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s"' . "\n", $newid,$_POST['form1'], $_POST['form2'], $_POST['form3'], $_POST['form4'], $_POST['form5'], $_POST['form6'], $_POST['form7'], $_POST['form8'], $_POST['form9'], $_POST['form10'], $_POST['form11'], $_POST['form12'], $_POST['form13'], $_POST['form14'], $_POST['form15'], $_POST['form16'], $_POST['form17'], $_POST['form18'], $_POST['form19'], $_POST['form20'], $_POST['form21'], $_POST['form22'], $_POST['form23'] );
        $handle.=$str;
        $file = fopen(bucketFile, 'w');
        fwrite($file, $handle);
        fclose($file);
    }
}

function deleteData()
{

    if (!file_exists(bucketFile)) {
        echo "csv does not exist";
        exit();
    } else {
        $id= $_POST['deleteProject'];
        $dataArray = file(bucketFile, FILE_IGNORE_NEW_LINES);
        $row=0;
        foreach($dataArray as $key=>$project) {
            $projectObject = explode(",", $project);
            // delete project based on id
            if ($projectObject[0] == $id) {
                if (count($projectObject)<24){
                    unset($dataArray[$key+1]);
                }
                unset($dataArray[$key]);
                // reformat the csv file body
                $csvFileBody = implode("\n", $dataArray);
                $csvFileBody .="\n";
                $csvFile = fopen(bucketFile, "w");
                fwrite($csvFile , $csvFileBody);
                fclose($csvFile );
                break;
            }
            $row++;
        }
    }
}

function editData()
{
    if (!file_exists(bucketFile)) {
        echo "csv does not exist";
        exit();
    } else {
        $id = $_POST['editProject'];
        $replaceString = sprintf('%s,"%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s"',$_POST['id'], $_POST['form1'], $_POST['form2'], $_POST['form3'], $_POST['form4'], $_POST['form5'], $_POST['form6'], $_POST['form7'], $_POST['form8'], $_POST['form9'], $_POST['form10'], $_POST['form11'], $_POST['form12'], $_POST['form13'], $_POST['form14'], $_POST['form15'], $_POST['form16'], $_POST['form17'], $_POST['form18'], $_POST['form19'], $_POST['form20'], $_POST['form21'], $_POST['form22'], $_POST['form23']);

        $arrayObjects=file(bucketFile, FILE_IGNORE_NEW_LINES);
        // loop through each project
        foreach($arrayObjects as $key=>$project) {
            $projectObject = explode(",", $project);
            // get the update employee based on id and update
            if ($projectObject[0] == $id) {


                $arrayObjects[$key] = $replaceString;

                // reformat the csv file body
                $csvFileBody = implode("\n", $arrayObjects);

                // write new value of project to csv fie
                $csvFile = fopen(bucketFile, "w");
                fwrite($csvFile , $csvFileBody);
                fclose($csvFile );
            }
        }
    }
}

?>