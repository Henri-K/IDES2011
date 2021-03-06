	     <?php
	     error_reporting(E_ALL);
		 ini_set('display_errors', false);
     	 require_once('functions-db.php');
		 $db_control = new dataBase();
//jjjjj
	     ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all"/>
<link rel="stylesheet" href="css/jquery.hrzAccordion.examples.css" type="text/css" media="all"/>
<link rel="stylesheet" href="css/jquery.hrzAccordion.defaults.css" type="text/css" media="all"/>-->
<link rel="stylesheet" href="css/main.css" type="text/css" media="all"/>
<!--<link rel="stylesheet" href="css/style.css" type="text/css" media="all"/>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js" type="text/javascript"></script>
<script src="scripts/jquery.quicksand.js" type="text/javascript"></script>

<title>IDES Graduates 2011</title>
</head>

<body>
	<script>
		(function($) {
		  $.fn.sorted = function(customOptions) {
			var options = {
			  reversed: false,
			  by: function(a) { return a.text(); }
			};
			$.extend(options, customOptions);
			$data = $(this);
			arr = $data.get();
			arr.sort(function(a, b) {
			  var valA = options.by($(a));
			  var valB = options.by($(b));
			  if (options.reversed) {
				return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;				
			  } else {		
				return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;	
			  }
			});
			return $(arr);
		  };
		})(jQuery);
		
		// DOMContentLoaded
		$(function() {
		
		  // bind radiobuttons in the form
		  var $filterGroup = $('#filter input[name="group"]');
		  var $filterSort = $('#filter input[name="sort"]');
		
		  // get the first collection
		  var $students = $('#students');
		
		  // clone students to get a second collection
		  var $data = $students.clone();
		
		  // attempt to call Quicksand on every form change
		  $filterGroup.add($filterSort).change(function(e) {
			if ($($filterGroup+':checked').val() == 'all') {
			  var $filteredData = $data.find('li');
			} else {
			  var $filteredData = $data.find('li[data-type=' + $($filterGroup+":checked").val() + ']');
			}
		
			// sorted by first name
			if ($('#filter input[name="sort"]:checked').val() == "first") {
				//if sorted by first name
			  var $sortedData = $filteredData.sorted({
				by: function(v) {
					return $(v).find('strong').text().toLowerCase();
				}
			  });
			}
			// sorted by first name
			else if ($('#filter input[name="sort"]:checked').val() == "last") {
			  // if sorted by last name
			  var $sortedData = $filteredData.sorted({
				by: function(v) {
					return $(v).find('span[data-type="last"]').text().toLowerCase();
				}
			  });
			}  
		
			// finally, call quicksand
			$students.quicksand($sortedData, {
			  duration: 800,
			  easing: 'easeInOutQuad'
			});
		
		  });
		
		});
		
		
		jQuery(document).ready(function() 
		{
			lastBlock = $("#home");
			maxWidth = 840;
			minWidth = 40;	
			
			//$(lastBlock).animate({width: maxWidth+"px"}, { queue:false, duration:400 });
			
			//main navigation
			$("ul.mainContent li.mainNav").mousedown
			(
				function()
				{
					$(lastBlock).animate({width: minWidth+"px"}, { queue:false, duration:400});
					
					$(this).animate({width: maxWidth+"px"}, { queue:false, duration:400});
					lastBlock = this;
				}
			);
			
			$('.sorting_box #groups :radio').focus(updateSelectedStyle);
       		$('.sorting_box #groups :radio').blur(updateSelectedStyle);
        	$('.sorting_box #groups :radio').change(updateSelectedStyle);
    	
	    	function updateSelectedStyle() 
	    	{
		        $('.sorting_box #groups :radio').parent().removeClass('focused');//.next().removeClass('focused');
		        $('.sorting_box #groups :radio:checked').parent().addClass('focused');//.next().addClass('focused');
		    }
			
		});
		
	</script>	
	<div class="full">
		<div class="header"></div>
		<ul class="mainContent">
			<li class="mainNav" id="home" title="Home">
			  <div class="nav" id="nav_home"> 
		  	  <div class="content">
			        <div id="theme">
                    	
                      <div id="map">
                        	<p>
                            	APRIL 16TH-19TH, 10AM-5MP<br />
                                UNIVERSITY CENTRE GALLERIA
                            </p>
                        	<img src="images/home/map.png" />
                            <P>
                            	PARKING AVAILABLE IN LOT 2<br />
								FREE PARKING ON WEEKENDS
                            </P>
                      </div>
		            <img src="images/home/exhibitlogo_green.png" /></div>
			    </div>
			  </div>    
      </li>
			<li class="mainNav" id="projects" title="Projects">
			  <div class="nav" id="nav_projects">
			    <div class="content">
			      <ul id="students" class="image-grid">
				
                
                	<?php
					 	$query =  $db_control->query_getStudents();
						$i=1;
						while($row = mysql_fetch_array($query)){ 
							echo '<li data-id="id-'.$i.'" data-type="'.$row["grp_name"].'">';
							echo '<img src="./images/students/'.$row["stu_fname"].'_'.$row["std_lname"].'.jpg" />';
							echo '<div class="StuName"><strong>'. $row["stu_fname"] .'</strong> ';
							echo '<span data-type="'.$row["std_lname"].'">'.$row["std_lname"].'</span></div>';
							echo '</li>';
							$i++;
						}
	
					?>
			
			      </ul>
			      <div class="sorting_box" id="filter">
			            <fieldset id="groups">
			              <legend>Groups</legend>
			              <label id="all"><input type="radio" name="group" value="all" checked="checked">All</label>
			              <label id="rim"><input type="radio" name="group" value="rim">Mobile Life</label>
			              <label id="omnr"><input type="radio" name="group" value="omnr">OMNR: Firetactics</label>
			              <label id="cpc"><input type="radio" name="group" value="cpc">CPC: Adaptive Sports</label>
			              <label id="st"><input type="radio" name="group" value="st">Smart Technologies: </label>
			              <label id="lt"><input type="radio" name="group" value="lt">Lota Renovación</label>
                          <label id="Teknion"><input type="radio" name="group" value="Teknion">Workspace Next</label>
			            </fieldset>
			            <fieldset id="fullnames">
			              <legend>Sort by Name</legend>
			              <label><input type="radio" name="sort" value="first" checked="checked">First</label>
			              <label><input type="radio" name="sort" value="last">Last</label>      
			            </fieldset>
					</div>
			    </div>
			  </div>
			</li>
			<li class="mainNav" id="alumni" title="Alumni">
			  <div class="nav" id="nav_alumni">
			  	<div class="content">
                	Alumni Night<br />APRIL 16TH, 2011, 5–8PM, UNIVERSITY CENTRE GALLERIA<br/><br/>
                    	<table width="700" border="0">
						  <tr>
  						 	 <td><center>
                             	<img src="images/Ostiguy.jpg"  /><br /><br /><br />
                                <img src="images/CSeal.png" width="120" height="120" alt="Cseal" /></center><br /><br />
                                Complimentary refreshments.<br/>
                                Free parking available in Lot P2.</td>
 						 	  <td width="490"><br /><br />
                              The School of Industrial Design and the Carleton University Alumni Association, Industrial Design 	Chapter, invite you to the annual Alumni Night, on April 16th, 2011 at 5PM, to honour the contributions of Jacques Ostiguy to the School of Industrial Design. Featuring presentations by Floyd Pushelberg and many others.<br/>
Please register at alumni.carleton.ca/events<br/>
	<img src="images/bar.jpg" alt="" width="490" height="3" /><br/>
<img src="images/map.jpg" width="490" height="237" alt="map" border='1' /></td>
						 </tr>
						</table>
                       	
			    </div>	  
			  </div>
			</li>
			<li class="mainNav" id="sponsor" title="Sponsors">
			  <div class="nav" id="nav_sponsors">
			  		<div class="content">
                    	Sponsors + Thanks<br /><br />The School of Industrial Design and the 2010-11 Bachelor of Industrial Design graduating class would like to sincerely thank this year’s collaborators and sponsors for their contributions and support.
                    	
			    	</div>	  
			  	</div>  
			</li>
			<li class="mainNav" id="staff" title="Staff and Supporters">
				<div class="nav" id="nav_staff">
			  		<div class="content">
			        	Staff + Support<br /><br />In addition to their sponsors, the 2010-11 Bachelor of Industrial Design graduating class would like to also thank the faculty and staff at the School of Industrial Design.
                       	<br /><br />
                        <table width="700" border="0">
                          <tr>
                            <td  >FACULTY:<br />
                              Thomas GarveyDirector,<br /> School of Industrial Design<br />
                              Brian BurnsAssociate Professor,<br /> School of Industrial Design<br />
                              WonJoon ChungAssociate Professor,<br /> School of Industrial Design<br />
                              Stephen FieldInstructor,<br /> School of Industrial Design<br />
                              Lois FrankelAssociate Professor,<br /> School of Industrial Design<br />
                              Bjarki HallgrimssonAssociate Professor,<br /> School of Industrial Design<br />
                            Lorenzo ImbesiAssociate Professor,<br /> School of Industrial Design</td>
                            <td>STAFF:<br />
                              Diane SmythAdministrator,<br /> School of Industrial Design<br />
                              Valerie DaleyAdministrative Assistant,<br /> School of Industrial Design<br />
                              Walter ZanettiChief Technician,<br /> School of Industrial Design<br />
                              Jim DewarMachine Shop Technician,<br /> School of Industrial Design<br />
                              Terry FlahertyWood Shop Technician,<br /> School of Industrial Design<br />
                            Andrew PullinComputer Technician,<br /> School of Industrial Design</td>
                          </tr>
                          </table>
			    	</div>	  
			  	</div> 
			</li>
		</ul>
	</div>
</body>
</html>
