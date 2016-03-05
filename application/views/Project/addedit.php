<div class="container">
    <div class="container-fluid">
        <div class="row">
            <h3 class="pull-left">Add Project</h3>
        </div>
    </div>
    <hr class="clearfix" />
    <form name="project" method="post">
      <div class="form-group col-md-6">
        <label for="">Prject name</label>
        <input type="text" class="form-control" id="" placeholder="" name="project_name">
      </div>
      <div class="form-group col-md-6">
        <label for="">Git repository</label>
        <input type="text" class="form-control" id="" placeholder="" name="repository_name">
      </div>
      <div class="form-group col-md-6">
        <label for="">Repository?</label>
        <label for="public">Public<input type="radio" class="form-control" id="public" placeholder="" name="repository_type" value="public"></label>
        <label for="private">Private<input type="radio" class="form-control" id="private" placeholder="" name="repository_type" value="private"></label>
      </div>
      <div class="form-group col-md-6">
          <label for="">Git Username</label>
          <input type="text" class="form-control" id="" placeholder="" name="git_username">
      </div>
      <div class="form-group col-md-6">
        <label>Git Password</label>
        <input type="password" class="form-control" id="" placeholder="" name="git_password">
      </div>
      <div class="form-group col-md-6">
            <label for="">Project language</label>
            <select name="project_language" required class="form-control">
              <option value="">Select</option>
              <option value="php">PHP</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="">Project framework</label>
            <select name="project_framework" required class="form-control">
              <option value="">Select</option>
              <option value="symphony">Symphony</option>
            </select>
        </div>
        <div class="form-group col-md-6">
          <label for="">Controller Directory</label>
          <input type="text" class="form-control" id="" placeholder="" name="controller_directory">
        </div>
        <div class="form-group col-md-6">
          <label for="">Model Directory</label>
          <input type="text" class="form-control" id="" placeholder="" name="model_directory">
        </div>
        <div class="form-group col-md-6">
          <label for="">Exclude Directory</label>
          <input type="text" class="form-control" id="" placeholder="" name="exclude_directory">
      </div>

        <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
