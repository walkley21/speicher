<?php

class IDX_Search_Horizontal extends WP_Widget {



	var $options = array(
		'widget_title' => 'Title',
		'widget_subtitle' => 'Sub-title'
		
	);

	function IDX_Search_Horizontal() {
		$widget_ops = array('description' => __("Tribus IDX Search Horizontal") );
		$this->WP_Widget('IDX_Search_Horizontal', __('Tribus IDX Search Horizontal'), $widget_ops);
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
        
        
        
        function new_version($title, $subtitle)
        {
			
             echo $before_widget;
             ?>
             	<style>
					#horizontal-search-home-container td{
							
						
						padding:0 4px;
						text-align:center;
						
					}
					#horizontal-search-home-container th{
						text-align:left;
						padding:0 4px;	
						
					}
					#horizontal-search-home-container input,
					#horizontal-search-home-container select
					{
						width:100%;
						border:1px solid #ccc;
						border-radius:4px;
						height:28px;
						line-height:28px;
					}
					.middle-align{
					vertical-align:middle;	
					line-height:20px;
					}
				</style>
             
                <div id="horizontal-search-home-container" class="row-fluid">
                    	<form  action="<?= get_bloginfo('siteurl');?>/index.php" method="POST" >    
                        <table width="100%"  class="">
                        	
                            <tr>	
                            	
                            	<th>Where?</th>
                                <th>Min price</th>
                                <th>Max price</th>
                                <th>Bedrooms</th>
                                <th>Bathrooms</th>
                                <th valign="base"  style="vertical-align:baseline"class="middle-align" align="center" >
                               
                                </th>
                            </tr>
                            <tr>
                            	
                            	 <td>
                            	 <input style="width:100%" name="location-search" id="location-search" placeholder="Enter a city, neighborhood, or zip" >
                                 <div id='autocomplete' style="position: absolute;width:320px;text-align:left"></div>
                                 </td>
                                 <td>
                            			<input name="idx-q-PriceMin" id="idx-q-PriceMin" class="">
                                 </td>
                                 <td>
                            			<input name="idx-q-PriceMax" id="idx-q-PriceMax" class="">
                                 </td>
                                 <td>
                            	  <select name="idx-q-BathsMin" id="idx-q-BathsMin" class="">
                                    <option value="1">1+</option>
                                    <option value="2" selected>2+</option>
                                    <option value="3">3+</option>
                                    <option value="4">4+</option>
                                    <option value="5">5+</option>
                                    </select>
                                 </td>
                                 <td>
                            	 <select id="idx-q-BedsMin" name="idx-q-BedsMin" class="">
                                    <option value="1">1+</option>
                                    <option value="2">2+</option>
                                    <option value="3" selected>3+</option>
                                    <option value="4">4+</option>
                                    <option value="5">5+</option>
								</select>
                                 </td>
                                 <td><div style="margin-top:-4px;">
                                 	 <button type="submit" id="submitIdxSearch" class="btn btn-primary"> <i class="icon-search icon-white"></i></button>
                                     </div>
                                 </td>
                            </tr>
                        </table>
                        </form>
                 	
                </div>  
                                            
                
                <link rel="stylesheet" type="text/css" href="<? bloginfo("stylesheet_directory"); ?>/css/autocomplete.css"> 
		        <script type="text/javascript" src="http://yui.yahooapis.com/combo?2.8.0r4/build/yuiloader-dom-event/yuiloader-dom-event.js&2.8.0r4/build/animation/animation-min.js&2.8.0r4/build/datasource/datasource-min.js&2.8.0r4/build/autocomplete/autocomplete-min.js"></script>
		        
				
			                         
               
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
						//debugger;
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

		<!--p>
        <label for="<?php echo $this->get_field_id('widget_title'); ?>">Widget Title</label>
		<input class="widefat" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" type="text" value="<?php echo $current['widget_title']; ?>" />
        
        <label for="<?php echo $this->get_field_id('widget_subtitle'); ?>">Widget Sub-title</label>
		<input class="widefat" id="<?php echo $this->get_field_id('widget_subtitle'); ?>" name="<?php echo $this->get_field_name('widget_subtitle'); ?>" type="text" value="<?php echo $current['widget_subtitle']; ?>" />
        
        </p>
		
		<p>Idx Autocomplete Search Box</p-->	
			
<?php
	}
		
}



