RMIT University Vietnam
Course: COSC2638-Cloud Computing
Semester: 2021B
Assessment name: Assignment 1 - Build a simple app using Cloud services
Name: Nguyen Thanh Luan 
ID: S3757937
Link: https://cloudcomputing-321710.as.r.appspot.com/
---DESCRIPTION:
--- In this assessment, i completed all three questions with all default requirements:

  1. Build the wep app that use the provided csv file in bucket to deploy CRUD functional web application.
The web is able to fetch data, create new, delete and update. The dataset is slightly modified for better controll (delete null columns, create id column)
Drawback: The web app is not well developed with field validation (only field Name is validated).
Filename: Home.php
Question_path: /home - /

  2. Build the wep app that use data from bigquery with the same dataset from question1.
The web is able to fetch the data with different limitation, filter by country, search by name and functional pagination.
Filename: advancedPage.php
Question_path: /advance

  3. Build the simple wep app that analyse dataset from the web:
My web application similar to question 2 but with different dataset deployed on Bigquery- Game Sale Record on Console from 2011 - 2016.
There is a filter that order data by header columns. This web also have data limit and pagination.
In this question, the search bar is automatically search on keyup.
Source of dataset:https://www.kaggle.com/sidtwr/videogames-sales-dataset
Filename: statisticPage.php
Question_path: /statistics

NOTE: The webapp is a bit slow, it is better to wait few seconds for the page to fully loaded (especially in question 1),
button edit will fill the form with the value. Sometimes the button is not worked for the first click if the page is
not fully loaded, you can try to click them twice.