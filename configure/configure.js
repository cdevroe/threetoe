/*
  JavaScript for configuration of Three Toe
  by Colin Devroe http://cdevroe.com/
*/
(function (win,doc) {
  'use strict';

  var code_select = document.getElementById('responses_list'),
      delete_code = document.getElementById('deletecode');

  if ( code_select ) {
    code_select.addEventListener('change', load_response, false);
  }

  if ( delete_code ) {
    delete_code.addEventListener('click', response_delete_confirm, false);
  }

}(this, this.document));

function load_response(){
  var code_select = document.getElementById('responses_list');
  var url = window.location.protocol+'//'+window.location.host+window.location.pathname;
  window.location = url+'?response='+code_select.value;
}

function response_delete_confirm(){
  var form = document.getElementById('responses');
  var action = document.getElementById('action');

  if ( confirm('This cannot be undone. Are you sure?') ) {
    action.value = 'delete';
    form.submit();
  }
}
