<div class="container" ng-app="mySong" ng-controller="showlist">
    <h2>You are in the View: application/view/song/index.php (everything in this box comes from that file)</h2>
    <!-- add song form -->
    <div class="box">
        <h3>Add a song {{cfdump}}</h3>
        <form ng-submit="submit()" name="myForm" novalidate>
            <label>Artist</label>
            <input type="text" name="artist" ng-model="artist" value="" required />
			  <span style="color:red" ng-show="myForm.artist.$invalid">
			  <span ng-show="myForm.artist.$error.required">artist is required.</span>
			  </span>			
            <label>Track</label>
            <input type="text" name="track" ng-model="track" value="" required />
			  <span style="color:red" ng-show="myForm.track.$invalid">
			  <span ng-show="myForm.track.$error.required">track is required.</span>
			  </span>			  
            <label>Link</label>
            <input type="text" name="linkv" ng-model="linkv" value="" />
            <input type="submit" name="Submit" value="Submit" ng-disabled="myForm.track.$invalid || myForm.email.$invalid" />
        </form>
    </div>
    <!-- main content output -->
    <div class="box">
        <h3>Amount of songs (data bind with angula js from second model)</h3>
        <div>
		{{total}}
        </div>
        
        <h3>List of songs (data bind with angula js from first model)</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Id</td>
                <td>Artist</td>
                <td>Track</td>
                <td>Link</td>
                <td>DELETE</td>
                <td>EDIT</td>
            </tr>
            </thead>
            <tbody>

			
			  <tr ng-repeat="x in list | filter:{link: ''}">
				<td>{{ x.id }}</td>
				<td>{{ x.artist }}</td>
				<td>{{ x.track }}</td>
				<td>{{ x.link  }}</td>		
				<td><a href="/php_mvc/songs/deletesong/{{x.id}}">delete</a></td>
				<td><span ng-click="edit(x.id)" href="#">edit</span></td>				
			  </tr>			
            </tbody>
        </table>
    </div>
	
	<div class="container" >

		<div>
			<h3>Edit a song</h3>
			<form ng-submit="update()" name="updateForm" novalidate>
				<label>Artist</label>
				<input autofocus type="text" name="updateartist" ng-model="updateartist" required />
				  <span style="color:red" ng-show="updateForm.updateartist.$invalid">
				  <span ng-show="updateForm.updateartist.$error.required">artist is required.
				  </span></span>
				<label>Track</label>
				<input type="text" name="updatetrack" ng-model="updatetrack"  required />
				  <span style="color:red" ng-show="updateForm.updatetrack.$invalid">
				  <span ng-show="updateForm.updatetrack.$error.required">artist is required.</span>		
				  </span></span>				  
				<label>Link</label>
				<input type="text" name="updatelink" ng-model="updatelink" />
				<input type="hidden" name="song_id" ng-model="song_id"  />
				<input type="submit" name="submit" value="Update" ng-disabled="updateForm.updatetrack.$invalid || updateForm.updateartist.$invalid" />
			</form>
		</div>
	</div>	
</div>
