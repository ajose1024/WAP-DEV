<html>
  <head>
    <title><?php print( get_current_user() ); ?>'s home page</title>
  </head>

  <body bgcolor="#0000FF" text="#FFFFFF">
    <h1><?php print( get_current_user() ); ?>'s Home Page</h1>
    <hr>
    <p>This is <b><i><?php print( get_current_user() ); ?></i></b> home page at <i><?php print( $_SERVER[ 'HTTP_HOST' ] ); ?></i> server</p>
  </body>
</html>
