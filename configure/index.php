<?php
/*
  A screen to configure Three Toe responses
*/

include('../app/init.php');

if ( isset($_POST) && isset($_POST['action']) ) :

  switch ($_POST['action']) :
    case 'add':
      responses_add($_POST['code']);
    break;
    case 'edit':
      responses_edit($_POST['code'],$_POST['response_edit']);
    break;
    case 'delete':
      responses_delete($_POST['code']);
    break;
  endswitch;
endif;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Three Toe: Configuration</title>
    <link rel="stylesheet" href="<?php echo $app_url; ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $app_url; ?>assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="<?php echo $app_url; ?>">ThreeToe </a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="active" role="presentation"><a href="<?php echo $app_url; ?>configure/">Configure </a></li>
                    <li role="presentation"><a href="<?php echo $app_url; ?>about.php">About </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Configure</h3>
            </div>

            <div class="col-md-12">
              <?php // Get all responses
               $responses = responses_list(); ?>

                <form id="responses" method="post" action="index.php">
                  <?php if ( !isset($_GET['response']) ) : ?>
                    <label for="responses_list">Choose a code:</label>
                    <select name="responses_list" id="responses_list" class="form-control">
                      <optgroup label="Action">
                        <option value="add_new_code">++ ADD NEW CODE</option>
                      </optgroup>
                      <optgroup label="Codes">
                          <?php if ( !isset($_GET['response']) ) : ?>
                            <option selected value="">Choose a code to edit...</option>
                          <?php endif ?>

                          <?php
                          if ( count($responses) > 0 ) :
                            for($i=0;$i<count($responses);$i++) :
                              $selected = ( isset($_GET['response']) && $_GET['response'] == $responses[$i] ) ? 'selected' : '';
                              echo '<option value="' . $responses[$i] . '" ' . $selected . '>' . $responses[$i] . '</option>';
                            endfor;
                          endif; ?>
                        </optgroup>
                    </select>
                  <?php elseif ( isset($_GET['response']) && $_GET['response'] != 'add_new_code' ) : ?>
                    <h4>Editing code "<?php echo $_GET['response']; ?>"</h4>
                    <p><a href="<?php echo $app_url; ?>configure"><< Go back</a></p>
                  <?php endif; ?>

                  <!-- Add New Code -->
                  <?php if ( isset($_GET['response']) && $_GET['response'] == 'add_new_code' ) : ?>
                    <input type="hidden" name="action" id="action" value="add">

                    <p><label for="code">Code:</label>
                    <input class="form-control" type="text" maxlength="8" size="8" id="code" name="code"> <small>E.g. "T0001" or "BLUE123" or "C210001"</small></p>
                    <p><label for="password">Password:</label>
                    <input class="form-control" type="password" id="password" name="password"></p>
                    <p><button class="btn btn-primary" type="submit">Save</button> <a href="<?php echo $app_url; ?>configure/" class="btn btn-link">Cancel</a></p>
                  <?php endif; ?>

                  <!-- Edit existing code -->
                  <?php if ( isset($_GET['response']) && $_GET['response'] != 'add_new_code' ) :
                    $response = responses_load($_GET['response']);
                    //var_dump($response);
                    if ( isset($response) && !empty($response) ) : ?>
                      <input type="hidden" name="action" id="action" value="edit">
                      <input type="hidden" id="code" name="code" value="<?php echo $_GET['response']; ?>">

                      <p><label for="response_edit">Edit response:</label><br/><textarea class="form-control" name="response_edit" id="response_edit" cols="40" rows="5"><?php echo $response; ?></textarea></p>

                      <p><label for="password">Password:</label>
                      <input class="form-control" type="password" id="password" name="password"></p>

                      <div class="col-lg-6 col-md-12 col-xs-12">
                          <button class="btn btn-primary" type="submit">Save</button> &nbsp; &nbsp; &nbsp; <?php if ( $_GET['response'] != 'notfound' ) : ?><button id="deletecode" class="btn btn-danger btn-xs" type="button">Delete</button><?php endif; ?>
                      </div>

                  <?php else : ?>
                    <p>No response found. Perhaps an error?</p>
                  <?php endif;
                endif; ?>

                </form>
            </div>


        </div>
    </div>
    <footer style="margin-top: 25px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  <hr>
                    <p class="text-center">Created by <a href="http://cdevroe.com" title="Colin Devroe, programmer and photographer for hire">Colin Devroe</a>.</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="<?php echo $app_url; ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo $app_url; ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $app_url; ?>configure/configure.js"></script>
</body>
</html>
