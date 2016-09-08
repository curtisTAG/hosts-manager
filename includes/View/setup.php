<div class="row">
  <h1>Setup Host Manager</h1>
</div>

<div class="row">
  <div class="col-md-6">
  <p>Thanks for giving Host Manager a try!</p>
  <p>Before you install this tool, please check the following:</p>
  <ul>
    <li>You have reviewed settings.php to confirmed that it is correct for your setup.</li>
    <li>The webserver user has access to modify your hosts file.</li>
    <li>The webserver user has access to modify vhost config files.</li>
    <li>Ensure Include etc/extra/httpd-vhosts.conf is enabled</li>
    <li>Ensure your httpd.conf Directory / setting looks like this:
      <pre>
        &lt;Directory /&gt;
          Options Indexes FollowSymLinks Includes ExecCGI
          AllowOverride All
          Order deny,allow
          Allow from all
        &lt;/Directory&gt;
      </pre>
    </li>
  </ul>
  </div>
</div>

<div class="row">
  <form action="index.php?r=setup" method="POST" >
    <input type="submit" value="Begin Setup" name="begin_setup" class="btn btn-lg btn-primary" />
  </form>
</div>
