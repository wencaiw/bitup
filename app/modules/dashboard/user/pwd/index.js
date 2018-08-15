/**
 * Created by Hajay on 2018/1/2.
 */

module.exports = {
    url: '/pwd',
    views: {
        'user': {
            template: __inline('index.html'),
            controller: ['$scope', '$http', '$cookies', '$state', '$', 'userInfo', 'FileUploader', function($scope, $http, $cookies, $state, $, userInfo, FileUploader){
                $scope.g.currPage = 'user';
                $scope.userInfo.menu = "pwd";
                $scope.userInfo.openSubMenu.securitySettings = false;

                $scope.info = {
                    success: false,
                    subClick: function(){
                        if($scope.info.loading){
                            return false;
                        }
                        //输入框不能为空
                        var oldPwd = $scope.info.oldPwd;
                        var newPwd = $scope.info.newPwd;
                        var rePwd = $scope.info.rePwd;
                        if(!oldPwd || !newPwd){
                            $scope.g.tip("Change password",'Current password or New password cannot be empty');
                            return false;
                        }
                        if(!/[a-zA-Z]+/.test(newPwd) || !/\d+/.test(newPwd) || !/^\S{8,20}$/.test(newPwd)){
                            $scope.g.tip("Change password",'Incorrect password format');
                            return false;
                        }
                        //两次密码不一致
                        if(newPwd != rePwd){
                            $scope.g.tip("Change password",'Entered passwords differ');
                            return false;
                        }
                        $.ajax({
                            loading: 2,
                            method: 'post',
                            data:{
                                old_pwd: hex_hmac_md5($scope.g.info.account, oldPwd),
                                new_pwd: hex_hmac_md5($scope.g.info.account, newPwd)
                            },
                            url: 'app/modules/dashboard/user/data/modify.pwd.php',
                            success: function(res){
                                $scope.g.tip("Change password","Your password has been successful reset, please log in again",function(){
                                    window.location.reload();
                                });
                                $scope.info.oldPwd = "";
                                $scope.info.newPwd = "";
                                $scope.info.rePwd = "";
                            }
                        },$scope);
                    }
                };

                //uploader
                //$scope.info.imgList = [];
                //$scope.info.testImg = '';
                //var uploader = $scope.info.uploader = new FileUploader({
                //    url: 'common/data/upload.php',
                //    autoUpload: true
                //});
                //uploader.filters.push({
                //    name: 'imageFilter',
                //    fn: function(item /*{File|FileLikeObject}*/, options) {
                //        var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                //        return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
                //    }
                //});
                //uploader.onAfterAddingFile = function(fileItem) {
                //    //console.info('onAfterAddingFile', fileItem);
                //    //$scope.info.test = fileItem._file;
                //    var reader = new FileReader();
                //    reader.addEventListener("load", function (e) {
                //        //文件加载完之后，更新angular绑定
                //        $scope.$apply(function(){
                //            $scope.info.testImg = e.target.result;
                //        });
                //    }, false);
                //    reader.readAsDataURL(fileItem._file);
                //};
                //console.log(uploader);

            }]
        }
    },
    resolve: {
        'pwd': ['$ocLazyLoad', function($ocLazyLoad){
            return $ocLazyLoad.load({
                name: 'pwd',
                serie: true,
                files: [
                    '../common/js/md5.js',
                    '../bower_components/angular-file-upload/dist/angular-file-upload.js',
                ]
            })
        }]
    }
};