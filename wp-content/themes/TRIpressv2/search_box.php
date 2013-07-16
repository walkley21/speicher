<div class="searchform_blog">
						<p class="quickie">Quick Search</p>

					<form action="#">
						<fieldset>
						  <ol>
						    <li>
						      	<label>Where?</label>
						    	<input name="location-search" id="location-search" class="form-field" onblur="if (this.value == '') {this.value = 'Enter a city, neighborhood, or zip';}" onfocus="if (this.value == 'Enter a city, neighborhood, or zip') {this.value = '';}" size="30" value="Enter a city, neighborhood, or zip" style="width:250px;"> 
								<div id='autocomplete'></div>
						    </li>	 
						    <li>
						      <label>Min Price</label>
						      <input name="idx-q-PriceMin" id="idx-q-PriceMin" class="form-field-small" > 
						    </li>
						 	<li>
						      <label>Max Price</label>
						      <input name="idx-q-PriceMax" id="idx-q-PriceMax" class="form-field-small" > 
						    </li>
						    <li>
						      <label>Bedrooms</label>
						      <select name="idx-q-BedsMin" id="idx-q-BedsMin" class="form-select-small"> 
								<option value="1">1+</option> 
								<option value="2">2+</option> 
								<option value="3" selected>3+</option> 
								<option value="4">4+</option> 
								<option value="5">5+</option> 
							</select>
						    </li>
						     <li>
						      <label>Bathrooms</label>
						      <select name="idx-q-BathsMin" id="idx-q-BathsMin" class="form-select-small"> 
								<option value="1">1+</option> 
								<option value="2" selected>2+</option> 
								<option value="3">3+</option> 
								<option value="4">4+</option> 
								<option value="5">5+</option> 
							</select>
						    </li>
						  </ol></fieldset>

						  	
							<button type="submit" id="submitIdxSearch">Search</button>

						</form>

</div>