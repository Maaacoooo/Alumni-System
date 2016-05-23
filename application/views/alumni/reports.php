<?php
/*
 * Copyright (c)2016, Jenmar "Maco" Cortes
 * Copyright TechDepot PH
 * All Rights Reserved
 * 
 * This license is a legal agreement between you and the Maco Cortes
 * for the use of ALUMNI INFORMATION SYSTEM referred to as the "Software"
 * By obtaining the Software you agree to comply with the terms and conditions of this license.
 *
 * PERMITTED USE
 * With approval from Maco Cortes, You are permitted to use the program for educational purposes only.
 * 
 * MODIFICATION AND REDISTRIBUTION 
 * Unless with written approval obtained from Maco Cortes, 
 * You are NOT allowed to modify, copy, redistribute, and sell the Software.
 *
 * For any concerns, you may reach Maco Cortes via:
 * maco.techdepot@gmail.com
 * facebook.com/Maaacoooo
 * maco@techdepot-ph.com
 * TechDepot-PH.com
 */
?>
<html>
<head>
	<title><?=$title?> &middot; <?=$site_title?></title>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/print.css')?>">
</head>
<body onload="javascript:print()">
	<table class="table">		  
    <thead>
      <tr>
        <th colspan="5">ALUMNI STUDENTS</th>
      </tr>
      <tr>
        <th>Student ID</th>
        <th>Student</th>
        <th>Course</th>
        <th>Batch Year</th>
      </tr>
    </thead>       
    <tbody>
      <?php 
          if($students):
          foreach($students as $student):
        ?>
      <tr>      
        <td><?=$student['student_id']?></td>
        <td><?=$student['name']?> <?=$student['middlename']?> <?=$student['lastname']?></td>
        <td><?=$student['course']?></td>
        <td><?=$student['year']?></td>
      </tr>
      <?php endforeach;
        endif;?>
    </tbody>   
	</table>
</body>
</html>
