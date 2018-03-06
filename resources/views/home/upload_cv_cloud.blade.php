<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Upload CV')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('content')
<link href="{{ asset("/css/private-profile.css?q=$dateMs") }}" rel="stylesheet" type="text/css">
<div class="body background-body">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="back-link">
          <a href="/job/profile/edit/general"><i class="glyphicon glyphicon-menu-left"></i>Your profile</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <form action="" method="post">
        <div class="section">
          <header class="section-header">
            <h2 class="title">Select a file to upload</h2>
          </header>
          <div class="content row">
              <div class="upload-options">
                <div class="form-group">
                  <ul>
                    <li class="col-xs-12 col-sm-6 cv-upload-option">
                      <span class="upload-option device">
                        From your device
                      </span>
                      <input type="file" name="cv" class="file-input" id="upload-cv">
                    </li>
                    <li class="col-xs-12 col-sm-6 cv-upload-option">
                      <span class="upload-option googledrive" id="googledrive">
                        Google Drive
                        <span id="result"></span>
                      </span>
                    </li>
                    <li class="col-xs-12 col-sm-6 cv-upload-option">
                      <span class="upload-option onedrive">
                        Microsoft OneDrive
                      </span>
                    </li>
                    <li class="col-xs-12 col-sm-6 cv-upload-option" id="dropbox">
                      <span class="upload-option dropbox">
                        Dropbox
                      </span>
                    </li>
                  </ul>
                  <input type="hidden" value="" id="other-cv">
                  <div class="validation">
                    <span>Choose one file</span>
                  </div>
                </div>
              </div>
              <div class="cv-confirmation-area col-xs-8 col-xs-offset-2" style="display: none">
                <div class="row">
                  <div class="col-xs-12 col-sm-8">
                    <div class="row cv-information">
                      <div class="col-xs-2">
                        <i class="icon icon-cv"></i>
                      </div>
                      <div class="col-xs-10">
                        <b class="filename"></b>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-4 incorrect-file">
                    <p>
                      Not the right file?
                      <br>
                      <a class="upload-new-cv" href="#">Upload a new CV</a>
                    </p>
                  </div>
                </div>
              </div>
              <div class="cv-searchable col-xs-12">
                <div class="checkbox">
                  <input type="checkbox" id="searchable-checkbox" checked="checked" name="searchable-checkbox">
                  <label for="searchable-checkbox">
                    <b>Let recruiters find your CV</b>
                    <br>
                    You can modify this at any time in your profile
                  </label>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="title">Title</label> 
                <input type="hidden" value="{{$profile->id}}" name="profile" id="profile">
                <input type="hidden" value="" id="type">
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="CV for Part Time Job">
                <small id="emailHelp" class="form-text text-muted">With title you can easily locate CV if you have many CVs </small>
                <div class="validation">
                  <span>Please add a title to your CV</span>
                </div>
              </div>
              <div class="form-group">
                <label for="category">Select Category</label>
                <select class="form-control" id="category">
                    <option value="0">Select</option>
                    @foreach($jobs as $job)
                      <option value="{{$job->id}}">{{$job->title}}</option>
                    @endforeach
                </select>
                <div class="validation">
                   <span>Please choose a category to your CV</span>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <a class="btn btn-submit" id="upload-cv-link">Upload CV</a>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="/js/filepicker.js"></script>
<script src="/js/base64ArrayBuffer.js"></script>
<script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="0u9ya1i2i20ftiz"></script>

<script>
  function initPicker() {
    var picker = new FilePicker({
      apiKey: 'AIzaSyCZbnf5ZxF0xDYINzcfITR_5E8XVkFD8Hs',
      clientId: '847435132616-7k2capek98p6pspvbsjum0rsugcb0kuh',
      buttonEl: document.getElementById('googledrive'),
      onSelect: function(file) {
        console.log(file);
        alert('Selected ' + file.title);
      }
    }); 
    console.log('created picker');
  }
</script>
<script type="text/javascript">

      // The Browser API key obtained from the Google API Console.
      var developerKey = 'AIzaSyAyPtUvbJtOE0WwzOT8ZoTTlLu0TlR0x2k';

      // The Client ID obtained from the Google API Console. Replace with your own Client ID.
      var clientId = '854626581034-bcu31rltebnc49uqo08c6o4kkm58se0t.apps.googleusercontent.com';

      // Scope to use to access user's photos.
      var scope = 'https://www.googleapis.com/auth/drive.readonly';

      var pickerApiLoaded = false;
      var oauthToken;
      var contentFile;
      var type;
      // Use the API Loader script to load google.picker and gapi.auth.
      function onApiLoad() {
        gapi.load('auth2', onAuthApiLoad);
        gapi.load('picker', onPickerApiLoad);
      }

      function onAuthApiLoad() {
        var authBtn = document.getElementById('googledrive');
        authBtn.disabled = false;
        authBtn.addEventListener('click', function() {
          gapi.auth2.authorize({
            client_id: clientId,
            scope: scope
          }, handleAuthResult);
        });
      }

      function onPickerApiLoad() {
        pickerApiLoaded = true;
        createPicker();
      }

      function handleAuthResult(authResult) {
        if (authResult && !authResult.error) {
          oauthToken = authResult.access_token;
          createPicker();
        }
      }

      // Create and render a Picker object for picking user Photos.
      function createPicker() {
        if (pickerApiLoaded && oauthToken) {
          var picker = new google.picker.PickerBuilder().
              addView(google.picker.ViewId.DOCS).
              setOAuthToken(oauthToken).
              setDeveloperKey(developerKey).
              setCallback(pickerCallback).
              setOrigin(window.location.protocol + '//' + window.location.host).
              build();
          picker.setVisible(true);
        }
      }

      // A simple callback implementation.
      function pickerCallback(data) {
        var url = 'nothing';
        var name = '';
        var idDocument = 0;
        if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
          var doc = data[google.picker.Response.DOCUMENTS][0];
          console.log(doc);
          url = doc[google.picker.Document.URL];
          name = doc[google.picker.Document.NAME];
          idDocument = doc[google.picker.Document.ID];
          type = doc[google.picker.Document.MIME_TYPE];
          getFileDrive(idDocument, name, type);
        }
        showFileName(name);
        $('#other-cv').val(idDocument);
      }
</script>
<script>
  options = {

    // Required. Called when a user selects an item in the Chooser.
    success: function(files) {
      console.log(files[0]);
      var name = files[0].name;
      var url = files[0].link;
      showFileName(name);
      getFileDropbox(url, name);
    },

    // Optional. Called when the user closes the dialog without selecting a file
    // and does not include any parameters.
    cancel: function() {

    },

    // Optional. "preview" (default) is a preview link to the document for sharing,
    // "direct" is an expiring link to download the contents of the file. For more
    // information about link types, see Link types below.
    linkType: "direct", // or "direct"

    // Optional. A value of false (default) limits selection to a single file, while
    // true enables multiple file selection.
    multiselect: false, // or true

    // Optional. This is a list of file extensions. If specified, the user will
    // only be able to select files with these extensions. You may also specify
    // file types, such as "video" or "images" in the list. For more information,
    // see File types below. By default, all extensions are allowed.
    extensions: ['.pdf', '.doc', '.docx'],

    // Optional. A value of false (default) limits selection to files,
    // while true allows the user to select both folders and files.
    // You cannot specify `linkType: "direct"` when using `folderselect: true`.
    folderselect: false, // or true
  };
  var button = Dropbox.createChooseButton(options);
  document.getElementById("dropbox").appendChild(button);
  $('#upload-cv-link').click(function () {
        var title = $('#title').val();
        var category = $('#category').val();
        var cv = $('#upload-cv').val();
        var type = $('#type').val();
        var otherCv = $('#other-cv').val();
        var input = null;
        if(!title){
            input = $('#title');
        }
        else if(category=='0'){
          input = $('#category');
        }
        else if(type == '' || (type == 'device' && cv =='')){
          input = $('#upload-cv');
        }
        else if((type == 'google-drive' || type == 'dropbox' || type == 'one-drive') &&  otherCv ==''){
          input = $('#other-cv');
        }
       if(input != null){
        console.log(input);
        toggleValidationError(input, true);
       }else{
        if(type == 'device'){
          upload_cv();
        }
        else{
          uploadCvOthers(otherCv, type, contentFile);
        }
      }
    });
  $('#upload-cv').change(function(){
    showFileName($('#upload-cv').val());
    toggleValidationError($(this), false);
    $('#type').val('device');
  });
  $('.upload-new-cv').click(function(){
    $('.upload-options').show();
    $('.cv-confirmation-area').hide();
    $('#upload-cv').val('');
    $('#other-cv').val('');
    $('#type').val('');
  });
  $('#title').focusout(function(){
    toggleValidationError($(this), false);
  });
  $('#category').change(function(){
    toggleValidationError($(this), false);
  });
  $('#dropbox').click(function(){
    button.click();
  });
  function toggleValidationError(inputSelector, addOrRemove){
    var parent = inputSelector.closest('.form-group');
    parent.toggleClass('input-validation-error', addOrRemove);
  }
  function showFileName(fileName){
    $('.cv-confirmation-area').show();
    $('.filename').text(fileName);
    $('.upload-options').hide();
  }
  function getFileDrive(file, fileName, type){
    var accessToken = oauthToken;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "https://www.googleapis.com/drive/v2/files/"+file+'?alt=media');
    xhr.setRequestHeader('Authorization','Bearer '+accessToken);
    xhr.responseType = 'blob';
    xhr.onload = function(){
        contentFile = xhr.response;
        $('#other-cv').val(fileName);
        $('#type').val('google-drive');
    }
    xhr.send();
  }
  function getFileDropbox(url, fileName){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url);
    xhr.responseType = 'blob';
    xhr.onload = function(){
        contentFile = xhr.response;
        $('#other-cv').val(fileName);
        $('#type').val('dropbox');
    }
    xhr.send();
  }
</script>
<script src="https://www.google.com/jsapi?key=AIzaSyAyPtUvbJtOE0WwzOT8ZoTTlLu0TlR0x2k"></script>
<script src="https://apis.google.com/js/client:plusone.js" type="text/javascript"></script>
<script type="text/javascript" src="https://apis.google.com/js/api.js?onload=onApiLoad"></script>


@endsection