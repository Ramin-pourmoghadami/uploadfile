<?php
session_start();
$allowedFileTypes = array('.jpg', '.png', '.pdf');
$allowedFileTypesWithoutDot = array('jpg', 'png', 'pdf');
$allowedFileTypesSting = implode(',', $allowedFileTypes);
$allowedFileTypesWithoutDotString = implode(",",$allowedFileTypesWithoutDot );
$maxFileSize = 10000000;
$uploadPath = 'uploads/';
$root = "http://pasivan.com/";