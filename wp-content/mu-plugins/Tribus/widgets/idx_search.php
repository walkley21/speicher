<?php

class IDX_Search extends WP_Widget {

	function IDX_Search() {
		$widget_ops = array('description' => __("IDX Search") );
		$this->WP_Widget('IDX_Search', __('IDX Search'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$text = apply_filters( 'widget_text', $instance['text'] );
		$link = $instance['link'];
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
			<input name="submit" class="submit" type="submit" />
			<div class="break"></div>
		
		</form>
		<div id="sidebar-form-divider"></div>
		<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.8.0r4/build/yuiloader-dom-event/yuiloader-dom-event.js&2.8.0r4/build/animation/animation-min.js&2.8.0r4/build/datasource/datasource-min.js&2.8.0r4/build/autocomplete/autocomplete-min.js"></script>
				<script type='text/javascript' src='<? bloginfo("stylesheet_directory"); ?>/js/ui.core.js?ver=1.7.3'></script>
				
				<script type='text/javascript' src='<? bloginfo("stylesheet_directory"); ?>/js/ui.tabs.js?ver=1.7.3'></script>
				<link rel="stylesheet" type="text/css" href="<? bloginfo("stylesheet_directory"); ?>/autocomplete.css"> 
				
				
					<script type="text/javascript">
					jQuery("#idx-q-Cities").after("<input type='hidden' name='LocationType' id='LocationType' value=''/><input type='hidden' name='LocationCount' id='LocationCount' value=''/><div id=\'autocomplete\'></div>");
					YAHOO.example.RemoteCustomRequest = function() {
						var oDS = new YAHOO.util.ScriptNodeDataSource("http://api.idx.diversesolutions.com/API/Locations/7973/64?maxAreasToReturn=10&");
						oDS.responseSchema = {
							resultsList: "",
							fields: ["LocationName","LocationCacheTypeID","TotalCount"]
						};
				
						// Instantiate AutoComplete
						var oAC = new YAHOO.widget.AutoComplete("idx-q-Cities","autocomplete", oDS);
						oAC.queryMatchContains = true;
						oAC.queryQuestionMark = false;
						oAC.useShadow = true;
						oAC.queryDelay = .1; 
						oAC.typeAhead = false;
						oAC.allowBrowserAutocomplete = false;
						oAC.alwaysShowContainer = false;
						oAC.resultTypeList = false;
						oAC.maxResultsDisplayed = 10;
						
						oAC.generateRequest = function(sQuery) {
							return "partialName=" + sQuery + "&format=json";
						};
					
						oAC.resultTypeList = false;
						
						oAC.formatResult = function(oResultData, sQuery, sResultMatch) {
							if (oResultData.LocationCacheTypeID == '1') {
								type = "City";
							} else if (oResultData.LocationCacheTypeID == '2') {
								type = "Community";
							} else if (oResultData.LocationCacheTypeID == '3') {
								type = "Tract";
							} else if (oResultData.LocationCacheTypeID == '4') {
								type = "Zip";
							}
							
							return (sResultMatch + " (" +  type + ")");
						};
					
						oAC.itemSelectEvent.subscribe(HiddenFieldSet);
					
						return {
							oDS: oDS,
							oAC: oAC
						};
					}();
				
						function HiddenFieldSet(e, args) {
							if (args[2].LocationCacheTypeID == '1') {
								YAHOO.util.Dom.get("LocationType").value = "City";
							} else if (args[2].LocationCacheTypeID == '2') {
								YAHOO.util.Dom.get("LocationType").value = "Community";
							} else if (args[2].LocationCacheTypeID == '3') {
								YAHOO.util.Dom.get("LocationType").value = "Tract";
							} else if (args[2].LocationCacheTypeID == '4') {
								YAHOO.util.Dom.get("LocationType").value = "Zip";
							}
							YAHOO.util.Dom.get("LocationCount").value = args[2].TotalCount;
						}
					</script>


		<?php
		echo $after_widget;
	}
}



