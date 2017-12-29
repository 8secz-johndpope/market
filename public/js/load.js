/**
 * Created by anil on 6/19/17.
 */
var albumBucketName = $('#amazon-web-bucket').val();
var cvBucketName = $('#amazon-cv-bucket').val();
var web_image_url = $('#amazon-web-bucket-url').val();
var IdentityPoolId = $('#amazon-identity-pool-id').val();

var awsregion = $('#amazon-region').val();
var cognito_role = $('#amazon-cognito-role').val();
var account_id = $('#amazon-account-id').val();
AWS.config.region = awsregion; // Region
AWS.config.credentials = new AWS.CognitoIdentityCredentials({
    AccountId:account_id,
    IdentityPoolId: IdentityPoolId,
    RoleArn:cognito_role
});

AWS.config.credentials.get(function(err) {
    if (err) alert(err);
    console.log(AWS.config.credentials);
});

var bucketName = albumBucketName; // Enter your bucket name
var bucket = new AWS.S3({
    params: {
        Bucket: bucketName
    }
});
var cv = new AWS.S3({
    params: {
        Bucket: cvBucketName
    }
});


function upload_file() {
    var fileChooser = document.getElementById('file-chooser');


    for (var i = 0; i < fileChooser.files.length; i++) {
        var file = fileChooser.files[i];
        var number = 1 + Math.floor(Math.random() * 999999999999);

    if (file) {
        console.log(file.name);
        var ext = file.name.split('.').pop();

        var objKey = '' + file.name;
        var uname = number + '.' + ext;
        console.log(uname);
        var params = {
            Key: uname,
            ContentType: file.type,
            Body: file,
            ACL: 'public-read'
        };
        (function (uname) {

        bucket.putObject(params, function (err, data) {
            if (err) {
                console.log(err);
            } else {
                console.log(data);
                axios.get('/user/image/add', {
                    params: {image: uname}
                })
                    .then(function (response) {
                        console.log(response);

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                $(".row-images").prepend('<div class="col-sm-3"><div class="cross-mark">X</div><input type="hidden" name="images[]" value="' + uname + '"><img src="'+web_image_url+'/' + uname + '"></div>');
                //  $("#advert-form").append('<input type="hidden" name="images[]" value="'+uname+'">');

            }
        });
        })(uname);

    } else {
        console.log("nothing to upload");
    }
    }
}
function upload_cv() {
    var fileChooser = document.getElementById('upload-cv');


        var file = fileChooser.files[0];
        var number = 1 + Math.floor(Math.random() * 999999999999);

        if (file) {
            console.log(file.name);
            var ext = file.name.split('.').pop();

            var objKey = '' + file.name;
            var uname = number + '.' + ext;
            console.log(uname);
            var params = {
                Key: uname,
                ContentType: file.type,
                Body: file,
                ACL: 'public-read'
            };
            (function (uname) {

                cv.putObject(params, function (err, data) {
                    if (err) {
                        console.log(err);
                    } else {
                        console.log(data);
                        var title = $('#title').val();
                        var category=$('#category').val();
                        axios.get('/user/cvs/add', {
                            params: {file_name: uname,title:title,category:category}
                        })
                            .then(function (response) {
                                console.log(response);
                                location.reload();

                            })
                            .catch(function (error) {
                                console.log(error);
                            });

                    }
                });
            })(uname);

        } else {
            console.log("nothing to upload");
        }

}
function upload_profile() {
    var fileChooser = document.getElementById('upload-profile');


    var file = fileChooser.files[0];
    var number = 1 + Math.floor(Math.random() * 999999999999);

    if (file) {
        console.log(file.name);
        var ext = file.name.split('.').pop();

        var objKey = '' + file.name;
        var uname = number + '.' + ext;
        console.log(uname);
        var params = {
            Key: uname,
            ContentType: file.type,
            Body: file,
            ACL: 'public-read'
        };
        (function (uname) {

            bucket.putObject(params, function (err, data) {
                if (err) {
                    console.log(err);
                } else {
                    console.log(data);
                    $('#image').val(uname);
                    $('.add-profile-image').attr('src',web_image_url+'/' + uname);

                }
            });
        })(uname);

    } else {
        console.log("nothing to upload");
    }

}
function upload_image_chat() {
    var fileChooser = document.getElementById('upload-image-chat');


    var file = fileChooser.files[0];
    var number = 1 + Math.floor(Math.random() * 999999999999);

    if (file) {
        console.log(file.name);
        var ext = file.name.split('.').pop();

        var objKey = '' + file.name;
        var uname = number + '.' + ext;
        console.log(uname);
        var params = {
            Key: uname,
            ContentType: file.type,
            Body: file,
            ACL: 'public-read'
        };
        (function (uname) {

            bucket.putObject(params, function (err, data) {
                if (err) {
                    console.log(err);
                } else {
                    console.log(data);
                   $('#all-msg').append('<div class="right-message clearfix"><img src="'+web_image_url+'/' + uname + '" style="float: right; max-width: 90%;"></div>');

                }
            });
        })(uname);

    } else {
        console.log("nothing to upload");
    }
}

