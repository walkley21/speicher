<?php

class IDX_SearchV2 extends WP_Widget {



	var $options = array(
		'widget_title' => 'Title',
		'widget_subtitle' => 'Sub-title'
		
	);

	function IDX_SearchV2() {
		$widget_ops = array('description' => __("Tribus IDX Search V2(over slider only)") );
		$this->WP_Widget('IDX_Search_V2', __('Tribus IDX Search V2'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$text = apply_filters( 'widget_text', $instance['text'] );
		$link = $instance['link'];
		$current = array_merge($this->options, $instance);
		$title = $current['widget_title'];
		$subtitle = $current['widget_subtitle'];
		
		
		$this->new_version($title,$subtitle);
                
               
	}
        
        function classical()
        {
                echo $before_widget;
		global $post;
		?>
		<h2>SEARCH ALL HOMES</h2>
			
				
		<form action="<?= get_bloginfo('siteurl');?>/index.php" method="POST" class="sidebar-form">
		<input name="action" id="action" type="hidden" value="search" />
			<p>
				<label>What type of home?</label>
				<select name="type" class="form-select">
					<option value="homes">Homes</option>
					<option value="condos">Condos</option>
					<option value="">Homes and Condos</option>
				</select>
			</p>
			<div class="break"></div>

			<p>
				<label>Where?</label>
				<input name="idx-q-Cities" id="idx-q-Cities" class="form-field" onblur="if (this.value == '') {this.value = 'Please enter a city, neighborhood, or zip';}" onfocus="if (this.value == 'Please enter a city, neighborhood, or zip') {this.value = '';}" value="Please enter a city, neighborhood, or zip">
			</p>
			<div class="break"></div>

			<p class="form-left">
				<label>How Much? (min)</label>
				<input name="idx-q-PriceMin" class="form-field-small">
			</p>

			<p class="form-left">
				<label>How Much? (max)</label>
				<input name="idx-q-PriceMax" class="form-field-small">
			</p>
			<div class="break"></div>

			<p class="form-left">
				<label>Beds</label>
				<select name="idx-q-BedsMin" class="form-select-small">
				<option value="1">1+</option>
				<option value="2">2+</option>
				<option value="3" selected>3+</option>
				<option value="4">4+</option>
				<option value="5">5+</option>
				</select>
			</p>

			<p class="form-left">
				<label>Baths</label>
				<select name="idx-q-BathsMin" class="form-select-small">
				<option value="1">1+</option>
				<option value="2" selected>2+</option>
				<option value="3">3+</option>
				<option value="4">4+</option>
				<option value="5">5+</option>
				</select>
			</p>
			<div class="break"></div>

			<div class="search-custom"><a href="<?= get_bloginfo("siteurl");?>/idx/advanced/">Custom Search</a></div>
			<input name="submit"  class="submit" type="submit" />
			<div class="break"></div>
                       
		</form>
		<div id="sidebar-form-divider"></div>
		<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.8.0r4/build/yuiloader-dom-event/yuiloader-dom-event.js&2.8.0r4/build/animation/animation-min.js&2.8.0r4/build/datasource/datasource-min.js&2.8.0r4/build/autocomplete/autocomplete-min.js"></script>
				<link rel="stylesheet" type="text/css" href="<? bloginfo("stylesheet_directory"); ?>/autocomplete.css"> 
		<script type="text/javascript"> 

				YAHOO.Tribus = function() {
					this.formFields = [
						"idx-q-PropertyTypes",
						"idx-q-PriceMin",
						"idx-q-PriceMax",
						"idx-q-BedsMin",
						"idx-q-BathsMin",
						"location-search"
					];

					this.searchType = ["nozeroprop","city","community","tract","zip","area"];
					this.locationTypeId;
					this.locationTypeName;
					this.locationType = [
						"nozeroprop",
						"idx-q-Cities",
						"idx-q-Communities",
						"idx-q-TractIdentifiers",
						"idx-q-ZipCodes",
						"idx-q-Areas"
					];
					this.queryString = "/idx/?";
				};

				YAHOO.Tribus.prototype.RemoteCustomRequest = function() {
					var oDS = new YAHOO.util.ScriptNodeDataSource("http://api.idx.diversesolutions.com/API/Locations/48416/124?maxAreasToReturn=10&");
					oDS.responseSchema = { resultsList: "", fields: ["LocationName","LocationCacheTypeID","TotalCount"] };
					var oAC = new YAHOO.widget.AutoComplete("location-search","autocomplete", oDS);
					oAC.queryMatchContains = true;
					oAC.queryQuestionMark = false;
					oAC.useShadow = true;
					oAC.queryDelay = .1; 
					oAC.typeAhead = false;
					oAC.allowBrowserAutocomplete = false;
					oAC.alwaysShowContainer = false;
					oAC.resultTypeList = false;
					oAC.maxResultsDisplayed = 10;
					oAC.resultTypeList = false;				
					oAC.generateRequest = function(sQuery) { return "partialName=" + sQuery + "&format=json"; };			
					oAC.formatResult = function(oResultData, sQuery, sResultMatch) {
						return ( typeof idx.searchType[oResultData.LocationCacheTypeID] != 'undefined' ) ? sResultMatch + " (" + idx.searchType[oResultData.LocationCacheTypeID] + " - " + oResultData.TotalCount + " listings)" : sResultMatch + " (" + oResultData.TotalCount + " listings)";
					};
					oAC.setLocationCacheTypeId = function(e, args) {
						idx.locationTypeName = args[2].LocationName;
						idx.locationTypeId = args[2].LocationCacheTypeID;
					};
					oAC.itemSelectEvent.subscribe(oAC.setLocationCacheTypeId);		
					return { oDS: oDS, oAC: oAC };
				};

				var idx = new YAHOO.Tribus;
				idx.RemoteCustomRequest();

				jQuery(function($){
					$("#submitIdxSearch").click(function(e){
						e.preventDefault();
						var i, j, val, qStr = '', qObj = {};
						$.each(idx.formFields, function(i,v){
							if ( v == "idx-q-PropertyTypes" ) {
								qObj["idx-q-PropertyTypes"] = '';
								
								qObj["idx-q-PropertyTypes"] = new Array();
								$("input[name='idx-q-PropertyTypes']:checked").each(function(index,el){
									qObj["idx-q-PropertyTypes"].push($(el).val());
								});
								
							} else if ( v == "location-search" ) {
							  if(idx.locationTypeName) {
                  qObj[idx.locationType[idx.locationTypeId]] = escape(idx.locationTypeName);
							  }
							  else {
                  qObj[''] = escape('');
							  }
								// debugger;
							} else {
								qObj[v] = $("#" + v).val();
							}
						});
						for ( i in qObj ) {
							if ( typeof qObj[i] != "string" ) {
								for ( j = 0; j < qObj[i].length; j++ ) {
									qStr += i + "<" + j + ">=" + qObj[i][j] + "&";
								}
							} else if ( qObj[i] != '' ) {
								qStr += i + "=" + qObj[i] + "&";
							}
						}
						debugger;
						window.location = "http://" + window.location.hostname + idx.queryString + qStr.slice(0,-1);
						return false;
					});
				});

			</script>		
				
				


		<?php
		echo $after_widget;
        }
        
        function new_version($title, $subtitle)
        {
			
             echo $before_widget;
             ?>
                <div id="search-home-container">
                    <div id="propertySearchLabel">
                       <span class='search-title'>   
					   		<?php echo $title ?>
                       </span>
                       <span class='search-subtitle'>
					   		<?php echo $subtitle ?>
                       </span>
                    </div>
                    <div id="idx-search-wrapper" style="">
                    <form action="<?= get_bloginfo('siteurl');?>/index.php" method="POST" class="sidebar-form">    
                        <ul>
                            <li class="zipWrapper" >
                                <label>City Community or Zip code</label>
                                <input name="location-search" id="location-search" class="form-field" >
                                <div id='autocomplete' style="position: absolute;width:300px;"></div>
                            </li>
                            <li >
                                <label >Bedrooms</label>
                                <select id="idx-q-BedsMin" name="idx-q-BedsMin" class="form-select-small">
				<option value="1">1+</option>
				<option value="2">2+</option>
				<option value="3" selected>3+</option>
				<option value="4">4+</option>
				<option value="5">5+</option>
				</select>
                                
                            </li>
                            <li >
                                <label>min. price</label>
                                <input name="idx-q-PriceMin" id="idx-q-PriceMin" class="form-field-small">
                                
                            </li>
                            <li  class="emptySpaceSearch-1 shrinkable"></li>
                            
                        </ul>
                        <ul>
                            <li class="emptySpaceSearch-2 shrinkable"></li>
                            <li >
                                <label>Bathrooms</label>
                                <select name="idx-q-BathsMin" id="idx-q-BathsMin" class="form-select-small">
				<option value="1">1+</option>
				<option value="2" selected>2+</option>
				<option value="3">3+</option>
				<option value="4">4+</option>
				<option value="5">5+</option>
				</select>
                            </li>
                            <li >
                                <label>max. price</label>
                               <input name="idx-q-PriceMax" id="idx-q-PriceMax" class="form-field-small">
                            </li>
                            <li >
                                <input  type="submit" name=""  value="search" id="submitIdxSearch"/>
                            </li>
                        </ul>
                    </form>
                    </div>
                </div>  
                                            
                <div id="sidebar-form-divider"></div>
                <link rel="stylesheet" type="text/css" href="<? bloginfo("stylesheet_directory"); ?>/css/autocomplete.css"> 
		<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.8.0r4/build/yuiloader-dom-event/yuiloader-dom-event.js&2.8.0r4/build/animation/animation-min.js&2.8.0r4/build/datasource/datasource-min.js&2.8.0r4/build/autocomplete/autocomplete-min.js"></script>
		<link rel="stylesheet" type="text/css" href="<? bloginfo("stylesheet_directory"); ?>/autocomplete.css"> 
				
			                         
               
                <script type="text/javascript"> 

				YAHOO.Tribus = function() {
					this.formFields = [
						"idx-q-PropertyTypes",
						"idx-q-PriceMin",
						"idx-q-PriceMax",
						"idx-q-BedsMin",
						"idx-q-BathsMin",
						"location-search"
					];

					this.searchType = ["nozeroprop","city","community","tract","zip","area"];
					this.locationTypeId;
					this.locationTypeName;
					this.locationType = [
						"nozeroprop",
						"idx-q-Cities",
						"idx-q-Communities",
						"idx-q-TractIdentifiers",
						"idx-q-ZipCodes",
						"idx-q-Areas"
					];
					this.queryString = "/idx/?";
				};

				YAHOO.Tribus.prototype.RemoteCustomRequest = function() {
					var oDS = new YAHOO.util.ScriptNodeDataSource("http://api.idx.diversesolutions.com/API/Locations/48416/124?maxAreasToReturn=10&");
					oDS.responseSchema = { resultsList: "", fields: ["LocationName","LocationCacheTypeID","TotalCount"] };
					var oAC = new YAHOO.widget.AutoComplete("location-search","autocomplete", oDS);
					oAC.queryMatchContains = true;
					oAC.queryQuestionMark = false;
					oAC.useShadow = true;
					oAC.queryDelay = .1; 
					oAC.typeAhead = false;
					oAC.allowBrowserAutocomplete = false;
					oAC.alwaysShowContainer = false;
					oAC.resultTypeList = false;
					oAC.maxResultsDisplayed = 10;
					oAC.resultTypeList = false;				
					oAC.generateRequest = function(sQuery) { return "partialName=" + sQuery + "&format=json"; };			
					oAC.formatResult = function(oResultData, sQuery, sResultMatch) {
						return ( typeof idx.searchType[oResultData.LocationCacheTypeID] != 'undefined' ) ? sResultMatch + " (" + idx.searchType[oResultData.LocationCacheTypeID] + " - " + oResultData.TotalCount + " listings)" : sResultMatch + " (" + oResultData.TotalCount + " listings)";
					};
					oAC.setLocationCacheTypeId = function(e, args) {
						idx.locationTypeName = args[2].LocationName;
						idx.locationTypeId = args[2].LocationCacheTypeID;
					};
					oAC.itemSelectEvent.subscribe(oAC.setLocationCacheTypeId);		
					return { oDS: oDS, oAC: oAC };
				};

				var idx = new YAHOO.Tribus;
				idx.RemoteCustomRequest();

				jQuery(function($){
					$("#submitIdxSearch").click(function(e){
						e.preventDefault();
						var i, j, val, qStr = '', qObj = {};
						$.each(idx.formFields, function(i,v){
							if ( v == "idx-q-PropertyTypes" ) {
								qObj["idx-q-PropertyTypes"] = '';
								
								qObj["idx-q-PropertyTypes"] = new Array();
								$("input[name='idx-q-PropertyTypes']:checked").each(function(index,el){
									qObj["idx-q-PropertyTypes"].push($(el).val());
								});
								
							} else if ( v == "location-search" ) {
							  if(idx.locationTypeName) {
                  qObj[idx.locationType[idx.locationTypeId]] = escape(idx.locationTypeName);
							  }
							  else {
                  qObj[''] = escape('');
							  }
								// debugger;
							} else {
								qObj[v] = $("#" + v).val();
							}
						});
						for ( i in qObj ) {
							if ( typeof qObj[i] != "string" ) {
								for ( j = 0; j < qObj[i].length; j++ ) {
									qStr += i + "<" + j + ">=" + qObj[i][j] + "&";
								}
							} else if ( qObj[i] != '' ) {
								qStr += i + "=" + qObj[i] + "&";
							}
						}
						debugger;
						window.location = "http://" + window.location.hostname + idx.queryString + qStr.slice(0,-1);
						return false;
					});
				});

			</script>                  
            <?php 
            echo $after_widget;
        }
		
		function update( $new, $old ) {
		$current = array_merge($this->options, $old, $new);
		return $current;
	}
	
	function form( $current ) {
		$current = array_merge($this->options, $current);
?>

		<p>
        <label for="<?php echo $this->get_field_id('widget_title'); ?>">Widget Title</label>
		<input class="widefat" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" type="text" value="<?php echo $current['widget_title']; ?>" />
        
        <label for="<?php echo $this->get_field_id('widget_subtitle'); ?>">Widget Sub-title</label>
		<input class="widefat" id="<?php echo $this->get_field_id('widget_subtitle'); ?>" name="<?php echo $this->get_field_name('widget_subtitle'); ?>" type="text" value="<?php echo $current['widget_subtitle']; ?>" />
        
        </p>
		
		<p>Idx Autocomplete Search Box</p>	
			
<?php
	}
		
}



