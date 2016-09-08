<div class="row">
  <h1>Sites</h1>
</div>

<div class="row">
  <div class="table-responsive">
    <table class="table table-hover">
      <tr>
        <th>Id</th>
        <th>Domain</th>
        <th>Docroot</th>
        <th>Actions</th>
      </tr>

      <?php  foreach ($sites as $site): ?>
        <tr>
          <td><?php print $site['id']; ?></td>
          <td><?php print $site['hostname']; ?></td>
          <td><?php print $site['docroot']; ?></td>
          <td>
            <a href="#" class="js-sites-delete" data-id="<?php print $site['id']; ?>">
              <span class="glyphicon glyphicon-trash"></span>
            </a>
          </td>
        </tr>
      <?php  endforeach; ?>
    </table>
  </div>
</div>

<hr />

<div class="row">
  <form action="index.php?r=sites" method="POST" >
    <div class="alert alert-warning">
      <strong>Note:</strong> Upon form submission, an entry for the provided domain name pointing to 127.0.0.1 will be automatically added to your hosts file. Further, the site will not be acessable until the webserver is restarted.
    </div>

    <div class="form-group">
      <label for="domain">Domain Name</label>
      <input type="text" name="domain" class="form-control" />
    </div>

    <div class="form-group">
      <label for="docroot">Document Root Path</label>
      <input type="text" name="docroot" class="form-control" />
    </div>

    <div class="form-group ">
      <input type="checkbox" name="needs_db" id="needs_db" class='js-database-toggle'/>
      <label for="name="needs_db"">Needs a Database</label>
    </div>

    <div class="form-group hidden js-database-fields">
      <label for="db_name">Database Name</label>
      <input type="text" name="db_name" id="db_name" class="form-control" />

      <label for="db_user">Database User</label>
      <input type="text" name="db_user" id="db_user" class="form-control" />

      <label for="db_pass">Database Password</label>
      <input type="password" name="db_pass" id="db_pass" class="form-control" />
    </div>

    <div class="form-group">
      <input type="submit" value="Add Site" name="add_site" class="btn btn-primary" />
    </div>
  </form>
</div>
