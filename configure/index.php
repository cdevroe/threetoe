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

<html>
  <head>
    <title>Configure: Three Toe</title>
  </head>
  <body>
    <h1>Three Toe</h1>
    <p>A simple SMS autoresponder.</p>
    <hr>
    <h2>Configuration</h2>
    <?php $responses = responses_list(); ?>

    <form id="responses" method="post" action="index.php">

      <?php if ( !isset($_GET['response']) ) : ?>
      <p><label for="responses_list">Choose a code:</label>
      <select name="responses_list" id="responses_list">
        <?php if ( !isset($_GET['response']) ) : ?>
          <option selected value="">Choose...</option>
        <?php endif ?>
        <option value="add_new_code">++ ADD NEW CODE</option>
        <?php
        if ( count($responses) > 0 ) :
          for($i=0;$i<count($responses);$i++) :
            $selected = ( isset($_GET['response']) && $_GET['response'] == $responses[$i] ) ? 'selected' : '';
            echo '<option value="' . $responses[$i] . '" ' . $selected . '>' . $responses[$i] . '</option>';
          endfor;
        endif; ?>
      </select></p>
    <?php elseif ( isset($_GET['response']) && $_GET['response'] != 'add_new_code' ) : ?>
      <h3>Editing code "<?php echo $_GET['response']; ?>"</h3>
      <p><a href="/configure"><< Go back</a></p>
    <?php endif; ?>

      <?php if ( isset($_GET['response']) && $_GET['response'] == 'add_new_code' ) : ?>
        <input type="hidden" name="action" id="action" value="add">
        <p><label for="code">Code:</label>
        <input type="text" maxlength="8" size="8" id="code" name="code"> <small>E.g. "T0001" or "BLUE123" or "C210001"</small></p>
        <p><label for="password">Password:</label>
        <input type="password" id="password" name="password"></p>
        <p><input type="submit" value="Add"> <small><a href="/configure">Cancel</a></small></p>

      <?php endif; ?>

      <?php if ( isset($_GET['response']) && $_GET['response'] != 'add_new_code' ) :
        $response = responses_load($_GET['response']);
        //var_dump($response);
        if ( isset($response) && !empty($response) ) : ?>
          <input type="hidden" name="action" id="action" value="edit">
          <input type="hidden" id="code" name="code" value="<?php echo $_GET['response']; ?>">
          <p><label for="response_edit">Edit response:</label><br/><textarea name="response_edit" id="response_edit" cols="40" rows="5"><?php echo $response; ?></textarea></p>

          <p><label for="password">Password:</label>
          <input type="password" id="password" name="password"></p>
          <p><input type="submit" value="Save"> <?php if ( $_GET['response'] != 'nopropertyinfo' ) : ?><small style="text-align: right;"><a href="#" id="deletecode">Delete "<?php echo $_GET['response']; ?>" code?</a></small><?php endif; ?></p>

        <?php else : ?>
          <p>No response found. Perhaps an error?</p>
        <?php endif;
      endif; ?>

    </form>
    <hr>
    <p><small>Written by <a href="http://cdevroe.com/">Colin Devroe</a></small></p>
    <script type="text/javascript" src="configure.js"></script>
  </body>
</html>
